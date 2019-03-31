<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePeriodRequest;
use App\Repositories\EntradaRepository;
use App\Repositories\PeriodoRepository;
use App\Repositories\SocioRepository;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class PeriodosController extends Controller
{
    protected $periodos;
    protected $socios;
    protected $entradas;

    /**
     * __construct: Constructor de la clase. Usa los modelos: Period y User
     */
    public function __construct(PeriodoRepository $periodos, SocioRepository $socios, EntradaRepository $entradas)
    {
        $this->periodos = $periodos;
        $this->socios = $socios;
        $this->entradas = $entradas;
    }

    /**
     * periodosData
     */
    public function periodosData()
    {
        $periods = $this->periodos->periodos();

        return DataTables::of($periods)
            ->addColumn(
                'cuotaeuros',
                function ($period) {
                    return $period->cuota . '€';
                }
            )
            ->addColumn(
                'estado',
                function ($period) {
                    if ($period->activo) {
                        return 'Abierto';
                    } else {
                        return 'Cerrado';
                    }
                }
            )
            ->addColumn(
                'action',
                function ($period) {
                    $btnVer = null;
                    $btnCerrar = null;
                    if ($period->activo) {
                        if (Carbon::now()->month >= 9 && Carbon::now()->month <= 11) {
                            return $btnCerrar = '<i class="text-danger fa fa-calendar-times-o"></i>'
                            . '<a href="'
                            . route('periodos.cerrar', $period->id)
                            . '">'
                            . '<span class="text-danger texto-accion">'
                            . trans('acciones_crud.close')
                                . '</span>'
                                . '</a>';
                        } else {
                            return $btnVer = '<i class="text-success fa fa-eye"></i>'
                            . '<a href="'
                            . route('periodos.ver', $period->id)
                            . '">'
                            . '<span class="text-success texto-accion">'
                            . trans('acciones_crud.view')
                                . '</span>'
                                . '</a>';
                        }
                    } else {
                        return $btnVer = '<i class="text-success fa fa-eye"></i>'
                        . '<a href="'
                        . route('periodos.ver', $period->id)
                        . '">'
                        . '<span class="text-success texto-accion">'
                        . trans('acciones_crud.view')
                            . '</span>'
                            . '</a>';
                    }
                }
            )
            ->make(true);
    }

    /**
     * cerrar
     */
    public function cerrar($id)
    {
        $periodo = $this->periodos->buscarPeriodoActivo()->periodo;
        $totalSociosPeriodo = $this->socios->totalSociosPeriodo($periodo);

        $entradasIngresoPeriodo = $this->entradas->totalEntradasPeriodo($periodo, 'Ingreso');

        if ($entradasIngresoPeriodo > 0) {
            $totalIngresosPeriodo = $this->entradas->totalImportePeriodo($periodo, 'Ingreso')->total_importe;
        } else {
            $totalIngresosPeriodo = 0;
        }

        $entradasGastoPeriodo = $this->entradas->totalEntradasPeriodo($periodo, 'Gasto');

        if ($entradasGastoPeriodo > 0) {
            $totalGastosPeriodo = $this->entradas->totalImportePeriodo($periodo, 'Gasto')->total_importe;
        } else {
            $totalGastosPeriodo = 0;
        }

        $periodo = $this->periodos->cerrarPeriodo(
            [
                'id' => $id,
                'totalSociosPeriodo' => $totalSociosPeriodo,
                'totalIngresosPeriodo' => $totalIngresosPeriodo,
                'totalGastosPeriodo' => $totalGastosPeriodo,
            ]
        );

        $modo = 'new';
        $nuevoCurso = ($periodo->aniodesde + 1) . '-' . ($periodo->aniohasta + 1);

        return view('backend.periodos.abrir', compact('modo', 'periodo', 'nuevoCurso'));
    }

    /**
     * store
     */
    public function store(CreatePeriodRequest $request)
    {
        $antiguoCurso = $this->periodos->buscarPeriodoPorPeriodo($request->antiguoCurso);
        $this->periodos->marcarPeriodo($antiguoCurso->id, false);

        $nuevoCurso = $this->periodos->nuevoCurso($request);
        $this->periodos->marcarPeriodo($nuevoCurso->id, true);

        /** Marcar a todos los socios como pendientes de pago de la cuota del nuevo curso y
         * enviarles una notificación advirtiendoles de tal hecho. */

        flash(trans('acciones_crud.addedperiod', ['periodo' => $nuevoCurso->periodo]))->success();
        return redirect(route('periodos.gestion'));
    }

    /**
     * ver
     */
    public function ver($id)
    {
        $modo = 'view';
        $curso = $this->periodos->buscarPeriodoPorId($id);

        if (!$curso->activo) {
            return view('backend.periodos.ver', compact('curso', 'modo'));
        } else {
            $totalSociosPeriodo = $this->socios->totalSociosPeriodo($curso->periodo);

            $entradasIngresoPeriodo = $this->entradas->totalEntradasPeriodo($curso->periodo, 'Ingreso');

            if ($entradasIngresoPeriodo > 0) {
                $totalIngresosPeriodo = $this->entradas->totalImportePeriodo($curso->periodo, 'Ingreso')->total_importe;
            } else {
                $totalIngresosPeriodo = 0;
            }

            $entradasGastoPeriodo = $this->entradas->totalEntradasPeriodo($curso->periodo, 'Gasto');

            if ($entradasGastoPeriodo > 0) {
                $totalGastosPeriodo = $this->entradas->totalImportePeriodo($curso->periodo, 'Gasto')->total_importe;
            } else {
                $totalGastosPeriodo = 0;
            }

            $saldoPeriodo = $totalIngresosPeriodo - $totalGastosPeriodo;

            return view(
                'backend.periodos.ver',
                compact(
                    'curso',
                    'totalSociosPeriodo',
                    'totalIngresosPeriodo',
                    'totalGastosPeriodo',
                    'saldoPeriodo',
                    'modo'
                )
            );
        }
    }
}
