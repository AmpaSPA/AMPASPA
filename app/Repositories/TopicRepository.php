<?php

namespace App\Repositories;

use App\Repositories\MeetingRepository;
use App\Topic;

class TopicRepository
{
    protected $reuniones;

    /**
     * TopicRepository constructor.
     * @param MeetingRepository $periodos
     */
    public function __construct(MeetingRepository $reuniones)
    {
        $this->reuniones = $reuniones;
    }
    /**
     * buscaractaporid
     */
    public function buscarTopicPorId($id)
    {
        return Topic::find($id);
    }

    /**
     * temas
     */
    public function temas()
    {
        return Topic::all();
    }

    public function temasPorReunion($id)
    {
        return $this->reuniones->buscarReunionPorId($id)->topics()->orderBy('titulo')->get();
    }

    /**
     * crearTemaPorReunion
     */
    public function crearTemaPorReunion($request)
    {
        $data = new Topic();
        $data->titulo = $request->titulo;
        $data->propietario = $request->propietario;
        $data->responsable = $request->responsable;
        $data->tema = $request->tema;
        $data->meeting_id = $request->meeting_id;

        $meeting = $this->reuniones->buscarReunionPorId($request->meeting_id);

        $meeting->topics()->save($data);

        return $data;
    }

    /**
     * removeTemas
     */
    public function removeTemas($id)
    {
        Topic::where('meeting_id', '=', $id)->forceDelete();
    }

    /**
     * updateTema
     */
    public function updateTema($id, $request)
    {
        $tema = $this->buscarTopicPorId($id);

        if ($request->titulo) {
            $tema->titulo = $request->titulo;
        }
        if ($request->propietario) {
            $tema->propietario = $request->propietario;
        }
        if ($request->responsable) {
            $tema->responsable = $request->responsable;
        }
        if ($request->tema) {
            $tema->tema = $request->tema;
        }

        $tema->save();

        return $tema;
    }

    /**
     * borraTema
     */
    public function borraTema($id)
    {
        Topic::where('id', '=', $id)->forceDelete();
    }
}