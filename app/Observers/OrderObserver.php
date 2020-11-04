<?php

namespace App\Observers;

use App\Jobs\sendNewShipmentNotificationJob;
use App\Jobs\sendUntakeShipmentNotificationJob;
use App\Notifications\OrderCreated;
use App\Notifications\OrderCanceled;
use App\Notifications\OrderConfirmed;
use App\Models\Order;
use App\Models\User;
use Notification;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $order->orderStatusHistory()
                ->create([
                    'status' => 'pending'
                    ]);
        $super_admin = User::whereHas('roles', function($query){
            $query->where('name', 'super-admin');
        })->first();
        Notification::send(
                        collect([$order->restaurant->user, $super_admin]), 
                        (new OrderCreated($order))->onConnection('database')
                        ->onQueue('default')
                        ->delay(10)
                    );
    }

    /**
     * Handle the order "updating" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updating(Order $order){
        if($order->isDirty('status')){
            $old_status = $order->getOriginal('status');
            $new_status = $order->status;
            if($old_status == "pending" && $new_status == 'ready'){
                $order->orderStatusHistory()
                ->create([
                    'status' => 'confirmed'
                    ]);
            }
            $order->orderStatusHistory()
                ->create([
                    'status' => $new_status
                    ]);
        }
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        if($order->status == 'confirmed'){
            $order->shipping()->update([
                'status' => 'pending'
            ]);
            $order->user->notify((new OrderConfirmed($order))->delay(now()->addSeconds(10)));
        }else if($order->status == 'ready'){
            // TODO : Refactoring : Filter this table to get only the $shippers list who have the same postal_code with restaurant linked to this order
            $shippers = User::shipper()
                            ->available()
                            ->whereHas('tracking', function($query){
                                $query->where([
                                    ['longitude', '!=', null],
                                    ['latitude', '!=', null]
                                ]);
                            })
                            ->get();
            $distance_list = [];
            foreach($shippers as $shipper){
                if($shipper->postal_code && $order->restaurant->postal_code && ($shipper->postal_code == $order->restaurant->postal_code)){
                    $shipper_located_at = round(
                        // helper function
                        distance(
                            $shipper->tracking->latitude, 
                            $shipper->tracking->longitude, 
                            $order->restaurant->latitude,
                            $order->restaurant->longitude
                        ), 3);
                    $distance_list[$shipper->id] = $shipper_located_at;
                }
            }
            asort($distance_list);
            foreach($distance_list as $key => $value){
                $shipper = User::find($key);
                // Ensuite, on attend 10s avant de notifier le prochain livreur
                sendNewShipmentNotificationJob::dispatch($order, $shipper)->delay(now()->addSeconds(10));
            }
            // On notifie le restaurateur si aucun livreur n'a pris la commande
            sendUntakeShipmentNotificationJob::dispatch($order->restaurant, $order)->delay(now()->addSeconds(10));
        }else if($order->status == 'in_shipment'){
            $order->shipping()->update([
                'status' => 'in_progress' 
            ]);
        }else if($order->status == 'canceled'){
            // On annule la livraison lié à cette commande
            $order->shipping()->update([
                'status' => 'canceled'
            ]);
            // On notifie l'utilisateur et le super-admin que la commande a été annulée
            $super_admin = User::whereHas('roles', function($query){
                $query->where('name', 'super-admin');
            })->first();
            Notification::send(collect([$order->user, $super_admin]), new OrderCanceled($order));
        }
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        $order->invoice->delete();
        $order->shipping->delete();
        $order->notation->delete();
    }

    /**
     * Handle the order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        $order->invoice->restore();
        $order->shipping->restore();
        $order->notation->restore();
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        $order->invoice->forceDelete();
        $order->shipping->forceDelete();
        $order->notation->forceDelete();
    }
}
