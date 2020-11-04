<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Item;
use App\Models\User;
use \Carbon\Carbon;
use \DateTime;
use OneSignal;
use Auth;
use PDF;

class OrderController extends Controller
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
        // si c'est pas le super-admin, on retourne toute les commandes
        if($request->from && $request->to){
            $from = Carbon::createFromFormat('Y-m-d H:s:i', $request->from.' 00:00:00')->toDateTimeString();
            // On agrandit la borne inférieur pour respecter la logique de "whereBetween"
            $to = Carbon::createFromFormat('Y-m-d H:s:i', $request->to.' 00:00:00')->addDay()->toDateTimeString();
        }
        $order_data = ['restaurant', 'user', 'orderLines', 'orderLines.model', 'shipping', 'shipping.address', 'orderLines.model.media'];
        if(Auth::user()->isSuperAdmin()){
            if($request->restaurant_id == null){
                if($request->from && $request->to){
                    $orders = Order::with($order_data)
                    ->whereBetween('created_at', [$from, $to])
                                    ->latest()
                                    ->get();
                }else{
                    $orders = Order::with($order_data)
                    ->latest()->get();
                }
            }else{
                if($request->from && $request->to){
                    $orders = Order::with($order_data)
                    ->where('restaurant_id', $request->restaurant_id)
                                    ->whereBetween('created_at', [$from, $to])
                                    ->latest()
                                    ->get();
                }else{
                    $orders = Order::with($order_data)
                    ->where('restaurant_id', $request->restaurant_id)->latest()->get();
                }
            }
        }else{
                if(Auth::user()->restaurant){
                    if($request->from && $request->to){
                        $orders = Auth::user()
                                        ->restaurant
                                        ->orders()
                                        ->with($order_data)
                                        ->whereBetween('created_at', [$from, $to])
                                        ->latest()
                                        ->get();
                    }else{
                        $orders = Auth::user()
                                        ->restaurant
                                        ->orders()
                                        ->with($order_data)
                                        ->latest()
                                        ->get();
                    }
                }else{
                    $orders = collect([]);
                }
            }
        return view('orders.index', compact('orders'));
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
                return view('orders.show', compact('order'));
            }
        }
        return back();
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
                    Session::flash('danger', 'La commande n\'a pas encore été attribué a un livreur !');
                    return back();
                }else if($input['status'] == 'canceled'){
                    $this->validate($request, [
                        'cancellation_reason' => 'required'
                    ]);
                }else if(($input['status'] == 'confirmed' || $input['status'] == 'canceled') && ($order->status != 'pending')){
                    Session::flash('danger', 'Cette action est non autorisée !');
                    return back();
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
                $this->validate($request, [
                    'delay_added' => 'required'
                ]);
                $order->delay_added = $input['delay_added'];
                $order->save();
                // Envoyer une notification au client pour l'indiquer que sa commande seras retardé de quelque minute
                $orderService->sendOrderDelayNotification($order);
            }
            Session::flash('success', 'L\'état de la commande bien été bien mis à jour !');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if(Auth::user()->isSuperAdmin()){
            $order->delete();
            Session::flash('success', 'La commande à bien été supprimé !');
        }
        return back();
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
      // If you want to store the generated pdf to the server then you can use the store function
      // $pdf->save(storage_path().'_filename.pdf');
      // Finally, you can download the file using download function
      return $pdf->download('order-'.$order->number.'.pdf');
    }

}
