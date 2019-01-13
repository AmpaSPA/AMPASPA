<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetearPassword extends ResetPassword
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
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
            ->level('info')
            ->subject('Recuperación de contraseña')
            ->greeting('Hola!!')
            ->line('Estás recibiendo este correo electrónico porque has solicitado regenerar una contraseña para tu cuenta.')
            ->action('Regenerar contraseña', route('password.reset', $this->token))
            ->line('Si no has realizado esta solicitud, no tienes que hacer nada más.')
            ->salutation('Saludos, '.config('app.name'))
            ->markdown('emails.reset_password_email');
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
