<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $plain_password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($plain_password)
    {
        $this->plain_password = $plain_password;
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
        return (new MailMessage)
                    ->greeting('Merhaba ')
                    ->subject('Hoşgeldin')
                    ->line('Hesabınız oluşturuldu.')
                    ->line('Geçici şifreniz: '.$this->plain_password)
                    ->line('Değiştirmeyi unutmayın...')
                    ->action('Giriş İçin', url('/'))
            ;
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
