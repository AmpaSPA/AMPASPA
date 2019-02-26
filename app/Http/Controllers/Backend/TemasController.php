<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTopicRequest;
use App\Repositories\MeetingRepository;
use App\Repositories\TopicRepository;
use Carbon\Carbon;

class TemasController extends Controller
{
    protected $reuniones;
    protected $temas;

    /**
     * __construct: Constructor de la clase. Usa los modelos: Meeting y Topic
     */
    public function __construct(MeetingRepository $reuniones, TopicRepository $temas)
    {
        $this->reuniones = $reuniones;
        $this->temas = $temas;
    }

    /*
     * create: Se presenta el formulario para la creación de un nuevo tema
     */
    public function create($id)
    {
        $modo = 'new';
        $reunion = $this->reuniones->buscarReunionPorId($id);
        $temas = $this->temas->temasPorReunion($id);
        $fecha = Carbon::parse($reunion->fechareunion)->format('d-m-Y');

        $apartados = [];

        foreach ($temas as $tema) {
            $apartados[] = array(
                'id' => $tema->id,
                'titulo' => $tema->titulo,
                'propietario' => $tema->propietario
            );
        }

        return view('backend.temas.nuevo', compact('reunion', 'apartados', 'modo', 'fecha'));
    }

    /**
     * store: Se guarda en la BBDD el tema informado en el formulario de alta
     */
    public function store(CreateTopicRequest $request)
    {
        $tema = $this->temas->crearTemaPorReunion($request);

        return redirect()->back();
    }

    /**
     * ver: Se presenta la página para ver los datos del tema
     */
    public function ver($id)
    {
        $modo = 'view';
        $tema = $this->temas->buscarTopicPorId($id);

        return view('backend.temas.ver', compact('tema', 'modo'));
    }

    /**
     * editar: Se presenta la página que recoge los datos del tema actualmente guardados en la BBDD
     */
    public function editar($id)
    {
        $modo = 'update';
        $tema = $this->temas->buscarTopicPorId($id);

        return view('backend.temas.editar', compact('tema', 'modo'));
    }

    /**
     * update: Se actualizan en BBDD los datos del tema seleccionado
     */
    public function update($id, CreateTopicRequest $request)
    {
        $tema = $this->temas->updateTema($id, $request);

        flash(trans('acciones_crud.updatedtopic', ['titulo' => $tema->titulo]))->success();
        return redirect(route('temas.reunion', $tema->meeting_id));
    }

    /**
     * delete: Se elimina de forma permanente de la BBDD el tema seleccionado
     */
    public function delete($id)
    {
        $tema = $this->temas->buscarTopicPorId($id);
        $reunion_id = $tema->meeting_id;
        $this->temas->borraTema($id);

        flash(trans('acciones_crud.deletetopic', ['titulo' => $tema->titulo]))->success();
        return redirect(route('temas.reunion', $reunion_id));
    }

    /**
     * verTemasReunion
     */
    public function verTemasReunion($id)
    {
        $modo = 'list';

        $reunion = $this->reuniones->buscarReunionPorId($id);
        $fecha = Carbon::parse($reunion->fechareunion)->format('d-m-Y');
        $tipo = $reunion->meetingtype->tiporeunion;
        $temas = $reunion->topics;

        return view('backend.temas.temasreunion', compact('temas', 'reunion', 'modo', 'fecha', 'tipo'));
    }
}
