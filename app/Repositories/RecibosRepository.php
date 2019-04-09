<?php

namespace App\Repositories;

use App\Receipt;

class RecibosRepository
{
    protected $periodo;
    protected $socio;

    /**
     * SociosController constructor.
     * @param SocioRepository $socios
     */
    public function __construct(PeriodoRepository $periodo, SocioRepository $socio)
    {
        $this->periodo = $periodo;
        $this->socio   = $socio;
    }

    /**
     * buscarReciboUsuario
     */
    public function buscarReciboUsuario($id)
    {
        $periodo = $this->periodo->buscarPeriodoActivo();
        return Receipt::whereUserIdAndPeriodo($id, $periodo->periodo)->first();
    }

    /**
     * buscarRecibosUsuario
     */
    public function buscarRecibosUsuario($id)
    {
        return Receipt::whereUserId($id)->get();
    }

    /**
     * buscarRecibosActivosPorPeriodo
     */
    public function buscarRecibosActivosPorPeriodo($periodo)
    {
        return Receipt::whereEstadoAndPeriodo(true, $periodo)->get();
    }

    /**
     * crearReciboUsuario
     */
    public function crearReciboUsuario($id)
    {
        $periodo = $this->periodo->buscarPeriodoActivo();

        $recibo          = new Receipt();
        $recibo->user_id = $id;
        $recibo->periodo = $periodo->periodo;
        $recibo->importe = $periodo->cuota;

        $recibo->save();
    }

    /**
     * activarReciboUsuario
     */
    public function activarReciboUsuario($id)
    {
        $socio = $this->socio->buscarsocioporid($id);

        if ($socio->activo) {
            $recibo         = $this->buscarReciboUsuario($socio->id);
            $recibo->estado = true;
            $recibo->save();
        }
    }

    /**
     * actualizarReciboUsuario
     */
    public function actualizarReciboUsuario($id, $ruta, $fichero)
    {
        $recibo          = $this->buscarReciboUsuario($id);
        $recibo->ruta    = $ruta;
        $recibo->fichero = $fichero;
        $recibo->save();
    }

    /**
     * borrarRecibosSocio
     */
    public function borrarRecibosSocio($id)
    {
        $sociosMarcadosBaja = $this->socio->obtenersociosenbaja();

        foreach ($sociosMarcadosBaja as $socio) {
            if ($socio->id === $id) {
                $recibos = $socio->receipts();
                foreach ($recibos as $recibo) {
                    $recibo->forcedelete();
                }
            }
        }
    }
}
