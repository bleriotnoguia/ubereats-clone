<?php

namespace App\Http\Controllers;

use App\Models\Promocode;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Carbon\Carbon;
use Session;
use Auth;
use Promocodes;

class PromocodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->isSuperAdmin()){
            if($request->restaurant_id == null){
                $promocodes = Promocode::all();
            }else{
                $promocodes = Promocode::where('restaurant_id', $request->restaurant_id)->get();
            }
            return view('promocodes.index', compact('promocodes'));
        }else{
            return view('promocodes.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promocode = new Promocode();
        return view('promocodes.create', compact('promocode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurant = Restaurant::findOrFail($request->input('restaurant_id'));
        if(Auth::user()->can('update', $restaurant)){
            $input = $request->all();
            $this->validate($request, [
                'restaurant_id' => 'required|integer',
                'coupon_type' => 'required|string',
                'coupon_description' => 'string',
                'discount_type' => 'required|string',
                'coupon_percent_discount' => 'integer|min:0|max:100',
                'coupon_amount_discount' => 'integer',
                'quantity' => 'integer',
                'coupon_validity_date' => 'required|string'
            ]);
            $array_date = explode(' - ', $input['coupon_validity_date']);
            // $start_date = Carbon::createFromFormat('d/m/Y', $array_date[0]);
            $end_date = Carbon::createFromFormat('d/m/Y', $array_date[1]);
            $expires_in = Carbon::now()->diffInDays($end_date);
            if($expires_in == 0 || $end_date->isPast()){
                Session::flash('danger', 'Veillez renseignez une intervale de validité suppérieur ou égale à un jour !');
                return back();
            }
            $data = [
                'discount_type' => $input['discount_type'],
                'coupon_type' => $input['coupon_type'],
                'coupon_creation_type' => $input['coupon_creation_type'], 
                'coupon_description' => $input['coupon_description'], 
                'validity_date' => $input['coupon_validity_date'], 
                'start_at' => $array_date[0], 
                'end_at' => $array_date[1]
            ];

            if($input['discount_type'] == 'percent'){
                $data['discount_percent'] = $input['coupon_percent_discount'];
            }elseif($input['discount_type'] == 'amount'){
                $data['discount_amount'] = $input['coupon_amount_discount'];
            }

            if($input['coupon_type'] == 'all_user' || $input['coupon_type'] == 'some_user'){
                // Promocodes::create($amount = 1, $reward = null, array $data = [], $expires_in = null);
                $promocode_obj = Promocodes::create(1, null, $data, $expires_in, null)->first();
            }elseif($input['coupon_type'] == 'some_user'){
                $promocode_obj = Promocodes::create(1, null, $data, $expires_in, $request->quantity)->first();
            }elseif($input['coupon_type'] == 'one_user'){
                $promocode_obj = Promocodes::createDisposable(1, null, $data, $expires_in, null)->first();
            }
            $promocode = Promocode::where('code', $promocode_obj['code'])->first();
            $promocode->restaurant_id = $input['restaurant_id'];

            // Si l'user definit son code perso alors ...
            if($request->coupon_name){
                $promocode->code = $request->coupon_name;
            }
            $promocode->save();
            Session::flash('success', 'Le promocode ( '.$promocode->code.' ) à bien été créer !');
            return redirect(route('promocodes.edit', compact('promocode')));
        }
        return view('promocodes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function show(Promocode $promocode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function edit(Promocode $promocode)
    {
        return view('promocodes.edit', compact('promocode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promocode $promocode)
    {
        $restaurant = Restaurant::findOrFail($promocode->restaurant_id);
        if(Auth::user()->can('update', $restaurant)){
            $input = $request->all();
            $this->validate($request, [
                'coupon_type' => 'required|string',
                'coupon_description' => 'string',
                'discount_type' => 'required|string',
                'coupon_percent_discount' => 'integer|min:0|max:100',
                'coupon_amount_discount' => 'integer',
                'quantity' => 'integer',
                'coupon_validity_date' => 'required|string'
            ]);
            $array_date = explode(' - ', $input['coupon_validity_date']);
            // $start_date = Carbon::createFromFormat('d/m/Y', $array_date[0]);
            $end_date = Carbon::createFromFormat('d/m/Y', $array_date[1]);
            $expires_in = Carbon::now()->diffInDays($end_date);
            if($expires_in == 0 || $end_date->isPast()){
                Session::flash('danger', 'Veillez renseignez une intervale de validité suppérieur ou égale à un jour !');
                return back();
            }
            if($end_date->isPast()){
                $expires_in = -$expires_in;
            }
            $data = [
                'discount_type' => $input['discount_type'],
                'coupon_type' => $input['coupon_type'],
                'coupon_creation_type' => $input['coupon_creation_type'],  
                'coupon_description' => $input['coupon_description'], 
                'validity_date' => $input['coupon_validity_date'], 
                'start_at' => $array_date[0], 
                'end_at' => $array_date[1]
            ];

            if($input['discount_type'] == 'percent'){
                $data['discount_percent'] = $input['coupon_percent_discount'];
            }elseif($input['discount_type'] == 'amount'){
                $data['discount_amount'] = $input['coupon_amount_discount'];
            }

            if($input['coupon_type'] == 'some_user'){
                // $data['limited_user'] = $input['limited_user'];
                $promocode->quantity = $request->quantity;
                $is_disposable = false;
            }elseif($input['coupon_type'] == 'all_user'){
                // Promocodes::create($amount = 1, $reward = null, array $data = [], $expires_in = null);
                $is_disposable = false;
            }elseif($input['coupon_type'] == 'one_user'){
                $is_disposable = true;
            }
            $promocode->data = $data;
            $promocode->is_disposable = $is_disposable;
            $promocode->expires_at = $expires_in ? Carbon::now()->addDays($expires_in) : null;
            $promocode->save();
            Session::flash('success', 'Le promocode ( '.$promocode->code.' ) à bien été mis à jour !');
            return redirect(route('promocodes.edit', compact('promocode')));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promocode $promocode)
    {
        $restaurant = Restaurant::findOrFail($promocode->restaurant_id);
        if(Auth::user()->can('update', $restaurant)){
            $promocode->delete();
            return back()->with('success', 'Promocode deleted !');
        }
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clearRedundant(Request $request)
    {
        if(Auth::user()->isSuperAdmin()){
            Session::flash('success', 'Les code coupons redondants et expirés ont bien été supprimés !');
            Promocodes::clearRedundant();
        }
        return back();
    }
}
