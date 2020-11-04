<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Restaurant;

class RestaurantDeleted extends Notification implements ShouldQueue
{
    // use Queueable;

    protected $restaurant;
    
    public $connection = 'database';

    public $queue = 'default';

    public $delay = 10;

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
                    ->greeting('Hello ! '.$notifiable->full_name)
                    ->line('The restaurant : '.$this->restaurant->name.' was deleted');
        }else{
            return (new MailMessage)
                    ->greeting('Hello ! '.$notifiable->full_name)
                    ->line('Your restaurant : '.$this->restaurant->name.' was deleted');
        }
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
