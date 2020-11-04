<?php

namespace App\Jobs;

use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Events\sendUntakeShipmentNotification;

class sendUntakeShipmentNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $restaurant;
    public $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Restaurant $restaurant, Order $order)
    {
        $this->restaurant = $restaurant;
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->order->shipping->user == null){
            // Send notification to restaurant
            event(new sendUntakeShipmentNotification($this->restaurant, $this->order));
        }
    }
}
