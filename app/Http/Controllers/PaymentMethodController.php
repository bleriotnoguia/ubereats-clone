<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Auth;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_methods = PaymentMethod::all();
        return view('paymentmethods.index', compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $payment_method = new paymentMethod();
        // return view('paymentmethods.create',compact('payment_method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        //
    }

     /**
     * Toggle Availability of item
     * 
     */
    public function toggleActivation(Request $request){
        $payment_method = PaymentMethod::findOrFail($request->payment_method_id);
        if(Auth::user()->isSuperAdmin()){
            $payment_method->active = $request['active'];
            $payment_method->save();
            return response()->json(
                [
                    'success' => true,
                    'message'=> 'Mise à jour réussie !', 
                    'data' => $payment_method
                ], 200);
        }
        return response()->json(
                [
                    'success' => false, 
                    'message' => 'Echec de mise à jour. \n Vous n\'avez pas les droits pour effectuer cette action.'
                ], 404);
    }
}
