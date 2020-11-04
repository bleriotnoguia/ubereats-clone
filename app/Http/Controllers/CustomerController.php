<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isSuperAdmin()){
            $customers = User::latest()->customers()->get();
        }else{
            if(Auth::user()->restaurant){
                $customers = Order::where('restaurant_id', Auth::user()->restaurant->id)
                                    ->with('user')
                                    ->get()
                                    ->pluck('user')
                                    ->unique()
                                    ->values();
            }else{
                $customers = collect([]);
            }
        }
        return view('customers.index', compact('customers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $customer = $user;
        return view('orders.index', compact('customer'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
