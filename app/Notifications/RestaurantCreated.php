<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Models\Restaurant;

class RestaurantCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $restaurant;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database', 'broadcast'];
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
                    ->line('Nouveau restaurant :'.$this->restaurant->name)
                    ->action('Voir le profile', route('restaurants.show', $this->restaurant));
                    // ->line('Thank you for using our application!');
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
            "restaurant" => [
                "id" => $this->restaurant->id,
                "name" => $this->restaurant->name,
                "location" => $this->restaurant->location,
                "created_at" => $this->restaurant->created_at,
                "is_merchant" => $this->restaurant->is_merchant,
                "profile_img" => $this->restaurant->profile_img
            ]
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            "restaurant" => [
                "id" => $this->restaurant->id,
                "name" => $this->restaurant->name,
                "location" => $this->restaurant->location,
                "created_at" => $this->restaurant->created_at,
                "is_merchant" => $this->restaurant->is_merchant,
                "profile_img" => $this->restaurant->profile_img
            ]
        ]);
    }
}
