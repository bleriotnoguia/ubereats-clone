<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->shopAdmin()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        if(Auth::user()->can('create', $user)){
            $roles = Role::pluck('name', 'name')->all();
            unset($roles['super-admin']);
            return view('users.create', compact('user', 'roles'));
        }
       return back(); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        if(Auth::user()->can('create', User::class)){
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['activation_token'] = str_random(60);
            if($request['roles'] == 'customer'){
                $input['active'] = false;
            }else{
                $input['active'] = true;
            }
            $user = User::create($input);
            // on vefifie d'abord s'il s'agit du super-admin
            if(Auth::user()->isSuperAdmin()){
                if(!empty($request['roles'])){
                    $user->assignRole($request->input('roles'));
                }
            }

            foreach ($request->input('document', []) as $file) {
                $user->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }
            
            Session::flash('success', "L'utilisateur à bien été creé !");
            return redirect(route('users.edit', $user));
        }
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(Auth::user()->can('view', $user)){
            return view('users.show', compact('user'));
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::user()->can('update', $user)){
            return view('users.edit', compact('user'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditUserRequest $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, User $user)
    {
        if(Auth::user()->can('update', $user)){
            $input = $request->all();
            if (count($user->getMedia('image')) > 0) {
                foreach ($user->getMedia('image') as $media) {
                    if (!in_array($media->file_name, $request->input('document', []))) {
                        $media->delete();
                    }
                }
            }

            $media = $user->getMedia('image')->pluck('file_name')->toArray();

            foreach ($request->input('document', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $user->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
                }
            }
            if(Auth::user()->id == $user->id){
                if($user->address){
                    $user->address()->update([
                        'description' => $input['address_description'],
                        'gmap_address' => $input['gmap_address']
                    ]);
                }else{
                    $user->address()->create([
                        'description' => $input['address_description'],
                        'gmap_address' => $input['gmap_address']
                    ]);
                }
            }
            if(Auth::user()->isSuperAdmin()){
                if(empty($input['password'])){
                    unset($input['password']);
                    unset($input['c_password']);
                }else{
                    $input['password'] = Hash::make($input['password']);
                }  
            }
            $input['phone_number'] = $input['full_number'];
            $user->update($input);
            Session::flash('success', 'L\'utilisateur à bien été modifié !');
            return redirect(route('users.edit', $user));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Auth::user()->can('delete', $user)){
            $user->delete();
            Session::flash('success', 'L\'utilisateur à bien été supprimé !');
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function block(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if(Auth::user()->can('block', $user)){
            if($user->is_enable){
                $user->update([
                    'is_enable'=> 0,
                ]);
                $message = "L'utilisateur ( ".str_limit($user->full_name, 15, "...")." ) à bien été bloqué !";
            }else{
                $user->update([
                    'is_enable'=> 1,
                ]);
                $message = "L'utilisateur ( ".str_limit($user->full_name, 15, "...")." ) à bien été débloqué !";
            }
            return response()->json(
                [
                    'success' => true,
                    'message'=> $message, 
                    'data' => $user
                ], 200);
        }
        return response()->json(
            [
                'success' => false, 
                'message' => 'Echec de mise à jour. \n Vous n\'avez pas les droits pour effectuer cette action.'
            ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function changePasswordForm(User $user)
    {
        if(Auth::user()->can('update', $user)){
            return view('users.password', compact('user'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ChangePasswordRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function changePassword(ChangePasswordRequest $request, User $user)
    {
        if(Auth::user()->can('update', $user)){
            if(Hash::check($request->previous_password, $user->password)){
                $user->password = Hash::make($request->new_password);
                $user->save();
                Session::flash('success', 'Le mot de passe a bien été mis à jour !');
            }else{
                Session::flash('danger', 'L\'ancien mot de passe que vous avez saisie est incorrect !');
            }
            return redirect(route('users.show_password_form', $user));
        }
        return back();
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
            'users' => $shippers->values()->toArray(),
            'message' => 'Shippers was successfully retrived !'
            ]);
    }
    
}
