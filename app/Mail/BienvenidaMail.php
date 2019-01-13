<?php

namespace App\Mail;

use App\User as Socio;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BienvenidaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $socio;

    /**
     * Create a new message instance.
     * BienvenidaMail constructor.
     * @param Socio $socio
     */
    public function __construct(Socio $socio)
    {
        $this->socio = $socio;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        $tipopago = $this->socio->paymenttype->tipopago;
        $numdoc = $this->socio->numdoc;
        $nombre_completo = $this->socio->nombre.' '. $this->socio->apellidos;
        $correo = $this->socio->email;
        $adjunto = public_path('assets/docs/'.$this->socio->id.'/adhesion/').$numdoc.'.pdf';

        return $this->view('emails.bienvenida', compact('numdoc', 'tipopago', 'correo'))->to($correo)->subject('Adhesión de '.$nombre_completo)->attach($adjunto);
    }
}
