<?php
/**
 * PHP VERSION 7.2.5
 *
 * @category PHP
 * @package  Ampaspa
 * @author   Luis Ponce Melero <lpmelero@gmail.com>
 */
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Clase de la notificación Reunion cancelada
 */
class ReunionCancelada extends Notification
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
        $cancelada = $this->reunion;
        $temas = $cancelada->topics;
        $fecha = $this->fecha;

        return (new MailMessage)
            ->level('info')
            ->subject('Reunión cancelada')
            ->markdown('emails.reunion_cancelada', compact('notifiable', 'cancelada', 'fecha', 'temas'));
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
            'reunion' => $this->reunion
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable Usuario al que se envía la notificación
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
