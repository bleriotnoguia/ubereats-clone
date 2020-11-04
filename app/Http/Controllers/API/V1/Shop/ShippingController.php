<?php

namespace App\Http\Controllers\API\V1\Shop;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\ShippingService;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Setting;
use App\Models\User;
use Auth;

class ShippingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shippings = Shipping::whereIn('order_id', Auth::user()->restaurant->orders->pluck('id')->toArray())
                                    ->with('order')
                                    ->latest()
                                    ->paginate(config('global.api.pagination'));

        return $this->sendResponse($shippings->toArray(), 'Shippings successfully retrieved !');
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
                $shipper = User::Shipper()->findOrFail($request->input('shipper_id'));
                $setting = Setting::where('key', 'max_simultaneous_shipments')->first();
                if(!$setting){
                    return $this->sendError('Wait for the super admin to set the maximum number of simultaneous shipments before you start using this feature!');
                }
                $max_simultaneous_shipments = $setting->value;
                $shipping_count = $shipper->shippings()->whereIn('status', ['planned', 'in_progress'])->count();
                if($shipping_count >= $max_simultaneous_shipments){
                    return $this->sendError('Nombre maximale d\'expédition simultanée atteint ! Un expéditeur ne peux pas gerer plus de '.$max_simultaneous_shipments.' commandes simultanemant');
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
        }else{
            return $this->sendError('Cette action est non autorisée !');
        }
        return $this->sendResponse($shipping, 'La livraison a bien été bien mis à jour !');
    }
}


