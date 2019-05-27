<?php
/**
 * PHP VERSION 7.2.5
 *
 * @category PHP
 * @package  Ampaspa
 * @author   Luis Ponce Melero <lpmelero@gmail.com>
 * @license  http://ampaspa.local FREE
 * @link     http://ampaspa.local
 */
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Clase del controlador para la administración de las actividades
 *
 * @category PHP
 * @package  Ampaspa
 * @author   Luis Ponce Melero <lpmelero@gmail.com>
 * @license  http://ampaspa.local FREE
 * @link     http://ampaspa.local
 */
class ReunionConvocada extends Notification
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
            $convocada = $this->reunion;
            $temas = $convocada->topics;
            $fecha = $this->fecha;

            return (new MailMessage)
                ->level('info')
                ->subject('Reunión convocada')
                ->markdown('emails.reunion_convocada', compact('notifiable', 'convocada', 'fecha', 'temas'));
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
            'reunion' => $this->reunion,
            'attendees' => $this->reunion->attendees,
            'topics' => $this->reunion->topics,
            'meetingtype' => $this->reunion->meetingtype->tiporeunion
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
