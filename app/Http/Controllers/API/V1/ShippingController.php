<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Jobs\sendNewShipmentNotificationJob;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\ShippingService;
use App\Events\SendLocation;
use App\Models\Tracking;
use App\Models\Setting;
use App\Models\Order;
use \Carbon\Carbon;
use OneSignal;
use Auth;
use DB;

class ShippingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = Shipping::with('order')
                                ->where('user_id', Auth::user()->id)
                                ->latest()
                                ->paginate(10);
        return $this->sendResponse($shippings->toArray(), 'Shippings retrieved successfully.');
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
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        if(Auth::user()->can('view', $shipping)){
            /**
             * La ligne suivante permet d'avoir la route order>restaurant>address 
             * pour recuperer l'address de depart depuis l'objet "shipping" 
             */
            $shipping->load('recipient', 'order.restaurant', 'order.user');
            return $this->sendResponse($shipping, 'Shipping retrieved successfully.');
        }
        return $this->sendError('Unauthorized');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipping  $shipping
     * @param \App\Services\ShippingService $shippingService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping, ShippingService $shippingService)
    {
        // l'update est utilisé pour faire passer le status de l'expedition a "done"
        if(Auth::user()->can('update', $shipping)){
            if($shipping->status == 'done'){
                return $this->sendError('This shipment has already been done');
            }elseif($shipping->status == 'in_progress'){
                return $this->sendError('the status of this shipment was aleady set to "in_progress"');
            }
            if($request->status == 'done'){
                $shipping->status = $request->status;
                $shipping->shipped_at = Carbon::now(); 
                $shipping->save();
                // On effectue un depot sur le compte du livreur
                $shipping_fee = Setting::where('key', 'shipping_fee')->first()->value;
                $shipping->user->deposit($shipping_fee, 'deposit', [
                    'shipping_fee' => $shipping_fee,
                    'order_number' => $shipping->order->number,
                    'order_id' => $shipping->order->id
                    ]);
                // on notifie le client et le livreur du bon deroulement de la livraison
                $shippingService->sendShippingNotification($shipping);
                return $this->sendResponse($shipping, 'Shipping successfuly updated');
            }elseif($request->status == 'in_progress'){
                $shipping->status = $request->status;
                $shipping->save();
                // on notifie le client et le livreur que la livraison est en cours
                $shippingService->sendShippingNotification($shipping);
            }else{
                return $this->sendError('You can only change the status to "done" or to "in_progress" ');
            }
        }
        return $this->sendError('Unauthorized');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        //
    }

    /**
     * Get shipping by status
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function shippingByStatus(Request $request){
        if(is_array($request->status)){
            $shippings = Shipping::with(['order', 'order.restaurant', 'recipient'])
                        ->whereIn('status', $request->status)
                        ->where('user_id', Auth::user()->id)
                        ->latest()
                        ->paginate(10);
        }else if($request->status == 'pending'){
            $shippings = Shipping::with(['order', 'order.restaurant', 'recipient'])
                            ->where('status',$request->status)
                            ->whereHas('order', function(Builder $query){
                                /**
                                 * Si le status de la commande liée a cette livraison est "pending" 
                                 * alors celle-ci n'a pas encore été approuver l'admin du resto. 
                                 * On ne l'affiche donc pas sur l'appli du livreur.
                                 */
                                return $query->where('status', '!=', 'pending');
                            })
                            ->latest()
                            ->paginate(10);
        }else{
            $shippings = Shipping::with(['order', 'order.restaurant', 'recipient'])
                                    ->where('status',$request->status)
                                    ->where('user_id', Auth::user()->id)
                                    ->latest()
                                    ->paginate(10);
        }
        return $this->sendResponse($shippings->toArray(), 'Shippings retrieved successfully.');
    }

    /**
     * Prise en charge d'une commande par un livreur
     * 
     * @param \Illuminate\Http\Request  $request
     */
    public function takeShipping(Request $request, Shipping $shipping, ShippingService $shippingService){
        $setting = Setting::where('key', 'max_simultaneous_shipments')->first();
        if(!$setting){
            return $this->sendError('Wait for the super admin to set the maximum number of simultaneous shipments before you start using this feature!');
        }
        $max_simultaneous_shipments = $setting->value;
        $shipping_count = Auth::user()->shippings()->whereIn('status', ['planned', 'in_progress'])->count();
        if($shipping_count >= $max_simultaneous_shipments){
           return $this->sendError('Maximum number of simultaneous shipments reached. You can not manage more than '.$max_simultaneous_shipments.' orders simultaneously');
        }
        if($shipping->status == 'pending'){
            $shipping->user_id = Auth::user()->id;
            $shipping->status = 'planned';
            $shipping->save();
            $shipping->load('order');
            $shippingService->sendShippingNotification($shipping);
            return $this->sendResponse($shipping, 'This shipping was successfully assigned to you !');
        }else{
            $shippingService->sendUnavailableShippingNotification(Auth::user());
            return $this->sendError('This shipment has already been taken or canceled');
        }
    }

    /**
     * Refus de la prise en charge de la commande
     * 
     * @param \Illuminate\Http\Request  $request
     */
    public function refuseShipping(Shipping $shipping){
        // On verifie si c'est le dernier de notre table avant de refaire le tour
    }

    /**
     * Update position of shipper
     * 
     * @param \Illuminate\Http\Request  $request  
     */
    public function updatePosition(Request $request){

        $tracking = Auth::user()->tracking()->updateOrCreate(
                [
                    'user_id' => Auth::user()->id
                ],
                [ 
                    'longitude' => $request->longitude, 
                    'latitude' => $request->latitude
                ]
            );
        return $this->sendResponse($tracking, 'Positions updated successfully.');
    }

    /**
     * Get position of the shipper
     * 
     * @param \Illuminate\Http\Request  $request  
     * @return \Illuminate\Http\Response
     */
    public function getOrderPosition(Request $request){
        $order = Order::where('id', $request->order_id)->first();
        if($order->shipping->user){
            $tracking = $order->shipping->user->tracking;
        }else{
            $tracking = [
                "restaurant_id" => $order->restaurant->id,
                "order_id" => $order->id,
                "latitude" => $order->restaurant->latitude,
                "longitude" => $order->restaurant->longitude
            ];
        }
        return $this->sendResponse($tracking, 'Positions retrieved successfully.');
    }

    /**
     * Demo update shipper position
     */
    public function demoUpdatePosition(Request $request){
        event(new SendLocation([
            "lat" => $request->latitude,
            "long" => $request->longitude,
            "shipper_id" => $request->shipper_id
        ]));
    }
}
