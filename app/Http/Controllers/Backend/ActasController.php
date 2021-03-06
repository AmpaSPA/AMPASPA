<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateActaRequest;
use App\Notifications\ActaDisponible;
use App\Repositories\MeetingRepository;
use App\Repositories\PeriodoRepository;
use App\Repositories\ProceedingRepository;
use App\Repositories\SocioRepository;
use App\Repositories\TiposnotificacionRepository;
use App\Repositories\TopicRepository;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class ActasController extends Controller
{
    protected $reuniones;
    protected $actas;
    protected $temas;
    protected $periodos;
    protected $socios;
    protected $tiposnotificacion;

    /**
     * __construct: Constructor de la clase. Usa los modelos: Meeting y Proceeding
     */
    public function __construct(
        MeetingRepository $reuniones,
        ProceedingRepository $actas,
        TopicRepository $temas,
        PeriodoRepository $periodos,
        SocioRepository $socios,
        TiposnotificacionRepository $tiposnotificacion
    ) {
        $this->reuniones         = $reuniones;
        $this->actas             = $actas;
        $this->temas             = $temas;
        $this->periodos          = $periodos;
        $this->socios            = $socios;
        $this->tiposnotificacion = $tiposnotificacion;
    }

    /**
     * actasdata
     */
    public function actasData()
    {
        $proceedings = $this->actas->actas();

        return DataTables::of($proceedings)
            ->addColumn(
                'reunion',
                function ($proceeding) {
                    return $proceeding->meeting->fechareunion;
                }
            )
            ->addColumn(
                'tipo',
                function ($proceeding) {
                    return $proceeding->meeting->meetingtype()->pluck('tiporeunion')->implode('');
                }
            )
            ->addColumn(
                'action',
                function ($proceeding) {
                    $btnAddAcuerdos    = null;
                    $btnUpdateAcuerdos = null;
                    $btnElaborarActa   = null;
                    $btnVerActa        = null;

                    if ($this->temas->buscarTemasNoAcordadosPorReunion($proceeding->meeting_id)->count() > 0) {
                        $btnAddAcuerdos = '<i class="text-primary fa fa-handshake-o"></i>'
                        . '<a href = "'
                        . route('acuerdos.acuerdostemas', $proceeding->meeting_id)
                        . '">'
                        . '<span class="text-primary texto-accion">'
                        . trans('acciones_crud.addagreements')
                            . '</span>'
                            . '</a>';
                    } else {
                        if (!$proceeding->documento) {
                            $btnUpdateAcuerdos = '<i class="text-warning fa fa-handshake-o"></i>'
                            . '<a href = "'
                            . route('acuerdos.list', $proceeding->meeting_id)
                            . '">'
                            . '<span class="text-warning texto-accion">'
                            . trans('acciones_crud.agreements')
                                . '</span>'
                                . '</a>';
                            $btnElaborarActa = '<i class="text-primary fa fa-clone"></i>'
                            . '<a href = "'
                            . route('actas.elaborar', $proceeding->meeting_id)
                            . '">'
                            . '<span class="text-primary texto-accion">'
                            . trans('acciones_crud.makeproceeding')
                                . '</span>'
                                . '</a>';
                        } else {
                            $btnVerActa = '<i class="text-success fa fa-eye"></i>'
                            . '<a target="_blank" href = "'
                            . route('actas.ver', $proceeding->meeting_id)
                            . '">'
                            . '<span class="text-success texto-accion">'
                            . trans('acciones_crud.viewproceeding')
                                . '</span>'
                                . '</a>';
                        }
                    }

                    return $btnAddAcuerdos . ' ' . $btnUpdateAcuerdos . ' ' . $btnElaborarActa
                        . ' ' . $btnVerActa;
                }
            )
            ->make(true);
    }

    /**
     * elaborarActa
     */
    public function elaborarActa($id_reunion)
    {
        $reunion = $this->reuniones->buscarReunionPorId($id_reunion);
        $temas   = $reunion->topics;

        $periodo = $this->periodos->buscarPeriodoActivo()->periodo;

        $hoy = Carbon::parse(now())->format('d/m/Y');
        $hoy = $this->obtenerFechaLiteral($hoy);

        $fechaReunion = Carbon::parse($reunion->fechareunion);
        $fecha        = $fechaReunion->format('d/m/Y');

        $fechaLiteral = $this->obtenerFechaLiteral($fecha);

        $tipo       = $reunion->meetingtype->tiporeunion;
        $asistentes = $reunion->attendees;

        $acta = public_path('assets/docs/actas/')
        . 'Acta '
        . Carbon::parse($reunion->fechareunion)->format('Y_m_d') . '.pdf';

        if (file_exists($acta)) {
            unlink($acta);
        }

        $actaHeader = view()->make('backend.includes.acta_cabecera')->render();
        $actaFooter = view()->make('backend.includes.acta_pie')->render();

        $options = [
            'orientation'   => 'portrait',
            'encoding'      => 'UTF-8',
            'header-html'   => $actaHeader,
            'footer-html'   => $actaFooter,
            'margin-top'    => '40mm',
            'margin-bottom' => '20mm',
            'footer-right'  => '[page] de [toPage]',
        ];

        $this->actas->registrarActaPdf($id_reunion, $acta);

        PDF::loadView(
            'backend.actas.acta',
            compact(
                'reunion',
                'temas',
                'acuerdos',
                'hoy',
                'periodo',
                'fecha',
                'tipo',
                'fechaLiteral',
                'asistentes'
            )
        )->setOptions($options)->save($acta);

        foreach ($asistentes as $asistente) {
            if ($asistente->pivot->confirmed) {
                $this->socios->buscarsocioporid($asistente->user_id)
                    ->notify(new ActaDisponible($reunion, $fecha));
            }
        }

        $icononotificacion = 'fa-list-alt';
        $tiponotificacion  = 'App\Notifications\ActaDisponible';
        $textonotificacion = 'Acta disponible';
        $this->tiposnotificacion->crearTipoNotificacion($icononotificacion, $tiponotificacion, $textonotificacion);

        flash(trans('acciones_crud.proceedinggenerated'))->success();
        return redirect(route('actas.list'));
    }

    /**
     * obtenerFechaLiteral
     */
    public function obtenerFechaLiteral($fecha)
    {
        $dia   = substr($fecha, 0, 2);
        $mes   = (int) substr($fecha, 3, 2) - 1;
        $anio  = substr($fecha, 6, 4);
        $meses = [
            'enero',
            'febrero',
            'marzo',
            'abril',
            'mayo',
            'junio',
            'julio',
            'agosto',
            'septiembre',
            'octubre',
            'noviembre',
            'diciembre',
        ];
        return $dia . ' de ' . $meses[$mes] . ' de ' . $anio;
    }

    /**
     * verActa
     */
    public function verActa($reunion_id)
    {
        $acta = $this->actas->buscarActaPorReunion($reunion_id);
        $pdf  = $acta->documento;

        header('Content-type: application/pdf');
        readfile($pdf);
    }

    /**
     * importarActaFirmada
     */
    public function listarActasPendientes()
    {
        $actasPendientes = $this->actas->buscarActasSinFirmar();

        return view('backend.actas.pendientes', compact('actasPendientes'));
    }

    /**
     * pendientesData
     */
    public function pendientesData()
    {
        $proceedings = $this->actas->buscarActasSinFirmar();

        return DataTables::of($proceedings)
            ->addColumn(
                'reunion',
                function ($proceeding) {
                    return $proceeding->meeting->fechareunion;
                }
            )
            ->addColumn(
                'tipo',
                function ($proceeding) {
                    return $proceeding->meeting->meetingtype()->pluck('tiporeunion')->implode('');
                }
            )
            ->addColumn(
                'action',
                function ($proceeding) {
                    return '<i class="text-info fa fa-upload"></i>'
                    . '<a href = "'
                    . route('actas.importarfirmada', $proceeding->id)
                    . '">'
                    . '<span class="text-info texto-accion">'
                    . trans('acciones_crud.uploadsignedproceeding')
                        . '</span>'
                        . '</a>';
                }
            )
            ->make(true);
    }

    /**
     * importarFactura
     */
    public function importarActa($id)
    {
        $acta = $this->actas->buscarActaPorId($id);

        return view('backend.actas.importar', compact('acta'));
    }

    /**
     * registrarActaFirmada
     */
    public function registrarActaFirmada(UpdateActaRequest $request)
    {
        $acta = $this->actas->buscarActaPorId($request->id_acta);

        unlink($acta->documento);

        $ruta    = public_path('assets/docs/actas/');
        $fichero = 'Acta ' . Carbon::parse($acta->meeting->fechareunion)->format('Y_m_d') . '.pdf';

        $request->file('documento_acta')->move($ruta, $fichero);

        $this->actas->firmarActa($acta->id);

        flash(trans('message.uploadedproceeding', ['acta' => $fichero]))->success();

        if ($this->actas->totalActasSinFirmar() > 0) {
            return redirect(route('actas.listarpendientes'));
        } else {
            return redirect(route('reuniones.gestion'));
        }
    }
}
