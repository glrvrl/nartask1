<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * For welcome mail
     *
     * @var  $plain_password
     */
    private $plain_password;
    /**
     * user name
     *
     * @var  $name
     */
    private $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($plain_password, $name)
    {
        $this->plain_password = $plain_password;
        $this->name           = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Hoşgeldin ' . $this->name)
            ->greeting('Merhaba ' . $this->name)
            ->line('Hesabınız oluşturuldu.')
            ->line('Geçici şifreniz: ' . $this->plain_password)
            ->line('Değiştirmeyi unutmayın...')
            ->action('Giriş İçin', url('/'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
