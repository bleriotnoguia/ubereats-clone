<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Models\Order;

class OrderCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello '.$notifiable->full_name.' !')
                    ->line('New order created.')
                    ->line('Order number : '.$this->order->number)
                    ->action('Show details', route('orders.show', $this->order))
                    ->line($notifiable->isShopAdmin() ? 'The order is waiting for your approval' : '')
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "order" => [
                "id" => $this->order->id,
                "number" => $this->order->number,
                "created_at" => $this->order->created_at,
                "updated_at" => $this->order->updated_at,
                "restaurant_id" => $this->order->restaurant_id,
                "status" => $this->order->status,
            ]
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
                "order" => [
                    "id" => $this->order->id,
                    "number" => $this->order->number,
                    "created_at" => $this->order->created_at,
                    "updated_at" => $this->order->updated_at,
                    "restaurant_id" => $this->order->restaurant_id,
                    "status" => $this->order->status,
                ]
            ]);
    }
}
