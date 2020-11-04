<?php

namespace App\Http\Controllers\API\V1\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SignupActivate;
use App\Notifications\UserRegistered;
use App\Models\Onesignal;
use App\Models\User;
use Carbon\Carbon;
use Notification;
use Validator;
use Storage;
use Avatar;

class UserController extends BaseController
{
    /**
     * Register api
     * @param  [string] first_name
     * @param  [string] last_name
     * @param  [string] email
     * @param  [string] gmap_address
     * @param  [string] address_description
     * @param  [string] password
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|unique:users,phone_number',
            'gmap_address' => 'string',
            'address_description' => 'string',
            'password' => 'required',
        ]);

        $super_admin = User::whereHas('roles', function($query){
            $query->where('name', 'super-admin');
        })->first();

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['activation_token'] = str_random(60);
        $input['active'] = false;
        $user = User::create($input);
        if(isset($request['user_type'])){
            if($request->input('user_type') == 'shipper'){
                $user->assignRole('shipper');
            }
        }else{
            $user->assignRole('customer');
        }
        $user->address()->create([
            'description' => isset($input['address_description']) ? $input['address_description'] : null,
            'gmap_address' => isset($input['gmap_address']) ? $input['gmap_address'] : null
        ]);
        
        // On envoie l'email de confirmation de compte a cet utilisateur
        $user->notify((new SignupActivate($user))->delay(now()->addSeconds(10)));

        $image = Avatar::create($user->first_name.' '.$user->last_name)->toBase64();
        $image = str_replace('data:image/png;base64,', '', $image);
        Storage::put('public/users/'.$user->id.'/avatar.png', base64_decode($image));

        $success['access_token'] =  $user->createToken('ShopAccessToken')->accessToken;
        $success['name'] =  $user->first_name.' '.$user->last_name;

        // Notifier le super-admin de la création d'un nouvel utilisateur
        $super_admin->notify(new UserRegistered($user));

        return $this->sendResponse($success, 'Your account was successfully created ! But you must connect to your email account and follow the link to confirm this account.');
    }

    /**
     * Register api
     * @param  [string] first_name
     * @param  [string] last_name
     * @param  [string] email
     * @param  [string] gmap_address
     * @param  [string] address_description
     * @param  [string] password
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name' => 'required',
            'email' => 'required|email',
            'gmap_address' => 'string',
            'address_description' => 'string',
            'phone_number' => 'required|integer',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if(!Hash::check($input['password'], Auth::user()->password)){
            return $this->sendError('Validation Error.', ['password' => 'Please enter the correct password before updating you profile.']);
        }
        if(isset($input['new_password'])){
            $input['password'] = Hash::make($input['new_password']);
        }else{
            $input['password'] = Hash::make($input['password']);
        }
        $user_has_email = User::where('email', $input['email'])->first();
        if(isset($user_has_email) && !$user_has_email->is(Auth::user())){
            return $this->sendError('Validation Error.', ['email' => 'The email has already been taken.']);
        }

        $user_has_phone_number = User::where('phone_number', $input['phone_number'])->first();
        if(isset($user_has_phone_number) && !$user_has_phone_number->is(Auth::user())){
            return $this->sendError('Validation Error.', ['phone_number' => 'The phone number has already been taken.']);
        }

        Auth::user()->update($input);

        if(Auth::user()->address){
            Auth::user()->address()->update([
                'description' => isset($input['address_description']) ? $input['address_description'] : null,
                'gmap_address' => $input['gmap_address']
            ]);
        }else{
            Auth::user()->address()->create([
                'description' => isset($input['address_description']) ? $input['address_description'] : null,
                'gmap_address' => isset($input['gmap_address']) ? $input['gmap_address'] : null
            ]);
        }
        if(isset($input['first_name']) || isset($input['last_name'])){
            $image = Avatar::create(Auth::user()->first_name.' '.Auth::user()->last_name)->toBase64();
            $image = str_replace('data:image/png;base64,', '', $image);
            Storage::put('public/users/'.Auth::user()->id.'/avatar.png', base64_decode($image));
        }

        return $this->sendResponse(Auth::user(), 'Your account was successfully updated !');
    }

    /**
     * Login api
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required',
            'remember_me' => 'boolean'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['is_enable'] = 1;
        $credentials['deleted_at'] = null;

        if(!Auth::attempt($credentials)){
            return response()->json([
                'success' => 'false',
                'message' => 'Unauthorized'
            ], 401);
        }
        $user = $request->user();
        if($request->input('user_type') != null){
            if($request->input('user_type') == 'shipper'){
                if(!$user->isShipper()){
                    return response()->json([
                        'success' => 'false',
                        'message' => 'Unauthorized : this user is not a shipper',
                        'user_type' => $request->input('user_type')
                    ], 401);
                }
            }else if($request->input('user_type') == 'shop-admin'){
                if(!$user->isShopAdmin()){
                    return response()->json([
                        'success' => 'false',
                        'message' => 'Unauthorized : this user is not an administrator',
                        'user_type' => $request->input('user_type')
                    ], 401);
                }
            }
        }else{
            if(!$user->isCustomer()){
                return response()->json([
                    'success' => 'false',
                    'message' => 'Unauthorized : this user is not a customer'
                ], 401);
            }
        }
        $tokenResult = $user->createToken('ShopAccessToken');
        $token = $tokenResult->token;

        if($request->remember_me){
            $token->expires_at = Carbon::now()->addMonths(6);
        }

        $token->save();
        $success['access_token'] = $tokenResult->accessToken;
        $success['token_type'] = 'Bearer';
        $success['expires_at'] = Carbon::parse(
            $tokenResult->token->expires_at
        )->toDateTimeString();
        return $this->sendResponse($success, 'User successfully logged in !');
    }

    /**
     * Logout user (Revoke the token)
     * 
     * @return [string] message
     */ 
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out !'
        ]);
    }

    /**
     * Get the authenticated User
     * 
     * @return [json] user object
     */

    public function details(Request $request){
        return $this->sendResponse($request->user(), "All details of the authenticated User");
    }

    public function signupActivate($token){
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
    
        $user->active = true;
        $user->activation_token = '';
        $user->email_verified_at = now()->toDateTimeString();
        $user->save();
    
        // return $this->sendReponse($user, "Thanks, your account was successfully confirmed !");
        return view('auth.thankyoupage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        if(Hash::check($request['password'], Auth::user()->password)){
            Auth::user()->delete();
        }else{
            return response()->json([
                'message' => 'Make sure to enter the correct password !'
            ]);
        }
        return response()->json([
            'message' => 'Your account was successfully deleted !'
        ]);
    }

    /**
     * Create new player_id in onesignals table
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function onesignal(Request $request){
        $validator = Validator::make($request->all(), [
            'player_id' => 'required'
        ]);
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user = $request->user();
        if(in_array($request->player_id, $user->onesignals->pluck('player_id')->toArray())){
            return $this->sendError('This player_id ('.$request->player_id.') was already saved');
        }

        $user->onesignals()->create([
            'player_id' => $request->player_id
        ]);
        return $this->sendResponse(['player_id' => $request->player_id], 'Your player_id was saved');
    }

    /**
     * Get earning of the shipper
     * 
     * @return \Illuminate\Http\Response
     */
    public function wallet()
    {
        if(isset(Auth::user()->balance)){
            $data['balance'] = Auth::user()->balance;
            $data['last_update'] = Auth::user()->wallet->updated_at->format('d-m-Y H:s:i');
        }else{
            $data['balance'] = null;
            $data['last_update'] = null;
        }
        return $this->sendResponse($data, 'wallet retrieved successfully.');
    }

    /**
     * Get user's wallet transactions
     */
    public function payout(Request $request){
        if(isset(Auth::user()->balance)){
            if($request->type){
                $transactions = Auth::user()
                                    ->wallet
                                    ->transactions()
                                    ->where('type', $request->type)
                                    ->latest()
                                    ->get();
            }else{
                $transactions = Auth::user()
                                    ->wallet
                                    ->transactions()
                                    ->latest()
                                    ->get();
            }
        }else{
            $transactions = [];
        }
        return $this->sendResponse($transactions, 'transactions retrieved successfully.');
    }

    /**
     * Update shiper availability
     * 
     */
    public function toggleAvailability(Request $request){
        $validator = Validator::make($request->all(), [
            'available' => 'required|integer|max:1|min:0'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user = Auth::user();
        $user->available = $request['available'];
        $user->save();
        return $this->sendResponse($user, 'You are now available to take a new order');
    }

    /**
     * Update gmap_address
     * 
     */
    public function updateGmapAddress(Request $request){
        $validator = Validator::make($request->all(), [
            'gmap_address' => 'required|string'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user = Auth::user();
        if($user->address){
            $user->address()->update([
                'description' => null,
                'gmap_address' => $request['gmap_address']
            ]);
        }else{
            $user->address()->create([
                'description' => null,
                'gmap_address' => isset($request['gmap_address']) ? $request['gmap_address'] : null
            ]);
        }
        return $this->sendResponse($user, 'Your service zone was succefully updated !');
    }

    /**
     * Search for shippers
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchShippers(Request $request){
        $shippers = User::shipper()->select('id', 'first_name', 'last_name', 'created_at')->get();
        $shippers = $shippers->filter(function ($shipper) use ($request) {
            return false !== stristr($shipper->full_name, $request->input('term'));
        });
        return response()->json([
            'total_count' => $shippers->count(),
            'success' => true,
            'shippers' => $shippers->values()->toArray(),
            'message' => 'Shippers was successfully retrived !'
            ]);
    }
    
}
