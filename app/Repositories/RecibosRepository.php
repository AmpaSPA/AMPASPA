<?php

namespace App\Repositories;

use App\Receipt;
use Illuminate\Support\Facades\DB;

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
     * buscarReciboPorId
     */
    public function buscarReciboPorId($id)
    {
        return Receipt::whereId($id)->first();
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
     * buscarRecibosUsuarioPorPeriodo
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function buscarRecibosUsuarioPorPeriodo($id)
    {
        $periodo = $this->periodo->buscarPeriodoActivo();
        return Receipt::whereUserIdAndPeriodo($id, $periodo->periodo)->get();
    }

    /**
     * buscarRecibosUsuario
     */
    public function buscarRecibosAntiguosPorUsuario($id)
    {
        $periodoActual = $this->periodo->buscarPeriodoActivo()->periodo;

        return DB::table('receipts')
                        ->where('user_id', $id)
                        ->where('periodo', '<', $periodoActual)
                        ->get();
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
    public function crearReciboUsuario($id, $tipoPago)
    {
        $periodo = $this->periodo->buscarPeriodoActivo();

        $recibo          = new Receipt();
        $recibo->user_id = $id;
        $recibo->periodo = $periodo->periodo;
        $recibo->importe = $periodo->cuota;

        if ($tipoPago === 'Domiciliación a mi cuenta') {
            $recibo->domiciliacion = true;
        }

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
