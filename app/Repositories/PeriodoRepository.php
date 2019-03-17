<?php
/**
 * Created by PhpStorm.
 * User: papete
 * Date: 24/06/17
 * Time: 20:21
 */

namespace App\Repositories;

use App\Period;

class PeriodoRepository
{
    /**
     * periodos
     */
    public function periodos()
    {
        return Period::all();
    }

    /**
     * buscarPeriodoPorId
     */
    public function buscarPeriodoPorId($id)
    {
        return Period::find($id);
    }

        /**
     * buscarPeriodoPorPeriodo
     */
    public function buscarPeriodoPorPeriodo($periodo)
    {
        return Period::wherePeriodo($periodo)->first();
    }

    /**
     * @return mixed
     */
    public function buscarPeriodoActivo()
    {
        return Period::whereActivo(true)->first();
    }

    /**
     * cerrarPeriodo
     */
    public function cerrarPeriodo($datosPeriodo)
    {
        $periodo = $this->buscarPeriodoPorId($datosPeriodo['id']);

        $saldoPeriodo = $datosPeriodo['totalIngresosPeriodo'] - $datosPeriodo['totalGastosPeriodo'];

        $periodo->ingresos = $datosPeriodo['totalIngresosPeriodo'];
        $periodo->gastos = $datosPeriodo['totalGastosPeriodo'];
        $periodo->totalsocios = $datosPeriodo['totalSociosPeriodo'];
        $periodo->saldo = $saldoPeriodo;

        $periodo->save();

        return $periodo;
    }

    public function marcarPeriodo($id, $marca)
    {
        $periodo = $this->buscarPeriodoPorId($id);

        $periodo->activo = $marca;
        $periodo->save();

        return $periodo;
    }

    public function nuevoCurso($request)
    {
        $data = new Period();

        $data->periodo = $request->nuevoCurso;
        $data->aniodesde = substr($request->nuevoCurso, 0, 4);
        $data->aniohasta = substr($request->nuevoCurso, 5, 4);
        $data->cuota = $request->cuota;

        $data->save();

        return $data;
    }
}
