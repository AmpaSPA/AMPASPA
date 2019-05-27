<?php

namespace App\Repositories;

use App\Proceeding;
use Carbon\Carbon;
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
     *
     * @return void
     */
    public function actas()
    {
        return Proceeding::all();
    }

    /**
     * buscarActaPorReunion
     *
     * @param  mixed $id_reunion
     *
     * @return void
     */
    public function buscarActaPorReunion($id_reunion)
    {
        return Proceeding::whereMeetingId($id_reunion)->first();
    }

    /**
     * buscarActaPorId
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function buscarActaPorId($id)
    {
        return Proceeding::find($id);
    }

    /**
     * buscarActasSinFirmar
     *
     * @return int
     */
    public function buscarActasSinFirmar()
    {
        return Proceeding::whereEstado(false)->get();
    }

    /**
     * @return int
     */
    public function totalActas(): int
    {
        return Proceeding::all()->count();
    }

    /**
     * totalActasSinFirmar
     *
     * @return int
     */
    public function totalActasSinFirmar(): int
    {
        return Proceeding::whereEstado(false)->where('documento', '<>', null)->count();
    }

    /**
     * crearRegistroActa
     */
    public function crearRegistroActa($id_reunion)
    {
        $id_periodo = $this->periodos->buscarPeriodoActivo()->id;
        $acta       = Proceeding::firstOrCreate(
            [
                'meeting_id' => $id_reunion,
                'period_id'  => $id_periodo,
            ]
        );

        return $acta;
    }

    /**
     * ponerFechaDeAutoria
     */
    public function ponerFechaDeAutoria($reunion_id)
    {
        $acta = $this->buscarActaPorReunion($reunion_id);

        $acta->fecha_acta = Carbon::now()->format('Y-m-d');
        $acta->autoria    = Auth::user()->nombre . ' ' . Auth::user()->apellidos;

        return $acta->save();
    }

    /**
     * registrarActaPdf
     */
    public function registrarActaPdf($reunion_id, $pdf)
    {
        $acta            = $this->buscarActaPorReunion($reunion_id);
        $acta->documento = $pdf;

        return $acta->save();
    }

    /**
     * firmarActa
     */
    public function firmarActa($id)
    {
        $acta         = $this->buscarActaPorId($id);
        $acta->estado = true;

        return $acta->save();
    }
}
