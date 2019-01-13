<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActivityRequest;
use App\Notifications\ActividadPublicada;
use App\Repositories\ActivityRepository;
use App\Repositories\AlumnoRepository;
use App\Repositories\CursoRepository;
use Carbon\Carbon;
use DataTables;
use Illuminate\View\View;

/**
 * Clase del controlador para la administración de las actividades
 */
class ActividadesController extends Controller
{
    protected $actividades;
    protected $alumnos;
    protected $cursos;

    /**
     * __construct: Constructor de la clase. Usa los modelos: Activity, Student y Course
     */
    public function __construct(ActivityRepository $actividades, AlumnoRepository $alumnos, CursoRepository $cursos)
    {
        $this->actividades = $actividades;
        $this->alumnos = $alumnos;
        $this->cursos = $cursos;
    }

    /**
     * index: Se presenta la vista principal de administración de actividades visualizando
     * los botones de publicar o cancelar actividades según proceda
     */
    public function index()
    {
        $hay_actividades_a_publicar = false;
        $hay_actividades_a_cancelar = false;

        if ($this->actividades->obtenerActividadesNoPublicadas()->count() > 0) {
            $hay_actividades_a_publicar = true;
        }
        if ($this->actividades->obtenerActividadesPublicadas()->count() > 0) {
            $hay_actividades_a_cancelar = true;
        }

        return view('backend.actividades.index', compact('hay_actividades_a_publicar', 'hay_actividades_a_cancelar'));
    }

    /**
     * actividadesdata: Se construyen los botones de acción de la tabla de actividades presen-
     * tada en la vista principal
     */

    public function actividadesdata()
    {
        $activities = $this->actividades->actividades();

        return DataTables::of($activities)
            ->addColumn(
                'action',
                function ($activity) {
                    $btnEditar = null;
                    $btnEliminar = null;
                    $btnAsignaciones = null;

                    $btnVer = '<i class="text-success fa fa-eye"></i>'
                    . '<a href="'
                    . route('actividades.ver', $activity->id)
                    . '">'
                    . '<span class="text-success texto-accion">'
                    . trans('acciones_crud.view')
                        . '</span>'
                        . '</a>';

                    if (!$activity->publicada) {
                        $btnEditar = '<i class="text-warning fa fa-pencil"></i>'
                        . '<a href="'
                        . route('actividades.edit', $activity->id)
                        . '">'
                        . '<span class="text-warning texto-accion">'
                        . trans('acciones_crud.edit')
                            . '</span>'
                            . '</a>';
                        $btnEliminar = '<i class="text-danger fa fa-trash"></i>'
                        . '<a href="'
                        . route('actividades.borrar', $activity->id)
                        . '">'
                        . '<span class="text-danger texto-accion">'
                        . trans('acciones_crud.delete')
                            . '</span>'
                            . '</a>';

                        return $btnVer . ' ' . $btnEditar . ' ' . $btnEliminar;
                    } else {
                        if (!$activity->cerrada) {
                            if ($alumnos = $activity->students->count() > 0) {
                                $btnAsignaciones = '<i class="text-info fa fa-address-book"></i>'
                                . '<a href="'
                                . route('actividades.asignaciones', $activity->id)
                                . '">'
                                . '<span class="text-info texto-accion">'
                                . trans('acciones_crud.seeassignments')
                                    . '</span>'
                                    . '</a>';
                            }
                        }

                        return $btnVer . ' ' . $btnAsignaciones;
                    }
                }
            )
            ->make(true);
    }

    /**
     * create: Se presenta el formulario para la creación de una nueva actividad
     */
    public function create()
    {
        $modo = 'new';
        $tactividades = $this->actividades->tiposactividad();
        $targets = $this->actividades->colectivosactividad();

        return view('backend.actividades.nueva', compact('modo', 'tactividades', 'targets'));
    }

    /**
     * store: Se guarda en la BBDD la actividad informada en el formulario de alta
     */
    public function store(CreateActivityRequest $request)
    {
        $data = $this->actividades->crearactividad($request);

        flash(trans('acciones_crud.addedactivity', ['actividad' => $data->nombre]))->success();
        return redirect('backend/actividades/gestion');
    }

    /**
     * view: Se presenta la vista con la información de la actividad guardada en la BBDD
     */
    public function view($id)
    {
        $modo = 'view';
        $actividad = $this->actividades->buscaractividadporid($id);

        return view('backend.actividades.ver', compact('actividad', 'modo'));
    }

    /**
     * edit: Se presenta la vista con el formulario de edición de la actividad seleccionada
     */
    public function edit($id)
    {
        $actividad = $this->actividades->buscaractividadporid($id);

        if ($actividad->students->count() === 0) {
            $modo = 'update';
            $tactividades = $this->actividades->tiposactividad();
            $targets = $this->actividades->colectivosactividad();
            return view('backend.actividades.editar', compact('actividad', 'tactividades', 'targets', 'modo'));
        } else {
            flash(trans('acciones_crud.noeditactivity', ['actividad' => $actividad->nombre]))->error();
            return redirect('backend/actividades/gestion');
        }
    }

    /**
     * update: Se actualiza la información de la actividad editada con la petición del usuario
     */
    public function update($id, CreateActivityRequest $request)
    {
        $actividad = $this->actividades->updateactividad($id, $request);

        flash(trans('acciones_crud.updateactivity', ['actividad' => $actividad->nombre]))->success();
        return redirect('backend/actividades/gestion');
    }

    /**
     * forcedelete: Se elimina de forma permanente de la BBDD la actividad seleccionada
     */
    public function forcedelete($id)
    {
        $actividad = $this->actividades->buscaractividadporid($id);
        $this->actividades->removeactividad($id);

        flash(trans('acciones_crud.deleteactivity', ['actividad' => $actividad->nombre]))->success();
        return redirect('backend/actividades/gestion');
    }

    /**
     * verAsignaciones: Se presenta la información de los alumnos asignados a la actividad
     */
    public function verAsignaciones($id_actividad)
    {
        $actividad = $this->actividades->buscaractividadporid($id_actividad);
        $total_autorizaciones = $this->actividades->totalAutorizaciones($id_actividad);

        return view('backend.actividades.verasignaciones', compact('actividad', 'total_autorizaciones'));
    }

    /**
     * noPublicadasData: Se construye la columna de la acción publicar de la tabla de
     * actividades
     */
    public function noPublicadasData()
    {
        $activities = $this->actividades->obtenerActividadesNoPublicadas();

        return DataTables::of($activities)
            ->addColumn(
                'action',
                function ($activity) {
                    $btnPublicar = '<i class="text-success fa fa-newspaper-o"></i>'
                    . '<a href="'
                    . url('backend/actividades/publicar/' . $activity->id)
                    . '">'
                    . '<span class="text-success texto-accion">'
                    . trans('acciones_crud.publish')
                        . '</span>'
                        . '</a>';

                    return $btnPublicar;
                }
            )
            ->make(true);
    }

    /**
     * publicarActividad: Se publica la actividad seleccionada en la tabla de actividades a
     * publicar
     */
    public function publicarActividad($id)
    {
        $actividad = $this->actividades->buscaractividadporid($id);
        $fecha = Carbon::parse($actividad->fechaactividad)->format('d-m-Y');

        $publicada = true;

        if ($actividad->activitytarget->destinoactividad === 'ALU') {
            $alumnos = $this->alumnos->alumnos();
            foreach ($alumnos as $alumno) {
                $alumno->activities()->attach($id);
                $alumno->user->notify(new ActividadPublicada($actividad, $alumno, $fecha));
            }
        } else {
            $colectivo = '%' . $actividad->activitytarget->destinoactividad . '%';

            $cursos = $this->cursos->buscarCursosPorColectivo($colectivo);

            foreach ($cursos as $curso) {
                $alumnos = $curso->students;
                foreach ($alumnos as $alumno) {
                    $alumno->activities()->attach($id);
                    $alumno->user->notify(new ActividadPublicada($actividad, $alumno, $fecha));
                }
            }
        }

        if ($this->actividades->marcarActividad($actividad, $publicada)) {
            $count_activities = $this->actividades->obtenerActividadesNoPublicadas()->count();
            if ($count_activities > 0) {
                flash(trans('message.activitypublished', ['actividad' => $actividad->nombre]))->success();
                return redirect(route('actividades.publishactivity'));
            } else {
                flash(trans('message.activitypublished', ['actividad' => $actividad->nombre]))->success();
                return redirect(route('actividades.gestion'));
            }
        }
    }

    /**
     * publicadasData: Se construye la columna de la acción cancelar en la tabla de actividades
     */
    public function publicadasData()
    {
        $activities = $this->actividades->obtenerActividadesPublicadas();

        return DataTables::of($activities)
            ->addColumn(
                'action',
                function ($activity) {
                    $btnCancelar = '<i class="text-danger fa fa-history"></i>'
                    . '<a href="'
                    . url('backend/actividades/cancelar/' . $activity->id)
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
     * cancelarActivida: Se procede a cancelar la actividad publicada para lo que primeramente
     * se desasigna dicha actividad de todos los alumnos a los que se les asignó cuando la
     * actividad fue publicada
     */
    public function cancelarActividad($id)
    {
        $actividad = $this->actividades->buscaractividadporid($id);

        // PENDIENTE: añadir validación entre la fecha de la actividad y la fecha de hoy

        $alumnos = $actividad->students;

        foreach ($alumnos as $alumno) {
            $actividad->students()->detach($alumno->id);
        }
        $publicada = false;

        if ($this->actividades->marcarActividad($actividad, $publicada)) {
            $count_activities = $this->actividades->obtenerActividadesPublicadas()->count();
            flash(trans('message.activitycanceled', ['actividad' => $actividad->nombre]))->success();
            if ($count_activities > 0) {
                return redirect(route('actividades.cancelactivity'));
            } else {
                return redirect(route('actividades.gestion'));
            }
        }
    }

    /**
     * asignacionesData: Se presenta la lista de estudiantes asignados a la actividad
     * seleccionada
     */
    public function asignacionesData($id_actividad)
    {
        $actividad = $this->actividades->buscaractividadporid($id_actividad);
        $students = $actividad->students;

        return DataTables::of($students)
            ->addColumn(
                'curso',
                function ($student) {
                    return $student->course->curso;
                }
            )
            ->addColumn(
                'autorizacion',
                function ($student) use ($actividad) {
                    $autorizacion = $this->actividades->alumnoActividad($student->id, $actividad->id);
                    return $autorizacion[0]->authorized;
                }
            )
            ->addColumn(
                'action',
                function ($student) use ($actividad) {
                    $autorizacion = $this->actividades->alumnoActividad($student->id, $actividad->id);

                    if (!$autorizacion[0]->authorized) {
                        $btnAutorizar = '<i class="text-success fa fa-check-circle-o"></i>'
                        . '<a href="'
                        . route('actividades.autorizaractividad', [$student->id, $actividad->id])
                        . '">'
                        . '<span class="text-success texto-accion">'
                        . trans('acciones_crud.authorize')
                            . '</span>'
                            . '</a>';
                        return $btnAutorizar;
                    } else {
                        $btnDesautorizar = '<i class="text-danger fa fa-ban"></i>'
                        . '<a href="'
                        . route('actividades.desautorizaractividad', [$student->id, $actividad->id])
                        . '">'
                        . '<span class="text-danger texto-accion">'
                        . trans('acciones_crud.override')
                            . '</span>'
                            . '</a>';
                        return $btnDesautorizar;
                    }
                }
            )
            ->make(true);
    }

    /**
     * autorizarActividad: Se autoriza la actividad seleccionada al alumno seleccionado
     */
    public function autorizarActividad($id_alumno, $id_actividad)
    {
        $actividad = $this->actividades->buscaractividadporid($id_actividad);
        $alumno = $this->alumnos->buscaralumnoporid($id_alumno);

        if ($actividad->fechaactividad >= Carbon::now()->format('Y-m-d')) {
            $this->actividades->autorizarActividadPivot($id_alumno, $id_actividad);

            flash(
                trans(
                    'acciones_crud.authorizeactivity',
                    ['actividad' => $actividad->nombre, 'alumno' => $alumno->nombre]
                )
            )->success();
        } else {
            flash(
                trans(
                    'acciones_crud.notauthorizeactivity',
                    ['actividad' => $actividad->nombre, 'alumno' => $alumno->nombre]
                )
            )->error();
        }

        return redirect(route('actividades.asignaciones', $id_actividad));
    }

    /**
     * desautorizarActividad: Se desautoriza la actividad seleccionada al alumno seleccionado
     */
    public function desautorizarActividad($id_alumno, $id_actividad)
    {
        $actividad = $this->actividades->buscaractividadporid($id_actividad);
        $alumno = $this->alumnos->buscaralumnoporid($id_alumno);

        $this->actividades->desautorizarActividadPivot($id_alumno, $id_actividad);

        flash(
            trans(
                'acciones_crud.overrideactivity',
                ['actividad' => $actividad->nombre, 'alumno' => $alumno->nombre]
            )
        )->success();

        return redirect(route('actividades.asignaciones', $id_actividad));
    }
}
