<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Repositories\TopicRepository;
use App\Repositories\AcuerdoRepository;
use App\Repositories\MeetingRepository;
use App\Repositories\ProceedingRepository;
use App\Http\Requests\CreateAcuerdoRequest;

class AcuerdosController extends Controller
{
    protected $reuniones;
    protected $temas;
    protected $acuerdos;
    protected $actas;

    /**
     * __construct: Constructor de la clase. Usa los modelos: Meeting y Proceeding
     */
    public function __construct(
        MeetingRepository $reuniones,
        TopicRepository $temas,
        AcuerdoRepository $acuerdos,
        ProceedingRepository $actas
    ) {
        $this->reuniones = $reuniones;
        $this->temas = $temas;
        $this->acuerdos = $acuerdos;
        $this->actas = $actas;
    }

    /**
     * nuevoAcuerdoTema
     */
    public function nuevoAcuerdoTema($reunion_id)
    {
        $temas = $this->temas->buscarTemasNoAcordadosPorReunion($reunion_id);
        $modo = 'new';

        foreach ($temas as $tema) {
            return view('backend.acuerdos.nuevo', compact('reunion_id', 'tema', 'modo'));
        }
    }

    /**
     * nuevoAcuerdo
     */
    public function nuevoAcuerdo(CreateAcuerdoRequest $request)
    {
        $this->acuerdos->crearAcuerdo($request);
        $this->temas->marcarTemaAcordado($request->topic_id, true);

        if ($this->temas->buscarTemasNoAcordadosPorReunion($request->reunion_id)->count() > 0) {
            return redirect(route('acuerdos.acuerdostemas', $request->topic_id));
        } else {
            $this->actas->ponerFechaDeAutoria($request->reunion_id);
            return redirect(route('actas.list'));
        }
    }


    /**
     * acuerdo
     */
    public function acuerdo($tema_id)
    {
        $tema = $this->temas->buscarTopicPorId($tema_id);
        $reunion_id = $tema->meeting_id;
        $acuerdo = $this->acuerdos->buscarAcuerdoPorTema($tema_id);
        $modo = 'update';

        return view('backend.acuerdos.update', compact('tema', 'acuerdo', 'modo', 'reunion_id'));
    }

    /**
     * updateAcuerdo
     */
    public function updateAcuerdo(CreateAcuerdoRequest $request)
    {
        $tema = $this->temas->buscarTopicPorId($request->topic_id);
        $this->acuerdos->actualizarAcuerdo($request);

        flash(trans('message.agreementupdated', ['tema' => $tema->titulo]))->success();
        return redirect(route('acuerdos.list', $request->reunion_id));
    }

    /**
     * index
     */
    public function index($id_reunion)
    {
        $reunion = $this->reuniones->buscarReunionPorId($id_reunion);

        $fecha = Carbon::parse($reunion->fechareunion)->format('d-m-Y');
        $tipo = $reunion->meetingtype->tiporeunion;

        return view('backend.acuerdos.index', compact('id_reunion', 'fecha', 'tipo'));
    }

    /**
     * acuerdosData
     */
    public function acuerdosData($id_reunion)
    {
        $reunion = $this->reuniones->buscarReunionPorId($id_reunion);

        $topics = $reunion->topics;

        return DataTables::of($topics)
            ->addColumn(
                'action',
                function ($topic) {
                    $btnActualizarAcuerdo = '<i class="text-warning fa fa-pencil"></i>'
                    . '<a href="'
                    . route('acuerdos.acuerdo', $topic->id)
                    . '">'
                    . '<span class="text-warning texto-accion">'
                    . trans('acciones_crud.updateagreement')
                        . '</span>'
                        . '</a>';

                    return $btnActualizarAcuerdo;
                }
            )
            ->make(true);
    }
}
