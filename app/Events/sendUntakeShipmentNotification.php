<?php

namespace App\Events;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class sendUntakeShipmentNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $restaurant;
    public $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Restaurant $restaurant, Order $order)
    {
        $this->restaurant = $restaurant;
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.Models.User.'.$this->restaurant->user->id);
    }
}
