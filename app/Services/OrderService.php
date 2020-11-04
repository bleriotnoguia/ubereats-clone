<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Invoice;
use App\Models\Restaurant;
use \DateTime;
use OneSignal;
use Auth;

class OrderService{
    
    public function generateOrderNumber(){
        $latestOrder = Order::withTrashed()->orderBy('created_at','DESC')->first();
        if($latestOrder){
            $number = str_pad(($latestOrder->id+1).rand_letter(), 6, "0", STR_PAD_LEFT);
        }else{
            $number = str_pad('1'.rand_letter(), 6, "0", STR_PAD_LEFT);
        }

        return $number;
    }

    public function generateInvoiceNumber(){
        $latestInvoice = Invoice::withTrashed()->orderBy('issue_date','DESC')->first();
        if($latestInvoice){
            $number = str_pad(($latestInvoice->id+1), 6, "0", STR_PAD_LEFT);
        }else{
            $number = str_pad('1', 6, "0", STR_PAD_LEFT);
        }

        return $number;
    }

    public function sendNotFoundNotification(){
        $params = []; 
        $params['include_player_ids'] = Auth::user()->onesignals->pluck('player_id')->toArray(); 
        $contents = [ 
        "en" => "Hello ".Auth::user()->full_name." ! Some items in your order are not available, you may need to refresh the app before resuming the order process !", 
        "fr" => "Hello ".Auth::user()->full_name." ! Certains articles de votre commande ne sont pas disponibles, vous devrez peut-être actualiser l'application avant de reprendre le processus de commande !"
        ]; 
        $params['contents'] = $contents; 
        OneSignal::sendNotificationCustom($params);
    }

    public function sendOrderDelayNotification(Order $order){
        // On indique au client que la commande a été aprouvé
        $date = new DateTime($order->delay_added);
        $contents = [ 
            "en" => "Hello ".$order->user->name." ! Your order number ". $order->number .", create ". $order->created_at->diffForHumans() ." has been delayed by ".$date->format('i')." minutes !", 
            "fr" => "Hello ".$order->user->name." ! Votre commande numéro ". $order->number .", crée ". $order->created_at->diffForHumans() ." a été retardé de ".$date->format('i')." minutes !"
        ];
        $data = [
            'order_id' => $order->id,
            'action' => 'order-delayed'
        ];
        
        $url ='ubereats://order/'.$order->id;
        self::notify($order->user, $contents, $data, $url); 
    }

    public function sendOrderNotification(Order $order){
        if($order->status == 'confirmed'){
            // On indique au client que la commande a été aprouvé
            $contents = [ 
                "en" => "Hello ".$order->user->name." ! Your order number ". $order->number .", create ". $order->created_at->diffForHumans() ." has been taken care of !", 
                "fr" => "Hello ".$order->user->name." ! Votre commande numéro ". $order->number .", crée ". $order->created_at->diffForHumans() ." a été prise en charge !"
            ];
            $data = [
                'order_id' => $order->id,
                'action' => 'order-confirmed' 
            ];
            
            $url ='ubereats://order/'.$order->id;

            self::notify($order->user, $contents, $data, $url);  
        }else if($order->status == 'ready'){
            // On indique au client que la commande a été aprouvé
            $contents = [ 
                "en" => "Hello ".$order->user->name." ! Your order number ". $order->number .", create ". $order->created_at->diffForHumans() ." is ready, a sender will pick it up and you will be delivered soon !", 
                "fr" => "Hello ".$order->user->name." ! Votre commande numéro ". $order->number .", crée ". $order->created_at->diffForHumans() ." un expéditeur la récupèrera et vous serez livré bientôt !"
            ];
            $data = [
                'order_id' => $order->id,
                'action' => 'order-ready'
            ];
            
            $url ='ubereats://order/'.$order->id;
            self::notify($order->user, $contents, $data, $url); 

        }else if($order->status == 'canceled'){
            $contents = [ 
                "en" => "Hello ".$order->user->name." ! Your order number ". $order->number .", create ". $order->created_at->diffForHumans() ." was canceled ! \nRaison : ".request()->get('cancellation_reason'), 
                "fr" => "Hello ".$order->user->name." ! Votre commande numéro ". $order->number .", crée ". $order->created_at->diffForHumans() ." a été annulée ! \nRaison : ".request()->get('cancellation_reason')
            ];
            $data = [
                'order_id' => $order->id,
                'action' => 'order-canceled' 
            ]; 

            $url ='ubereats://order/'.$order->id;

            self::notify($order->user, $contents, $data, $url);
            
        }else if($order->status == 'in_shipment'){
            // On notifie le client que sa commande est en cours de livraison
            $contents = [ 
                "en" => "Hello ".$order->user->name." ! Your order number ". $order->number .", create ". $order->created_at->diffForHumans() ." is being shipped ! \n Follow my order...", 
                "fr" => "Salut ".$order->user->name." ! Votre commande numéro ". $order->number .", crée ". $order->created_at->diffForHumans() ." est en cours de livraison ! \n Suivre votre commande..."
            ];
            // add data
            $data = [ 
                'order_id' => $order->id,
                'action_info' => 'order-in-shipment',
                'action' => 'start-tracking' 
            ];

            $url ='ubereats://traking/'.$order->id;
            self::notify($order->user, $contents, $data, $url);
            // On notifi le livreur de la recuration de la commande
            $contents = [
                "en" => "Hello ".$order->shipping->user->name." ! The order number ". $order->number .", create ".$order->created_at->diffForHumans() ." has been delivered to you. It is assumed that it is being shipped! \n Follow the route ...",
                "fr" => "Salut ".$order->shipping->user->name." ! La commande numéro ". $order->number .", crée ". $order->created_at->diffForHumans() ." vous a été remise. On suppose donc qu'elle est en cours de livraison ! \n Suivre l'itinéraire..."
            ];
            // add data
            $data = [ 
                'shipping_id' => $order->shipping->id,
                'action_info' => 'shipping-in-progress',
                'action' => 'start-tracking'
            ];
            $url ='dubereats://tracking/'.$order->shipping->id;
            self::notify($order->shipping->user, $contents, $data, $url);
        }
    }

    public function sendOrderShopNotification(Order $order){
        $contents = [ 
            "en" => "Hello ".$order->restaurant->user->name." ! New order number ". $order->number .", create ". $order->created_at->diffForHumans() ." is waiting for you to confirm !", 
            "fr" => "Hello ".$order->restaurant->user->name." ! Nouvelle commande numéro ". $order->number .", crée ". $order->created_at->diffForHumans() ." vous attends pour la confirmation !"
        ];
        $data = [
            'order_id' => $order->id,
            'action' => 'new-order'
        ];
        
        $url ='ubereats://order/'.$order->id;
        self::notify($order->restaurant->user, $contents, $data, $url); 
    }

    public function sendCanceledErrorNotification(Order $order){
        $contents = [
            "en" => "Hello ".$order->user->name." ! Your order number ". $order->number .", create ".$order->created_at->diffForHumans() ." was already confirmed by the restaurant. You can\'t cancel it!", 
            "fr" => "Salut ".$order->user->name." ! Votre commande numéro ". $order->number .", crée ". $order->created_at->diffForHumans() ." a déjà été prise en charge par le restaurant vous ne pouvez pas l'annuler !"
        ];
        self::notify($order->user, $contents);
    }

    /**
     * 
     */
    public function notify($user, $contents, $data = null, $url=null){
        $all_user_player_ids = $user->onesignals->pluck('player_id')->toArray();
        $params = []; 
        $params['include_player_ids'] = $all_user_player_ids; 
        $params['contents'] = $contents;
        $params['data'] = $data; 
        if($url){
            $params['url']=$url;
        }
        OneSignal::sendNotificationCustom($params);
    }
}