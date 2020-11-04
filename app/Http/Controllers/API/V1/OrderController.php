<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\OrderService;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Models\Supplement;
use App\Models\Restaurant;
use App\Models\OrderLine;
use App\Models\Promocode;
use App\Models\Setting;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Item;
use Promocodes;
use Validator;
use Auth;
use DB;

class OrderController extends BaseController
{
    /**
     * Display a listing of the ressource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function index(Request $request)
    {
        if($request->is_merchant){
            $orders = Order::with('restaurant')
                    ->where('user_id', Auth::user()->id)
                    ->whereHas('restaurant', function($query) use($request){
                        $query->where('is_merchant', $request->is_merchant);
                    })
                    ->latest()
                    ->paginate(10);
        }else{
            $orders = Order::with('restaurant')
                    ->where('user_id', Auth::user()->id)
                    ->latest()
                    ->paginate(10);
        }
        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Services\OrderService $orderService
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, OrderService $orderService)
    {
        if(Auth::user()->can('create', Order::class)){
            $input = $request->all();

            $validator = Validator::make($input, [
                'shipping_data' => 'required'
            ]);
            
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors()); 
            }

            $validator = Validator::make($input['shipping_data'], [
                // 'name' => 'required',
                // 'email' => 'required',
                // 'phone_number' => 'required',
                'gmap_address' => 'required',
                'address_description' => 'string'
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors()); 
            }

            $validator = Validator::make($input['payment_data'], [
                'payment_method_id' => 'required'
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors()); 
            }
            // checkout - $request, $orderService, $who [ o -> order, c -> checkout ]
            $response_data = self::checkout($request, $orderService, 'o')->getData();
            if(!$response_data->success){
                return (array)$response_data;
            }
            $order_elt = json_decode(json_encode($response_data->data), true);
            if(isset($input['coupon_code']) && !empty($input['coupon_code'])){
                $code_array = $input['coupon_code'];
                $promocodes = [];
                foreach($code_array as $code){
                    $check_code = self::checkCode($code)->getData();
                    if(!$check_code->success){
                        return response()->json($check_code);
                    }
                    if($check_code->data->restaurant_id != $input['restaurant']['restaurant_id']){
                        return $this->sendError('One of the coupon codes pass in set does not correspond to the restaurant related to your orders');
                    }
                    $coupon_data = (array)$check_code->data;
                    array_push($promocodes, $coupon_data);

                    Auth::user()->applyCode($code);
                }
            }
            $order = new Order();
            $order->number = $orderService->generateOrderNumber();
            $order->restaurant_id = $order_elt['restaurant_id'];
            // $order->comment = $order_elt['comment'];
            $order->user_id = Auth::user()->id;
            if(isset($promocodes)){
                foreach($promocodes as $coupon_code){
                    if($coupon_code['restaurant_id'] == $order_elt['restaurant_id']){
                        // TODO : Ajouter tous les coupons code dans le coupon_data
                        $order->coupon_data = $coupon_code;
                        break;
                    }
                }
            }
            $order->save();
            $order->orderLines()->createMany($order_elt['order_lines']);
            if($order->restaurant->shipping_fee == null){
                $shipping_fee = Setting::where('key', 'shipping_fee')->first()->value;
            }else{
                $shipping_fee = $order->restaurant->shipping_fee;
            }
            $order->shipping()->create([
                'status' => 'pending', 
                'fee' => $shipping_fee,
                'planned_at' => isset($input['shipping_data']['planned_at']) ? $input['shipping_data']['planned_at'] : null
                ]);
            $order->shipping->address()->create([
                'gmap_address' => $input['shipping_data']['gmap_address'],
                'description' => isset($input['shipping_data']['address_description']) ? $input['shipping_data']['address_description'] : null
            ]);
            if(!empty($input['shipping_data']['name']) && !empty($input['shipping_data']['phone_number']) && !empty($input['shipping_data']['email'])){
                $order->shipping->recipient()->create([
                    'name' => $input['shipping_data']['name'],
                    'phone_number' => $input['shipping_data']['phone_number'],
                    'email' => $input['shipping_data']['email']
                ]);
            }
            $invoiceNumber = $orderService->generateInvoiceNumber();
            $payment_methods = PaymentMethod::find($input['payment_data']['payment_method_id']);
            // Dans le cas paiement à la livraison
            if($payment_methods->code == "cashondelivery"){
                $order->invoice()->create([
                    'total'=>$order->total_to_pay, 
                    'status'=>'unpaid',
                    'number' => $invoiceNumber
                ]);
                $order->invoice->payment()->create([
                    'user_id' => $order->user_id,
                    'status' => 'undeposit',
                    'amount_paid' => null,
                    'payment_method_id' => $input['payment_data']['payment_method_id'],
                    'payment_id' => null,
                    'meta' => isset($input['payment_data']['meta']) ? $input['payment_data']['meta'] : null
                ]);
            }else{
                $order->invoice()->create([
                    'total'=>$order->total_to_pay, 
                    'status'=>'paid',
                    'number' => $invoiceNumber
                ]);
                $order->invoice->payment()->create([
                    'user_id' => $order->user_id,
                    'status' => 'deposit',
                    'amount_paid' => $input['payment_data']['amount_paid'],
                    'payment_method_id' => $input['payment_data']['payment_method_id'],
                    'payment_id' => $input['payment_data']['payment_id'],
                    'meta' => isset($input['payment_data']['meta']) ? $input['payment_data']['meta'] : null
                ]);
            }
            $orderService->sendOrderShopNotification($order);
            
            return $this->sendResponse($order->toArray(), 'Your orders have been successfully created');
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->load(['restaurant', 'notation', 'invoice.payment', 'shipping', 'shipping.user', 'shipping.notation']);
        if(Auth::user()->can('view', $order)){
            if (is_null($order)) {
                return $this->sendError('Order not found.');
            }
            return $this->sendResponse($order->toArray(), 'Order retrieved successfully.');
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order, OrderService $orderService)
    {
        if(Auth::user()->can('update', $order)){

            if($request->status && $request->status == 'canceled'){
                if($order->status = 'canceled'){
                    // Juste pour éviter d'effectuer des requettes innutiles
                    return response()->json(['success' => true, 'message' => 'Order canceled successfully.']);
                }
                if($order->status != 'pending' && $order->status != 'canceled'){
                    $order->sendCanceledErrorNotification($order);
                    return response()->json(['success'=> false, 'message' => 'Order was already confirmed by the restaurant. You can\'t update it.']);
                }
                $order->status = 'canceled';
                $order->save();

                $order->shipping()->update([
                    'status' => 'canceled'
                ]);
                $orderService->sendOrderNotification($order);
                return response()->json(['success' => true, 'message' => 'Order canceled successfully.']);
            }

            $input = $request->all();
            $validator = Validator::make($input, [
                'order_lines' => 'required|array'
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }

            if($order->status != 'pending' && $order->status != 'canceled'){
                return response()->json(['success'=> false, 'message' => 'Order was already confirmed by the restaurant. You can\'t update it.']);
            }

            $order->comment = $request->input('comment');
            $order->save();
            
            $order_lines = $request->input('order_lines');

            $validator = Validator::make($order_lines, [
                '*.id' => 'required|integer',
                '*.item_id' => 'integer',
                '*.quantity' => 'integer'
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
            foreach ($order_lines as $line) {
                if(isset($line['id'])){
                    $linetoupdate = OrderLine::findOrFail($line['id']);
                    $linetoupdate->update($line);
                }else{
                    OrderLine::create($line);
                }
            }
            $order->shipping->address()->update([
                'gmap_address' => $input['shipping_data']['address'],
                'description' => $input['shipping_data']['address_description']
            ]);
            return $this->sendResponse($order->toArray(), 'Order updated successfully.');
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if(Auth::user()->can('delete', $order)){
            if($order->status != 'pending' && $order->status != 'canceled'){
                return response()->json(['success'=> false, 'message' => 'Order was already confirmed by the restaurant. You can\'t cancel or delete it.']);
            }
            $order->delete();
            return response()->json(['success'=> true, 'message' => 'Order deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized']);
    }

    /**
     * Return orders per status
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderByStatus(Request  $request){
        $validator = Validator::make($request->all(), [
            'is_merchant' => 'required|integer',
            'status' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors()); 
        }
        $orders = Order::with(['restaurant', 'user'])
                        ->whereIn('status', $request->status)
                        ->where('user_id', Auth::user()->id)
                        ->whereHas('restaurant', function($query) use($request){
                            $query->where('is_merchant', $request->is_merchant);
                        })
                        ->latest()
                        ->paginate(10);
        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully !');
    }

    /**
     * Return Order status
     * @param  \App\Models\Order $order
     */
    public function orderStatus(Order $order){
        return response()->json([
            'success'=>true,
            'order_status'=> $order->status,
            'message'=>'Order status successfully retrieved'
        ]);
    }

    /**
     * Check if the coupon code is valid
     * 
     * @param string $code
     * @return \Illuminite\Http\Response
     */
    public function checkCode($code){
            $promocode = Promocode::byCode($code)->first();
            if ($promocode === null) {
                $data['response_code'] = 1;
                return $this->sendError('Invalid promotion code. This promode code does not exit', $data);
            }
            if ($promocode->isExpired() || ($promocode->isDisposable() && $promocode->users()->exists())) {
                $data['response_code'] = 2;
                return $this->sendError('Invalid promotion code : This promode code is expired or the offer is no longer valid', $data);
            }
            if(in_array(Auth::user()->id, $promocode->users->pluck('id')->toArray())){
                $data['response_code'] = 3; 
                return $this->sendError('Promotion code is already used by current user.', $data);
            }else{
                $coupon_type = $promocode->data->coupon_type;
                if($coupon_type == 'some_user' && $promocode->isOverAmount()){
                    return $this->sendError('limit user reached', ['response_code' => 5]);
                }
                $discount_type = $promocode->data->discount_type;
                if($discount_type == 'percent'){
                    $data['code'] = $code;
                    $data['discount_percent'] = $promocode->data->discount_percent;
                    $data['restaurant_id'] = $promocode->restaurant_id;
                }elseif($discount_type == 'amount'){
                    $data['code'] = $code;
                    $data['discount_amount'] = $promocode->data->discount_amount;
                    $data['currency'] = env('CURRENCY_CODE');
                    $data['restaurant_id'] = $promocode->restaurant_id;
                }
                $data['discount_type'] = $discount_type;
                $data['response_code'] = 4;
                return $this->sendResponse($data, 'This coupon code is valid !');
                
            }
    }

    /**
     * Checkout
     * 
     * @param string $data
     * @return \Illuminite\Http\Response
     */
    public function checkout(Request $request, OrderService $orderService, $who='c'){
        $input = $request->all();

        $validator = Validator::make($input['restaurant'], [
            'restaurant_id' => 'required',
            'data' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors()); 
        }

        $validator = Validator::make($input['restaurant']['data'], [
            '*.items' => 'required',
            '*.quantity' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors()); 
        }

        $restaurant = $input['restaurant'];
        $order_lines = [];
        foreach($restaurant['data'] as $line){
            try{
                $item = Item::find($line['items']['id']);
                if(!$item){
                    $orderService->sendNotFoundNotification();
                    throw new \Exception('Item with ID '.$line['items']['id'].' not found');
                }
            } catch(\Exception $ex){
                return $this->sendError('Item not found. Please refresh the page.'.$ex);
            }
           if($who =='o'){
            array_push($order_lines, [
                'model_id' => $item->id,
                'model_type' => Item::class,
                'model_price' => $item->price, 
                'quantity' => $line['quantity'],
                'comment' => $line['comment'],
                "is_available" => $item->is_available,
                "item_name" => $item->name
                ]);

           }else if($who == 'c' && !$item->is_available){
            array_push($order_lines, [
                'model_id' => $item->id,
                'model_type' => Item::class,
                'model_price' => $item->price, 
                'quantity' => $line['quantity'],
                'comment' => $line['comment'],
                "is_available" => $item->is_available,
                "item_name" => $item->name
                ]);
           } 
            if(isset($line['supplements'])){
                foreach($line['supplements'] as $line_s){
                    try{
                        $supplement = Supplement::find($line_s['id']);
                        if(!$supplement){
                            $orderService->sendNotFoundNotification();
                            throw new \Exception('Item with ID '.$line_s['id'].' not found');
                        }
                    } catch(\Exception $ex){
                        return $this->sendError('Item not found. Please refresh the page.'.$ex);
                    }
                     if($who == 'o'){
                        array_push($order_lines, [
                        'model_id' => $supplement->id,
                        'model_type' => Supplement::class,
                        'model_price' => $supplement->price,
                        "is_available" => $supplement->is_available,
                        "supplement_name" => $supplement->name,  
                        'quantity' => 1 // nombre de supplements par defauts
                        ]);
                     }else if($who == 'c' && !$supplement->is_available){
                        array_push($order_lines, [
                            'model_id' => $supplement->id,
                            'model_type' => Supplement::class,
                            'model_price' => $supplement->price,
                            "is_available" => $supplement->is_available,
                            "supplement_name" => $supplement->name,  
                            'quantity' => 1 // nombre de supplements par defauts
                            ]);
                     }
                    
                }
            }
        }
        $order_elt = [
            'restaurant_id' => $restaurant['restaurant_id'],
            'order_lines' => $order_lines
        ];
        return $this->sendResponse($order_elt, 'Checkout : Response !');
    }
}
