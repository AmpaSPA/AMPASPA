<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MeetingRepository;
use App\Repositories\ProceedingRepository;

class ActasController extends Controller
{
    protected $reuniones;
    protected $actas;

    /**
     * __construct: Constructor de la clase. Usa los modelos: Meeting y Proceeding
     */
    public function __construct(MeetingRepository $reuniones, ProceedingRepository $actas)
    {
        $this->reuniones = $reuniones;
        $this->actas = $actas;
    }
    /**
     * index
     */
    public function index()
    {
        return view('backend.actas.index');
    }

    /**
     * actasdata
     */
    public function actasdata()
    {
        $proceedings = $this->actas->actas();

        return DataTables::of($proceedings)
            ->addColumn(
                'reunion',
                function ($proceeding) {
                    return $this->reuniones->buscarreunionporid($proceeding->id);
                }
            )
            ->addColumn(
                'action',
                function ($proceeding) {
                    $btnVer = '<i class="text-success fa fa-eye"></i>'
                    . '<a href = "'
                    . url('backend/socios/ver/'.$proceeding->id)
                    . '">'
                    . '<span class="text-success texto-accion">'
                    . trans('acciones_crud.view')
                    . '</span>'
                    . '</a>';
                    $btnEditar = '<i class="text-warning fa fa-pencil"></i>'
                    . '<a href="'
                    . url('backend/socios/edit/'.$proceeding->id)
                    . '">'
                    . '<span class="text-warning texto-accion">'
                    . trans('acciones_crud.edit')
                    . '</span>'
                    . '</a>';
                    $btnEliminar = '<i class="text-danger fa fa-trash"></i>'
                    . '<a href="'
                    . url('backend/socios/borrar/'.$proceeding->id)
                    . '">'
                    . '<span class="text-danger texto-accion">'
                    . trans('acciones_crud.delete')
                    . '</span>'
                    . '</a>';
                    $btnAlumnos = '<i class="text-info fa fa-graduation-cap"></i>'
                    . '<a href="'
                    . url('/backend/alumnos/create/socio/'.$proceeding->id)
                    . '">'
                    . '<span class="text-info texto-accion">'
                    . trans('acciones_crud.students')
                    . '</span>'
                    . '</a>';

                    return $btnVer . ' ' . $btnEditar . ' ' . $btnEliminar . ' ' . $btnAlumnos;
                }
            )
        ->make(true);
    }
}
