<?php

namespace App\Http\Controllers;

use App\Services\ShippingService;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Setting;
use App\Models\Order;
use App\Models\User;
use Session;
use Auth;

class ShippingController extends Controller
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
                $shippings = Shipping::latest()->get();
            }else{
                $orders = Order::with('shipping')->where('restaurant_id', $request->restaurant_id)->get();
                $shippings = $orders->pluck('shipping');
            }
        }else{
            $shippings = Shipping::whereIn('order_id', Auth::user()->restaurant->orders->pluck('id')->toArray())
                                    ->latest()
                                    ->get();
        }

        $shippingMen = $shippings->map(function($shipping, $key){
            return $shipping->user;
        })
        ->unique()
        ->filter(function($item, $key){
            return $item != null;
        })
        ->values();

        return view('shippings.index', compact('shippings', 'shippingMen'));
    }
        /**
     * Get position of the shipper
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getOrderPosition(Request $request){
        $order = Order::where('id', $request->order_id)->first();
        $tracking = $order->shipping->user->tracking;
        return  $tracking;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipping  $shipping
     * @param \App\Models\ShippingService $shippingService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping, ShippingService $shippingService)
    {
        /**
         * Une livraison prend le status 'planned' lorsqu'elle est attribuer a un livreur
         * On repasse le status a pending lorsque shipper_id = null
         * */
        $previous_shipper = $shipping->user;
        if(($shipping->status != 'in_progress') && ($shipping->status != 'done')){
            if($request->input('shipper_id')){
                $shipper = User::findOrFail($request->input('shipper_id'));
                $setting = Setting::where('key', 'max_simultaneous_shipments')->first();
                if(!$setting){
                    Session::flash('danger', 'Wait for the super admin to set the maximum number of simultaneous shipments before you start using this feature!');
                    return back();
                }
                $max_simultaneous_shipments = $setting->value;
                $shipping_count = $shipper->shippings()->whereIn('status', ['planned', 'in_progress'])->count();
                if($shipping_count >= $max_simultaneous_shipments){
                    Session::flash('danger', 'Nombre maximale d\'expédition simultanée atteint ! Un expéditeur ne peux pas gerer plus de '.$max_simultaneous_shipments.' commandes simultanemant'); 
                    return back();
                }
            }
            $shipping->update([
                'user_id' => $request->input('shipper_id'),
                'status' => $request->input('shipper_id') ? 'planned' : 'pending'
            ]);
            if(!empty($shipping->user)){
                if(empty($previous_shipper) || (!empty($previous_shipper) && !$shipping->user->is($previous_shipper)) ){
                    $shippingService->sendShippingNotification($shipping);
                }
            }
        }
        Session::flash('success', 'La livraison a bien été bien mis à jour ! !'); 
        return back();
    }

}


