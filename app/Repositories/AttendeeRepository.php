<?php

namespace App\Repositories;

use App\Repositories\MeetingRepository;
use App\Attendee;

class AttendeeRepository
{
    protected $reuniones;
    protected $socios;

    /**
     * TopicRepository constructor.
     */
    public function __construct(MeetingRepository $reuniones, SocioRepository $socios)
    {
        $this->reuniones = $reuniones;
        $this->socios = $socios;
    }

    /**
     * buscarAsistentePorUserId
     */
    public function buscarAsistentePorId($id)
    {
        return Attendee::where('id', $id)->first();
    }

    /**
     * buscarAsistentePorUserId
     */
    public function buscarAsistentePorUserId($id)
    {
        return Attendee::where('user_id', $id)->first();
    }

    /**
     * asistentes
     */
    public function asistentes()
    {
        return Attendee::all();
    }

    /**
     * crearAsistentePorReunion
     */
    public function crearAsistentePorReunion($request)
    {
        $asistente = $this->socios->buscarsocioporid($request->id);

        $data = new Attendee();
        $data->user_id = $request->id;
        $data->nombre = $asistente->nombre . ' ' . $asistente->apellidos;
        $data->numdoc = $asistente->numdoc;

        $data->save();

        return $data;
    }

    /**
     * removeAsistentes
     */
    public function borraAsistente($id)
    {
        $asistente = $this->buscarAsistentePorId($id);
        $nombreAsistente = $asistente->nombre;
        $asistente->forceDelete();

        return $nombreAsistente;
    }
}
