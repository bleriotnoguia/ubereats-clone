<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class OrderCanceled extends Notification
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($notifiable->isSuperAdmin()){
            return (new MailMessage)
                    ->error()
                    ->greeting('Hello '.$notifiable->full_name.' !')
                    ->line('The order number '.$this->order->number.', created at '.$this->order->created_at.' was canceled !.')
                    ->line('By the restaurant : '.$this->order->restaurant->name)
                    ->line('Contact the restaurant support if you think there is no reason to canceled it.');
        }
        return (new MailMessage)
                    ->error()
                    ->greeting('Hello '.$notifiable->full_name.' !')
                    ->line('Sorry your order number '.$this->order->number.', created at '.$this->order->created_at.' was canceled !.')
                    ->line('By the restaurant : '.$this->order->restaurant->name)
                    ->line('Contact the restaurant support if you think there is no reason to canceled it.')
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
            //
        ];
    }
}
