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
     * buscarPeriodoActivo
     */
    public function buscarPeriodoActivo()
    {
        return Period::whereActivo(true)->first();
    }

    /**
     * marcarPeriodo
     */
    public function marcarPeriodo($id, $marca)
    {
        $periodo = $this->buscarPeriodoPorId($id);

        $periodo->activo = $marca;
        $periodo->save();

        return $periodo;
    }

    /**
     * nuevoCurso
     */
    public function nuevoCurso($request)
    {
        $aniodesdeAnterior = substr($request->nuevoCurso, 0, 4) - 1;
        $aniohastaAnterior = substr($request->nuevoCurso, 5, 4) - 1;
        $periodoAnterior = $aniodesdeAnterior . '-' . $aniohastaAnterior;

        $periodoAnterior = $this->buscarPeriodoPorPeriodo($periodoAnterior);
        $periodoAnterior->standby = true;
        $periodoAnterior->save();

        $data = new Period();

        $data->periodo = $request->nuevoCurso;
        $data->aniodesde = substr($request->nuevoCurso, 0, 4);
        $data->aniohasta = substr($request->nuevoCurso, 5, 4);
        $data->cuota = $request->cuota;

        $data->save();

        return $data;
    }

    /**
     * actualizarImportes
     */
    public function actualizarImportes($importes)
    {
        $curso = $this->buscarPeriodoActivo();

        $curso->ingresos = $importes['ingreso'];
        $curso->gastos = $importes['gasto'];
        $curso->saldo = $importes['saldo'];

        $curso->save();

        return $curso;
    }

    /**
     * consolidarRecibosActivosPeriodo
     */
    public function consolidarRecibosActivosPeriodo($totalIngresosRecibos)
    {
        $curso = $this->buscarPeriodoActivo();

        $curso->ingresos = $curso->ingresos + $totalIngresosRecibos;
        $curso->saldo = $curso->ingresos - $curso->gastos;

        $curso->save();
    }

    /**
     * actualizarSocios
     */
    public function actualizarSocios($totalSocios)
    {
        $curso = $this->buscarPeriodoActivo();

        $curso->totalsocios = $totalSocios;

        $curso->save();

        return $curso;
    }
}
