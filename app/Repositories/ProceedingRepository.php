<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Proceeding;
use Illuminate\Support\Facades\Auth;

class ProceedingRepository
{
    protected $periodos;

    /**
     * MeetingRepository constructor.
     * @param PeriodoRepository $periodos
     */
    public function __construct(PeriodoRepository $periodos)
    {
        $this->periodos = $periodos;
    }
    /**
     * actas
     */
    public function actas()
    {
        return Proceeding::all();
    }

    public function buscarActaPorReunion($id_reunion)
    {
        return Proceeding::whereMeetingId($id_reunion)->first();
    }

    /**
     * @return int
     */
    public function totalActas(): int
    {
        return Proceeding::all()->count();
    }

    /**
     * crearRegistroActa
     */
    public function crearRegistroActa($id_reunion)
    {
        $id_periodo = $this->periodos->buscarPeriodoActivo()->id;
        $data = new Proceeding();
        $data->meeting_id = $id_reunion;
        $data->period_id = $id_periodo;
        $data->save();

        return $data;
    }

    /**
     * ponerFechaDeAutoria
     */
    public function ponerFechaDeAutoria($reunion_id)
    {
        $acta = $this->buscarActaPorReunion($reunion_id);

        $acta->fecha_acta = Carbon::now()->format('Y-m-d');
        $acta->autoria = Auth::user()->nombre.' '.Auth::user()->apellidos;

        return $acta->save();
    }

    /**
     * registrarActaPdf
     */
    public function registrarActaPdf($reunion_id, $pdf)
    {
        $acta = $this->buscarActaPorReunion($reunion_id);
        $acta->documento = $pdf;

        return $acta->save();
    }
}
