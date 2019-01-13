<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CreateStudentRequest;
use Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Repositories\SocioRepository;
use App\Repositories\AlumnoRepository;
use App\Repositories\CursoRepository;
use App\Http\Controllers\Controller;
use App\Repositories\ActivityRepository;

/**
 * Clase del controlador para la administración de los alumnos
 */
class AlumnosController extends Controller
{
    protected $socios;
    protected $alumnos;
    protected $cursos;

    /**
     * __construct: Constructor de la clase. Usa los modelos User, Student, Course y Activity
     */
    public function __construct(
        SocioRepository $socios,
        AlumnoRepository $alumnos,
        CursoRepository $cursos,
        ActivityRepository $actividades
    ) {
        $this->socios = $socios;
        $this->alumnos = $alumnos;
        $this->cursos = $cursos;
        $this->actividades = $actividades;
    }

    /*
     * create: Se presenta el formulario para la creación de un nuevo alumno
     */
    public function create($id)
    {
        $modo = 'new';
        $alumnosbaja = $this->alumnos->obteneralumnosenbaja();
        $socio = $this->socios->buscarsocioporid($id);
        $alumnos = $this->socios->alumnosporsocio($id);
        $listacursos = '';
        $hijos = [];

        foreach ($alumnos as $alumno) {
            $hijos[] = array(
                'id' => $alumno->id,
                'nombre' => $alumno->nombre,
                'anionacim' => $alumno->anionacim
            );
        }

        return view('backend.alumnos.nuevo', compact('alumnosbaja', 'socio', 'hijos', 'modo', 'listacursos'));
    }

    /**
     * store: Se guarda en la BBDD el nuevo alumno
     */
    public function store(CreateStudentRequest $request)
    {
        $alumno = $this->socios->crearalumnoporsocio($request);
        $socio = $this->socios->buscarsocioporid($request->user_id);
        $nombre_socio = $socio->nombre . ' ' . $socio->apellidos;

        flash(trans('acciones_crud.addedstudent', ['alumno' => $alumno->nombre, 'socio' => $nombre_socio]))->success();
        return redirect()->back();
    }

    /**
     * listabajas: Se presenta la página con los alumnos en estado de baja
     */
    public function listabajas($socio)
    {
        $alumnosbajas = $this->alumnos->obteneralumnosenbaja();
        return view('backend.alumnos.listadobajas', compact('socio', 'alumnosbajas'));
    }

    /**
     * view: Se presenta la pgina para ver los datos del alumno
     */
    public function view($id)
    {
        $modo = 'view';
        $alumno = $this->alumnos->buscaralumnoporid($id);

        return view('backend.alumnos.ver', compact('alumno', 'modo'));
    }

    /**
     * edit: Se presenta la página que recoge los datos del alumno actualmente guardados en la BBDD
     */
    public function edit($id)
    {
        $modo = 'update';
        $socio = $this->socios->buscarsocioporid($id);
        $alumno = $this->alumnos->buscaralumnoporid($id);
        $listacursos = $this->cursos->listacursos();

        return view('backend.alumnos.editar', compact('socio', 'alumno', 'modo', 'listacursos'));
    }

    /**
     * update: Se actualizan en BBDD los datos del alumno seleccionado
     */
    public function update($id, CreateStudentRequest $request)
    {
        $alumno = $this->alumnos->updatealumno($id, $request);

        flash(trans('acciones_crud.updatedstudent', ['alumno' => $alumno->nombre]))->success();
        return redirect(url('backend/alumnos/create/socio', $request->user_id));
    }

    /**
     * delete: Se marca el alumno que pasa a tener su estado como baja
     */
    public function delete($id)
    {
        $alumno = $this->alumnos->borraralumno($id);

        flash(trans('acciones_crud.deletestudent', ['alumno' => $alumno->nombre]))->success();
        return redirect()->back();
    }

    /**
     * gestionbajas: Se presenta la página con todos los alumnos marcados como baja
     */
    public function gestionbajas($socio)
    {
        $socio = $this->socios->buscarsocioporid($socio);
        $alumnosbajas = $this->alumnos->obteneralumnosenbaja();
        return view('backend.alumnos.gestionbajas', compact('socio', 'alumnosbajas'));
    }

    /**
     * restaurar: Se da vuelve a marcar al alumno como activo
     */
    public function restaurar($id)
    {
        $alumno = $this->alumnos->restauraralumno($id);

        flash(trans('acciones_crud.restorestudent', ['alumno' => $alumno->nombre]))->success();
        return redirect(url('backend/alumnos/create/socio', $alumno->user_id));
    }

    /**
     * bajadefinitiva: Se elimina al alumno de forma definitiva en la BBDD
     */
    public function bajadefinitiva($id)
    {
        $alumno = $this->alumnos->removealumno($id);

        flash(trans('acciones_crud.removestudent', ['alumno' => $alumno->nombre]))->success();
        return redirect(url('backend/alumnos/create/socio', $alumno->user_id));
    }
}
