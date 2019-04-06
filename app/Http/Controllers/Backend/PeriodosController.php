<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Repositories\SocioRepository;
use App\Repositories\EntradaRepository;
use App\Repositories\PeriodoRepository;
use App\Repositories\EntrytypeRepository;
use App\Http\Requests\CreatePeriodRequest;

class PeriodosController extends Controller
{
    protected $periodos;
    protected $socios;
    protected $entradas;
    protected $tipoEntrada;

    /**
     * __construct: Constructor de la clase. Usa los modelos: Period y User
     */
    public function __construct(
        PeriodoRepository $periodos,
        SocioRepository $socios,
        EntradaRepository $entradas,
        EntrytypeRepository $tipoEntrada
    ) {
        $this->periodos = $periodos;
        $this->socios = $socios;
        $this->entradas = $entradas;
        $this->tipoEntrada = $tipoEntrada;
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
                    $btnAbrir = null;
                    if ($period->activo) {
                        if ((Carbon::now()->month >= 9 && Carbon::now()->month <= 11) && !$period->standby) {
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
                        if ($period->totalsocios === 0) {
                            return $btnAbrir = '<i class="text-success fa fa-folder-open-o"></i>'
                            . '<a href="'
                            . route('periodos.abrir', $period->id)
                            . '">'
                            . '<span class="text-success texto-accion">'
                            . trans('acciones_crud.open')
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
        $periodo = $this->periodos->buscarPeriodoActivo();

        $totalSocios = $this->socios->totalsocios();
        $this->periodos->actualizarSocios($totalSocios);

        $importes = $this->entradas->calcularImportesPeriodo($periodo->periodo);
        $this->periodos->actualizarImportes($importes);

        $this->socios->updateMasivoSituacionPago();

        $modo = 'new';
        $nuevoCurso = ($periodo->aniodesde + 1) . '-' . ($periodo->aniohasta + 1);

        return view('backend.periodos.abrir', compact('modo', 'periodo', 'nuevoCurso'));
    }

    /**
     * store
     */
    public function store(CreatePeriodRequest $request)
    {
        $nuevoCurso = $this->periodos->nuevoCurso($request);

        flash(
            trans(
                'acciones_crud.addedperiod',
                [
                    'periodo' => $nuevoCurso->periodo
                ]
            )
        )->success();
        return redirect(route('periodos.gestion'));
    }

    /**
     * abrir
     */
    public function abrir($id)
    {
        $periodo = $this->periodos->buscarPeriodoPorId($id);

        $antiguoCurso = ($periodo->aniodesde - 1) . '-' . ($periodo->aniohasta - 1);
        $antiguoCurso = $this->periodos->buscarPeriodoPorPeriodo($antiguoCurso);

        $this->periodos->marcarPeriodo($antiguoCurso->id, false);
        $this->periodos->marcarPeriodo($periodo->id, true);

        flash(
            trans(
                'acciones_crud.proccessperiod',
                [
                    'periodo' => $this->periodos->buscarPeriodoPorId($id)->periodo
                ]
            )
        )->success();

        return redirect(route('home'));
    }

    /**
     * ver
     */
    public function ver($id)
    {
        $modo = 'view';
        $curso = $this->periodos->buscarPeriodoPorId($id);

        return view('backend.periodos.ver', compact('curso', 'modo'));
    }
}
