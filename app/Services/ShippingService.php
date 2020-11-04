<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Shipping;
use App\Models\User;
use OneSignal;

class ShippingService{
    
    public function sendShippingNotification(Shipping $shipping){
        if($shipping->status == "planned"){
            // On notifie le livreur lorsque la commande lui a été assigné ou lorsque sa demande de prise en charge est approuvée
            $contents = [ 
                "en" => "Hello ".$shipping->user->name." ! The order number ". $shipping->order->number .", create ". $shipping->order->created_at->diffForHumans() ." has been assigned to you !", 
                "fr" => "Hello ".$shipping->user->name." ! La commande numéro ". $shipping->order->number .", crée ". $shipping->order->created_at->diffForHumans() ." vous a été attribué !"
            ]; 
            // add data
            $data = [ 
                'shipping_id' => $shipping->id,
                'action' => 'assigned-shipping'
            ];
            self::notify($shipping->user, $contents, $data); 
        }else if($shipping->status == 'in_progress'){
            // On notifi le livreur de la recuration de la commande
            $contents = [
                "en" => "Hello ".$shipping->user->name." ! The order number ". $shipping->order->number .", create ".$shipping->order->created_at->diffForHumans() ." has been delivered to you. It is assumed that it is being shipped! \n Follow the route ...",
                "fr" => "Salut ".$shipping->user->name." ! La commande numéro ". $shipping->order->number .", crée ". $shipping->order->created_at->diffForHumans() ." vous a été remise. On suppose donc qu'elle est en cours de livraison ! \n Suivre l'itinéraire..."
            ];
            // add data
            $data = [ 
                'shipping_id' => $shipping->id,
                'action_info' => 'shipping-in-progress',
                'action' => 'start-tracking'
            ];
            $url ='dubereats://tracking/'.$shipping->id;
            self::notify($shipping->user, $contents, $data, $url);
            // On notifie le client que sa commande est en cours de livraison
            $contents = [ 
                "en" => "Hello ".$shipping->order->user->name." ! Your order number ". $shipping->order->number .", create ". $shipping->order->created_at->diffForHumans() ." is being shipped ! \n Follow my order...", 
                "fr" => "Salut ".$shipping->order->user->name." ! Votre commande numéro ". $shipping->order->number .", crée ". $shipping->order->created_at->diffForHumans() ." est en cours de livraison ! \n Suivre votre commande..."
            ];
            // add data
            $data = [ 
                'order_id' => $shipping->order->id,
                'action_info' => 'order-in-shipment',
                'action' => 'start-tracking' 
            ];

            $url ='ubereats://traking/'.$shipping->order->id;
            self::notify($shipping->order->user, $contents, $data, $url);
        }else if($shipping->status == "done"){
            // Send notification to shipper
            $contents_for_shipper = [ 
                "fr" => "Hello ".$shipping->user->full_name." ! Merci d'avoir livré la commande ".$shipping->order->number.". A tres bientôt !", 
                "en" => "Hello ".$shipping->user->full_name." ! Thank you for delivering order ".$shipping->order->number.". See you soon !"
            ]; 
            $data_for_shipper = [
                'shipping_id' => $shipping->id,
                'action' => 'order-shipped',
                'url' => 'dubereats://shipping-detail/'.$shipping->id
            ];
            self::notify($shipping->user, $contents_for_shipper, $data_for_shipper);

            // Send notification to user how have order related to this shipping
            $contents_for_customer = [ 
                "fr" => "Hello ".$shipping->order->user->full_name." ! Votre commande numéro ".$shipping->order->number." a été livrée. Souhaitez-vous l'évaluer ?", 
                "en" => "Hello ".$shipping->order->user->full_name." ! Your order number ".$shipping->order->number." has been delivered. Would you like to rate it ?"
            ]; 
            $data_for_customer = [
                'order_id' => $shipping->order->id,
                'action' => 'order-shipped'
            ];
            self::notify($shipping->order->user, $contents_for_customer, $data_for_customer);
        }
    }

    public function sendNewShipmentNotification(Order $order, User $shipper){
        // On le notifie
        $contents = [ 
            "en" => "Hello ".$shipper->full_name." ! The order number ". $order->number .", create ". $order->created_at->diffForHumans() ." is available for support !", 
            "fr" => "Hello ".$shipper->full_name." ! La commande numéro ". $order->number .", crée ". $order->created_at->diffForHumans() ." est disponible pour la prise en charge !"
        ]; 
        // add data
        $data = [ 
            'shipping_id' => $order->shipping->id,
            'action' => 'new-shipment',
            'url' => 'dubereats://new-shipment/'.$order->shipping->id
        ];
        self::notify($shipper, $contents, $data); 
    }

    public function sendUnavailableShippingNotification(User $shipper){
        $contents = [ 
            "en" => "Hello ".$shipper->full_name." ! This shipment has already been supported or has been canceled !", 
            "fr" => "Hello ".$shipper->full_name." ! Cette livraison a déjà été pris en charge ou a été annulé !"
        ]; 
        // add data
        $data = [
            'action' => 'shipment-taked'
        ];
        self::notify($shipper, $contents, $data);
    }

    /**
     * 
     */
    public function notify($user, $contents, $data = null){
        $all_user_player_ids = $user->onesignals->pluck('player_id')->toArray();
        $params = []; 
        $params['include_player_ids'] = $all_user_player_ids; 
        $params['contents'] = $contents;
        $params['data'] = $data; 
        OneSignal::sendNotificationCustom($params);
    }
}