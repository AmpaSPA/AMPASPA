<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ActaDisponible extends Notification
{
    use Queueable;

    protected $reunion;
    protected $fecha;

    /**
     * Create a new notification instance.
     */
    public function __construct($reunion, $fecha)
    {
        $this->reunion = $reunion;
        $this->fecha = $fecha;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable Usuario al que se envía la notificación
     *
     * @return array
     */
    public function via($notifiable)
    {
            return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable Instancia del objeto usuario a quien se dirige el mail
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
            $reunion = $this->reunion;
            $fecha = $this->fecha;

            return (new MailMessage)
                ->level('info')
                ->subject('Acta disponible')
                ->markdown('emails.acta_disponible', compact('notifiable', 'reunion', 'fecha'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable Usuario al que se envía la notificación
     *
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'acta' => $this->reunion->proceeding,
            'reunion' => $this->reunion,
            'meetingtype' => $this->reunion->meetingtype->tiporeunion
            ];
    }
}
