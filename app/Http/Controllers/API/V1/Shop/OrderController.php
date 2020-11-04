<?php

namespace App\Http\Controllers\API\V1\Shop;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Order;
use App\Models\User;
use \Carbon\Carbon;
use Validator;
use Auth;
use PDF;

class OrderController extends BaseController
{
    public function __contruct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->from && $request->to){
            $from = Carbon::createFromFormat('Y-m-d H:s:i', $request->from.' 00:00:00')->toDateTimeString();
            // On agrandit la borne inférieur pour respecter la logique de "whereBetween"
            $to = Carbon::createFromFormat('Y-m-d H:s:i', $request->to.' 00:00:00')->addDay()->toDateTimeString();
        }
        $order_data = ['user', 'orderLines', 'orderLines.model', 'shipping', 'shipping.address', 'orderLines.model.media', 'orderStatusHistory'];
        if(Auth::user()->restaurant){
            $builder = Auth::user()
                        ->restaurant
                        ->orders()
                        ->with($order_data);

            if($request->from && $request->to){
                $builder->whereBetween('created_at', [$from, $to]);
            }

            if($request->status){
                $builder->whereIn('status', $request->status);
            }
            
            $orders = $builder->latest()
                                ->paginate(config('global.api.pagination'));
            $orders->load(['restaurant', 'shipping.recipient']);                    

        }else{
            $orders = collect([]);
        }
        return $this->sendResponse($orders->toArray(), 'Orders successfully retrieved !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if(Auth::user()->can('view', $order)){
            if(Auth::user()->can('view', $order)){
                $order->load(['restaurant', 'shipping.recipient', 'shipping.user', 'orderStatusHistory']); 
                return $this->sendResponse($order, 'Order successfully retrieved !');
            }
        }
        return $this->sendError('You can access this order');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order, OrderService $orderService)
    {
        $input = $request->all();
        if(Auth::user()->can('update', $order)){
            if(isset($input['status'])){
                // Rendre impossible de faire passer l'etat de la commande a "in_shipment" lorsque celle-ci n'a pas encore de livreur
                if($input['status'] == 'in_shipment' && !$order->shipping->user){
                    return $this->sendError('La commande n\'a pas encore été attribué a un livreur !');
                }else if($input['status'] == 'canceled'){
                    $this->validate($request, [
                        'cancellation_reason' => 'required'
                    ]);
                }else if(($input['status'] == 'confirmed' || $input['status'] == 'canceled') && ($order->status != 'pending')){
                    return $this->sendError('Cette action est non autorisée !');
                }
                $order_previous_state = $order->status;
                $order->status = $input['status'];
                if($input['status'] == 'ready'){
                    $order->ready_at = Carbon::now();
                }
                $order->save();
                if($input['status'] != $order_previous_state){
                    if($input['status'] == 'confirmed' || ($order->status == 'ready' && $order_previous_state == 'pending')){
                        
                        $ubereats_fee_percent = Setting::where('key', 'ubereats_fee_percent')->first()->value;

                        $ubereats_fee = $order->total*$ubereats_fee_percent/100;
                        $restaurant_earning = $order->total - $ubereats_fee;
                        // On retrouve le super-admin et ensuite on fait un depot dans son compte
                        $super_admin = User::whereHas('roles', function($query){
                            $query->where('name', 'super-admin');
                        })->first();
                        $super_admin->deposit($ubereats_fee, 'deposit', [
                            'ubereats_fee' => $ubereats_fee, 
                            'ubereats_fee_percent' => $ubereats_fee_percent, 
                            'order_total' => $order->total,
                            'order_number' => $order->number,
                            'order_id' => $order->id
                            ]);
                        
                        // On fait un depot dans le compte du restaurateur
                        $order->restaurant->user->deposit($restaurant_earning, 'deposit', [
                            'ubereats_fee' => $ubereats_fee, 
                            'ubereats_fee_percent' => $ubereats_fee_percent, 
                            'order_total' => $order->total,
                            'order_number' => $order->number,
                            'order_id' => $order->id
                            ]);
                    }
                    $orderService->sendOrderNotification($order);
                }
            }else if(isset($input['delay_added'])){
                $validator = Validator::make($request->all(), [
                    'delay_added' => 'required'
                ]);

                if ($validator->fails()) {
                    return $this->sendError('Validator error', $validator->errors());
                }

                $array_time = ['00:05:00', '00:10:00', '00:15:00', '00:20:00'];
                if(!in_array($input['delay_added'], $array_time)){
                    return response()->json([
                        'success' => false,
                        'message' => 'delay_added attribute can just take 4 values : '.implode(' | ', $array_time)
                        ]);
                }

                if($order->delay_added){
                    return response()->json([
                        'success' => false,
                        'message' => 'You can only delay the order once'
                        ]);
                }
                
                $order->delay_added = $input['delay_added'];
                $order->save();
                // Envoyer une notification au client pour l'indiquer que sa commande seras retardé de quelque minute
                $orderService->sendOrderDelayNotification($order);
            }
            return $this->sendResponse($order, 'L\'état de la commande bien été bien mis à jour !');
        }
        return $this->sendError('You do not have permission on this command');
    }

    /**
     * Convert a specified order to pdf.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function export_pdf(Order $order)
    {
      $data = ['order' => $order];
      // Send data to the view using loadView function of PDF facade
      $pdf = PDF::loadView('pdf.order', $data);
      return $pdf->download('order-'.$order->number.'.pdf');
    }

    /**
     * Get orders resume
     */
    public function getOrdersTotalByStatus(){
        $orders = Auth::user()->restaurant->orders;
        $data = [];
        $status_array = ['canceled', 'shipped', 'pending', 'in_shipment', 'confirmed', 'ready'];
        foreach($status_array as $status){
            $data[$status] = $orders->where('status', $status)->count();
        }
        return $this->sendResponse($data, 'Total orders by status successfull retrieved !');
    }

}
