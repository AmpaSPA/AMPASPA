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
class ActividadPublicada extends Notification
{
    use Queueable;

    protected $actividad;
    protected $fecha;

    /**
     * Create a new notification instance.
     *
     * @param mixed $actividad Actividad que se envía la notificación
     * @param mixed $alumno    Usuario al que se envía la notificación
     * @return void
     */
    public function __construct($actividad, $alumno, $fecha)
    {
        $this->actividad = $actividad;
        $this->fecha = $fecha;
        $this->alumno = $alumno;
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
        $publicada = $this->actividad;
        $fecha = $this->fecha;
        $hijo = $this->alumno;

        return (new MailMessage)
            ->level('info')
            ->subject('Actividad publicada')
            ->markdown('emails.actividad_publicada', compact('notifiable', 'publicada', 'hijo', 'fecha'));
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
            //
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
