<?php

namespace App\Repositories;

use App\Agree;
use App\Repositories\TopicRepository;

class AcuerdoRepository
{
    protected $temas;

    public function __construct(TopicRepository $temas)
    {
        $this->temas = $temas;
    }
    /**
     * buscarTopicPorId
     */
    public function buscarAcuerdoPorTema($tema_id)
    {
        return Agree::where('topic_id', $tema_id)->first();
    }

    /**
     * crearAcuerdo
     */
    public function crearAcuerdo($request)
    {
        $data = new Agree();
        $data->acuerdo = $request->acuerdo;
        $data->topic_id = $request->topic_id;

        $data->save();

        return $data;
    }

    public function actualizarAcuerdo($request)
    {
        $tema = $this->temas->buscarTopicPorId($request->topic_id);

        $acuerdo = $tema->agree;
        $acuerdo->acuerdo = $request->acuerdo;

        return $acuerdo->save();
    }

    /**
     * borraTema
     */
    public function borraTema($id)
    {
        Topic::whereId($id)->forceDelete();
    }
}
