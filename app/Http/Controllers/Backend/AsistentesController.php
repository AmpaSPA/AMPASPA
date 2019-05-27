<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Repositories\SocioRepository;
use App\Repositories\MeetingRepository;
use App\Repositories\AttendeeRepository;
use App\Http\Requests\CreateAttendeeRequest;

class AsistentesController extends Controller
{
    protected $reuniones;
    protected $asistentes;
    protected $socios;

    /**
     * __construct: Constructor de la clase. Usa los modelos: Meeting y Topic
     */
    public function __construct(AttendeeRepository $asistentes, MeetingRepository $reuniones, SocioRepository $socios)
    {
        $this->reuniones = $reuniones;
        $this->asistentes = $asistentes;
        $this->socios = $socios;
    }
    /**
     * create: Se presenta la vista para seleccionar a los asistentes a la reunión
     */
    public function create($id)
    {
        $modo = 'new';
        $reunion = $this->reuniones->buscarReunionPorId($id);
        $fecha = Carbon::parse($reunion->fechareunion)->format('d-m-Y');
        $asistentes = $this->socios->listaNombreSocio();

        return view('backend.asistentes.nuevo', compact('asistentes', 'fecha', 'reunion', 'modo'));
    }

    /**
     * asistentesData: Se presenta la lista de estudiantes asignados a la actividad
     * seleccionada
     */
    public function asistentesData($id_reunion)
    {
        $reunion = $this->reuniones->buscarReunionPorId($id_reunion);

        $asistentes = $reunion->attendees;

        return DataTables::of($asistentes)
            ->addColumn(
                'action',
                function ($asistente) use ($reunion) {
                    $btnEliminar = '<i class="text-danger fa fa-user-times"></i>'
                    . '<a href="'
                    . route('asistentes.borrar', [$asistente->id, $reunion->id])
                    . '">'
                    . '<span class="text-danger texto-accion">'
                    . trans('acciones_crud.delete')
                        . '</span>'
                        . '</a>';
                    return $btnEliminar;
                }
            )
            ->make(true);
    }

    /**
     * store: Se guarda en la BBDD el asistente informado en el formulario de alta
     */
    public function store(CreateAttendeeRequest $request)
    {
        $asistente = $this->asistentes->buscarAsistentePorUserId($request->id);

        if ($asistente) {
            flash(trans('message.attendeefound', ['asistente' => $asistente->nombre]))->error();
        } else {
            $asistente = $this->asistentes->crearAsistentePorReunion($request);
            $asistente->meetings()->attach($request->meeting_id);
            $this->reuniones->comprobarReunionConformada($request->meeting_id);
        }
        return redirect()->back();
    }

    public function delete($id_asistente, $id_reunion)
    {
        $reunion = $this->reuniones->buscarReunionPorId($id_reunion);

        $asistentes = $reunion->attendees;

        foreach ($asistentes as $asistente) {
            $reunion->attendees()->detach($id_asistente);
        };

        $asistente = $this->asistentes->borraAsistente($id_asistente);

        flash(trans('acciones_crud.attendeedeleted', ['asistente' => $asistente]))->success();
        return redirect()->back();
    }

    /**
     * verAsistentesReunion
     */
    public function verAsistentesReunion($id)
    {
        $reunion = $this->reuniones->buscarReunionPorId($id);
        $fecha = Carbon::parse($reunion->fechareunion)->format('d-m-Y');

        return view('backend.asistentes.asistentesreunion', compact('reunion', 'fecha'));
    }
}
