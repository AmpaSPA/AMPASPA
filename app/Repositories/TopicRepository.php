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
     * buscarTopicPorId
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
        $data->titulo = strtoupper($request->titulo);
        $data->propietario = strtoupper($request->propietario);
        $data->responsable = strtoupper($request->responsable);
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
            $tema->titulo = strtoupper($request->titulo);
        }
        if ($request->propietario) {
            $tema->propietario = strtoupper($request->propietario);
        }
        if ($request->responsable) {
            $tema->responsable = strtoupper($request->responsable);
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

    /**
     * buscarTemasNoAcordadosPorReunion
     */
    public function buscarTemasNoAcordadosPorReunion($id_reunion)
    {
        return Topic::whereMeeting_idAndAcordado($id_reunion, false)->get();
    }

    /**
     * marcarTemaAcordado
     */
    public function marcarTemaAcordado($id_tema, $marca)
    {
        $tema = $this->buscarTopicPorId($id_tema);
        $tema->acordado = $marca;

        return $tema->save();
    }
}
