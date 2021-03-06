<?php

namespace App\Repositories;

use App\Meeting;
use Carbon\Carbon;
use App\Meetingtype;
use Illuminate\Support\Facades\DB;
use App\Notifications\ReunionConvocada;
use App\Repositories\PeriodoRepository;
use App\Repositories\NotificationRepository;

class MeetingRepository
{
    protected $periodos;
    protected $notificaciones;
    protected $socios;
    protected $actas;


    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        PeriodoRepository $periodos,
        NotificationRepository $notificaciones,
        SocioRepository $socios,
        ProceedingRepository $actas
    ) {
        $this->periodos = $periodos;
        $this->notificaciones = $notificaciones;
        $this->socios = $socios;
        $this->actas = $actas;
    }

    /**
     * reuniones
     */
    public function reuniones()
    {
        return Meeting::all();
    }

    /**
     * buscarReunionPorId
     */
    public function buscarReunionPorId($id)
    {
        return Meeting::find($id);
    }

    /**
     * tiposReunion
     */
    public function tiposReunion()
    {
        return Meetingtype::all()->pluck('tiporeunion', 'id');
    }

    /**
     * crearReunion
     */
    public function crearReunion($request)
    {
        $periodo = $this->periodos->buscarPeriodoActivo();

        $data = new Meeting();
        $data->periodo = $periodo->periodo;
        $data->fechareunion = $request->fechareunion;
        $data->horareunion = $request->horareunion;
        $data->horafinreunion = Carbon::parse($data->horareunion)->addHours(2);
        $data->meetingtype_id = $request->meetingtype_id;
        $data->nota = $request->nota;
        $data->save();

        return $data;
    }

    /**
     * obtenerReunionesConvocadas
     */
    public function obtenerReunionesConvocadas()
    {
        return Meeting::All()->where('convocada', true)->where('celebrada', false);
    }

    /**
     * obtenerReunionesNoConvocadasConformadas
     */
    public function obtenerReunionesNoConvocadasConformadas()
    {
        return Meeting::All()->where('convocada', false)->where('celebrada', false)->where('conformada', true);
    }

    /**
     * updateReunion
     */
    public function updateReunion($id, $request)
    {
        $reunion = $this->buscarReunionPorId($id);

        $reunion->convocada = false;
        $reunion->celebrada = false;

        if ($request->fechareunion) {
            $reunion->fechareunion = $request->fechareunion;
        }
        if ($request->horareunion) {
            $reunion->horareunion = $request->horareunion;
            $reunion->horafinreunion = Carbon::parse($reunion->horareunion)->addHours(2);
        }
        if ($request->meetingtype_id) {
            $reunion->meetingtype_id = $request->meetingtype_id;
        }
        if ($request->nota) {
            $reunion->nota = $request->nota;
        }

        $reunion->save();

        return $reunion;
    }

    /**
     * removeReunion
     */
    public function removeReunion($id)
    {
        return Meeting::where('id', '=', $id)->forceDelete();
    }

    /**
     * marcarReunion
     */
    public function marcarReunion($reunion, $marca)
    {
        $reunion->convocada = $marca;
        return $reunion->save();
    }

    /**
     * cerrarReuniones
     */
    public function cerrarReuniones()
    {
        if ($this->reuniones()->count() > 0) {
            foreach ($this->reuniones() as $reunion) {
                if ($reunion->fechareunion < Carbon::now()->format('Y-m-d') && !$reunion->celebrada) {
                    $reunion->celebrada = true;
                    $reunion->save();

                    $this->actas->crearRegistroActa($reunion->id);
                }
            }
        }
        return;
    }

    /**
     * confirmarReunionPivot
     *
     * @param  mixed $id_reunion
     * @param  mixed $id_asistente
     *
     * @return void
     */
    public function confirmarReunionPivot($id_reunion, $id_asistente)
    {
        return DB::table('attendee_meeting')
            ->where('attendee_id', '=', $id_asistente)
            ->where('meeting_id', '=', $id_reunion)
            ->update(array('confirmed' => true));
    }

    /**
     * comprobarReunionConformada
     *
     * @param  mixed $id_reunion
     *
     * @return void
     */
    public function comprobarReunionConformada($id_reunion)
    {
        $reunion = $this->buscarReunionPorId($id_reunion);

        if (!$reunion->topics()->exists() || !$reunion->attendees()->exists()) {
            $reunion->conformada = false;
            $reunion->save();
        } else {
            $reunion->conformada = true;
            $reunion->save();
        }
    }
}
