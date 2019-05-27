<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMeetingRequest;
use App\Notifications\ReunionCancelada;
use App\Notifications\ReunionConvocada;
use App\Repositories\MeetingRepository;
use App\Repositories\ProceedingRepository;
use App\Repositories\SocioRepository;
use App\Repositories\TiposnotificacionRepository;
use App\Repositories\TopicRepository;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class ReunionesController extends Controller
{
    protected $reuniones;
    protected $temas;
    protected $socios;
    protected $tiposnotificacion;
    protected $actas;

    /**
     * __construct: Constructor de la clase. Usa los modelos: Meeting y Topic
     */
    public function __construct(
        MeetingRepository $reuniones,
        TopicRepository $temas,
        SocioRepository $socios,
        TiposnotificacionRepository $tiposnotificacion,
        ProceedingRepository $actas
    ) {
        $this->reuniones         = $reuniones;
        $this->temas             = $temas;
        $this->socios            = $socios;
        $this->tiposnotificacion = $tiposnotificacion;
        $this->actas             = $actas;
    }

    /**
     * index
     */
    public function index()
    {
        foreach ($this->reuniones->reuniones() as $reunion) {
            $this->reuniones->comprobarReunionConformada($reunion->id);
        }

        $hay_reuniones_a_convocar = false;
        $hay_reuniones_a_cancelar = false;
        $aviso                    = 0;

        if ($this->reuniones->obtenerReunionesNoConvocadasConformadas()->count() > 0) {
            $hay_reuniones_a_convocar = true;
        }
        if ($this->reuniones->obtenerReunionesConvocadas()->count() > 0) {
            $hay_reuniones_a_cancelar = true;
        }

        $aviso = $this->actas->totalActasSinFirmar();

        return view(
            'backend.reuniones.index',
            compact(
                'hay_reuniones_a_convocar',
                'hay_reuniones_a_cancelar',
                'aviso'
            )
        );
    }

    /**
     * reunionesdata
     */
    public function reunionesData()
    {
        $meetings = $this->reuniones->reuniones();

        return DataTables::of($meetings)
            ->addColumn(
                'tipo',
                function ($meeting) {
                    return $meeting->meetingtype()->pluck('tiporeunion')->implode('');
                }
            )
            ->addColumn(
                'estado',
                function ($meeting) {
                    $estado = null;

                    if ($meeting->convocada) {
                        if (!$meeting->celebrada) {
                            $estado = 'Cerrada';
                        } else {
                            $estado = 'Celebrada';
                        }
                    } else {
                        if (!$meeting->celebrada) {
                            $estado = 'Abierta';
                        } else {
                            $estado = 'Vencida';
                        }
                    }
                    return $estado;
                }
            )
            ->addColumn(
                'action',
                function ($meeting) {
                    $btnEditar     = null;
                    $btnEliminar   = null;
                    $btnAsistentes = null;
                    $btnAddTemas   = null;
                    $btnUpdTemas   = null;

                    $btnVer = '<i class="text-success fa fa-eye"></i>'
                    . '<a href="'
                    . route('reuniones.ver', $meeting->id)
                    . '">'
                    . '<span class="text-success texto-accion">'
                    . trans('acciones_crud.view')
                        . '</span>'
                        . '</a>';

                    if (!$meeting->convocada && !$meeting->celebrada) {
                        $btnEditar = '<i class="text-warning fa fa-pencil"></i>'
                        . '<a href="'
                        . route('reuniones.edit', $meeting->id)
                        . '">'
                        . '<span class="text-warning texto-accion">'
                        . trans('acciones_crud.edit')
                            . '</span>'
                            . '</a>';
                        $btnEliminar = '<i class="text-danger fa fa-trash"></i>'
                        . '<a href="'
                        . route('reuniones.borrar', $meeting->id)
                        . '">'
                        . '<span class="text-danger texto-accion">'
                        . trans('acciones_crud.delete')
                            . '</span>'
                            . '</a>';
                        $btnTemas = '<i class="text-info fa fa-align-justify"></i>'
                        . '<a href="'
                        . route('temas.reunion', $meeting->id)
                        . '">'
                        . '<span class="text-info texto-accion">'
                        . trans('acciones_crud.topics')
                            . '</span>'
                            . '</a>';
                        $btnAsistentes = '<i class="text-primary fa fa-users"></i>'
                        . '<a href="'
                        . route('asistentes.reunion', $meeting->id)
                        . '">'
                        . '<span class="text-primary texto-accion">'
                        . trans('acciones_crud.attendees')
                            . '</span>'
                            . '</a>';
                        return $btnVer . ' ' . $btnEditar . ' ' . $btnEliminar . ' ' . $btnTemas . ' ' . $btnAsistentes;
                    } elseif ($meeting->convocada) {
                        $btnVerTemas = '<i class="text-info fa fa-align-justify"></i>'
                        . '<a href="'
                        . route('temas.reunionver', $meeting->id)
                        . '">'
                        . '<span class="text-info texto-accion">'
                        . trans('acciones_crud.topics')
                            . '</span>'
                            . '</a>';
                        $btnVerAsistentes = '<i class="text-primary fa fa-users"></i>'
                        . '<a href="'
                        . route('asistentes.reunionver', $meeting->id)
                        . '">'
                        . '<span class="text-primary texto-accion">'
                        . trans('acciones_crud.attendees')
                            . '</span>'
                            . '</a>';
                        return $btnVer . ' ' . $btnVerTemas . ' ' . $btnVerAsistentes;
                    } else {
                        $btnVerTemas = '<i class="text-info fa fa-align-justify"></i>'
                        . '<a href="'
                        . route('temas.reunionver', $meeting->id)
                        . '">'
                        . '<span class="text-info texto-accion">'
                        . trans('acciones_crud.topics')
                            . '</span>'
                            . '</a>';
                        $btnVerAsistentes = '<i class="text-primary fa fa-users"></i>'
                        . '<a href="'
                        . route('asistentes.reunionver', $meeting->id)
                        . '">'
                        . '<span class="text-primary texto-accion">'
                        . trans('acciones_crud.attendees')
                            . '</span>'
                            . '</a>';
                        $btnReagendar = '<i class="text-danger fa fa-calendar"></i>'
                        . '<a href="'
                        . route('reuniones.edit', $meeting->id)
                        . '">'
                        . '<span class="text-danger texto-accion">'
                        . trans('acciones_crud.backtoschedule')
                            . '</span>'
                            . '</a>';
                        return $btnVer . ' ' . $btnVerTemas . ' ' . $btnVerAsistentes . ' ' . $btnReagendar;
                    }
                }
            )
            ->make(true);
    }

    /**
     * create
     */
    public function create()
    {
        $modo       = 'new';
        $treuniones = $this->reuniones->tiposReunion();

        return view('backend.reuniones.nueva', compact('modo', 'treuniones'));
    }

    /**
     * store: Se guarda en la BBDD la reunión informada en el formulario de alta
     */
    public function store(CreateMeetingRequest $request)
    {
        $data = $this->reuniones->crearReunion($request);

        flash(trans('acciones_crud.addedmeeting', ['fecha' => $data->fechareunion]))->success();
        return redirect(route('reuniones.gestion'));
    }

    /**
     * view: Se presenta la vista con la información de la reunión guardada en la BBDD
     */
    public function view($id)
    {
        $modo    = 'view';
        $reunion = $this->reuniones->buscarReunionPorId($id);

        return view('backend.reuniones.ver', compact('reunion', 'modo'));
    }

    /**
     * edit: Se presenta la vista con el formulario de edición de la reunión seleccionada
     */
    public function edit($id)
    {
        $reunion    = $this->reuniones->buscarReunionPorId($id);
        $modo       = 'update';
        $treuniones = $this->reuniones->tiposReunion();

        return view('backend.reuniones.editar', compact('reunion', 'treuniones', 'modo'));
    }

    /**
     * update: Se actualiza la información de la reunión editada con la petición del usuario
     */
    public function update($id, CreateMeetingRequest $request)
    {
        $reunion = $this->reuniones->updateReunion($id, $request);

        flash(trans('acciones_crud.updatemeeting', ['fecha' => $reunion->fechareunion]))->success();
        return redirect(route('reuniones.gestion'));
    }

    /**
     * forcedelete: Se elimina de forma permanente de la BBDD la reunión seleccionada
     */
    public function forcedelete($id)
    {
        $reunion = $this->reuniones->buscarReunionPorId($id);

        if ($reunion->topics->count() > 0) {
            $this->temas->removeTemas($id);
        }
        $this->reuniones->removeReunion($id);

        flash(trans('acciones_crud.deletemeeting', ['fecha' => $reunion->fechareunion]))->success();
        return redirect(route('reuniones.gestion'));
    }

    /**
     * noConvocadasData: Se construye la columna de la acción convocar de la tabla de
     * reuniones
     */
    public function noConvocadasData()
    {
        $meetings = $this->reuniones->obtenerReunionesNoConvocadasConformadas();

        return DataTables::of($meetings)
            ->addColumn(
                'tipo',
                function ($meeting) {
                    return $meeting->meetingtype()->pluck('tiporeunion')->implode('');
                }
            )
            ->addColumn(
                'action',
                function ($meeting) {
                    $btnConvocar = '<i class="text-success fa fa-bullhorn"></i>'
                    . '<a href="'
                    . route('reuniones.convocar', $meeting->id)
                    . '">'
                    . '<span class="text-success texto-accion">'
                    . trans('acciones_crud.arrange')
                        . '</span>'
                        . '</a>';

                    return $btnConvocar;
                }
            )
            ->make(true);
    }

    /**
     * convocarReunion: Se convoca la reunión seleccionada en la tabla de reuniones a
     * convocar
     */
    public function convocarReunion($id)
    {
        $reunion = $this->reuniones->buscarReunionPorId($id);
        $fecha   = Carbon::parse($reunion->fechareunion)->format('d-m-Y');
        $mail    = true;

        $convocada = true;

        $asistentes = $reunion->attendees;

        $this->reuniones->marcarReunion($reunion, $convocada);

        foreach ($asistentes as $asistente) {
            $socio = $this->socios->buscarsocioporid($asistente->user_id)
                ->notify(new ReunionConvocada($reunion, $fecha, $mail));
        }

        $icononotificacion = 'fa-comments';
        $tiponotificacion  = 'App\Notifications\ReunionConvocada';
        $textonotificacion = 'Reunión convocada';
        $this->tiposnotificacion->crearTipoNotificacion($icononotificacion, $tiponotificacion, $textonotificacion);

        if ($this->reuniones->obtenerReunionesNoConvocadasConformadas()->count() > 0) {
            flash(trans('message.meetingarranged', ['fecha' => $reunion->fechareunion]))->success();
            return redirect(route('reuniones.arrangemeeting'));
        } else {
            flash(trans('message.meetingarranged', ['fecha' => $reunion->fechareunion]))->success();
            return redirect(route('reuniones.gestion'));
        }
    }

    /**
     * convocadasData: Se construye la columna de la acción cancelar de la tabla de reuniones
     */
    public function convocadasData()
    {
        $meetings = $this->reuniones->obtenerReunionesConvocadas();

        return DataTables::of($meetings)
            ->addColumn(
                'tipo',
                function ($meeting) {
                    return $meeting->meetingtype()->pluck('tiporeunion')->implode('');
                }
            )
            ->addColumn(
                'action',
                function ($meeting) {
                    $btnCancelar = '<i class="text-danger fa fa-history"></i>'
                    . '<a href="'
                    . route('reuniones.cancelar', $meeting->id)
                    . '">'
                    . '<span class="text-danger texto-accion">'
                    . trans('acciones_crud.cancel')
                        . '</span>'
                        . '</a>';

                    return $btnCancelar;
                }
            )
            ->make(true);
    }

    /**
     * cancelarReunion: Se desconvoca la reunión seleccionada en la tabla de reuniones
     */
    public function cancelarReunion($id)
    {
        $reunion = $this->reuniones->buscarReunionPorId($id);
        $fecha   = Carbon::parse($reunion->fechareunion)->format('d-m-Y');

        $convocada = false;

        $asistentes = $reunion->attendees;

        $this->reuniones->marcarReunion($reunion, $convocada);

        foreach ($asistentes as $asistente) {
            $socio = $this->socios->buscarsocioporid($asistente->user_id)
                ->notify(new ReunionCancelada($reunion, $fecha));
        }

        $icononotificacion = 'fa-comments';
        $tiponotificacion  = 'App\Notifications\ReunionCancelada';
        $textonotificacion = 'Reunión cancelada';
        $this->tiposnotificacion->crearTipoNotificacion($icononotificacion, $tiponotificacion, $textonotificacion);

        if ($this->reuniones->obtenerReunionesConvocadas()->count() > 0) {
            flash(trans('message.meetingcalledoff', ['fecha' => $reunion->fechareunion]))->success();
            return redirect(route('reuniones.cancelmeeting'));
        } else {
            flash(trans('message.meetingcalledoff', ['fecha' => $reunion->fechareunion]))->success();
            return redirect(route('reuniones.gestion'));
        }
    }
}
