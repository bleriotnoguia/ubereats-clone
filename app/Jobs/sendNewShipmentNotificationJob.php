<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\ShippingService;
use App\Models\Order;
use App\Models\User;

class sendNewShipmentNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public $shipper;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, User $shipper)
    {
        $this->order = $order;
        $this->shipper = $shipper;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->order->shipping->user == null){
            $shippingService = new ShippingService();
            $shippingService->sendNewShipmentNotification($this->order, $this->shipper);
        }
    }
}
