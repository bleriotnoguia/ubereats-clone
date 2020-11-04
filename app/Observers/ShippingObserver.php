<?php

namespace App\Observers;

use App\Models\Shipping;
use App\Models\Tracking;

class ShippingObserver
{
    /**
     * Handle the shipping "created" event.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return void
     */
    public function created(Shipping $shipping)
    {
        //
    }

    /**
     * Handle the shipping "updated" event.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return void
     */
    public function updated(Shipping $shipping)
    {
        if($shipping->status == 'in_progress'){
            $shipping->order()->update(['status' => 'in_shipment']); 
        }elseif($shipping->status == 'done'){
            $shipping->order()->update(['status' => 'shipped']);
        }
    }

    /**
     * Handle the shipping "deleted" event.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return void
     */
    public function deleted(Shipping $shipping)
    {
        $shipping->recipient->delete();
        $shipping->notation->delete();
        $shipping->address->delete();
    }

    /**
     * Handle the shipping "restored" event.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return void
     */
    public function restored(Shipping $shipping)
    {
        $shipping->recipient->restore();
        $shipping->notation->restore();
        $shipping->address->restore();
    }

    /**
     * Handle the shipping "force deleted" event.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return void
     */
    public function forceDeleted(Shipping $shipping)
    {
        $shipping->recipient->forceDelete();
        $shipping->notation->forceDelete();
        $shipping->address->forceDelete();
    }
}
