<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Notation;

class NotationCreated extends Notification
{
    use Queueable;

    protected $notation;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Notation $notation)
    {
        $this->notation = $notation;
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
            if($this->type == 'order'){
                return (new MailMessage)
                    ->line('Hello !'. $notifiable->full_name)
                    ->line('Le restaurant [ '.$this->notation->restaurant->name.' ]')
                    ->line('a reçu une nouvelle notation pour sa commande '.$this->notation->order->number);
            }elseif($this->type == 'shipping'){
                return (new MailMessage)
                    ->line('Hello !'. $notifiable->full_name)
                    ->line('Le restaurant [ '.$this->notation->restaurant->name.' ]')
                    ->line('a reçu une nouvelle notation pour la livraison relative à sa commande '.$this->notation->order->number);
            }
        }else{
            if($this->type == 'order'){
                return (new MailMessage)
                    ->line('Hello !'. $notifiable->full_name)
                    ->line('Votre restaurant [ '.$this->notation->restaurant->name.' ]')
                    ->line('a reçu une nouvelle notation pour sa commande '.$this->notation->order->number);
            }elseif($this->type == 'shipping'){
                return (new MailMessage)
                    ->line('Hello !'. $notifiable->full_name)
                    ->line('Votre restaurant [ '.$this->notation->restaurant->name.' ]')
                    ->line('a reçu une nouvelle notation pour la livraison relative à sa commande '.$this->notation->order->number);
            }
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
