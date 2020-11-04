<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetRequest extends Notification
{
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $subject = sprintf("[%s] %s", config('app.name'), "Reset Password");
        $url_token = url('ubereats://ubereats.com/resetpwd/'.$this->token);
        $url_browser = url('password/reset/link/'.$this->token);
        $name = $notifiable->name;
        return (new MailMessage)
                    ->markdown('mail.resetpassword', [
                                    'url_browser' => $url_browser,
                                    'url_token' => $url_token, 
                                    'name' => $name,
                                    'subject' => $subject,
                                ]
                            );
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
