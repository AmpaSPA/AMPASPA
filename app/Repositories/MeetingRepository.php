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
     * MeetingRepository constructor.
     * @param PeriodoRepository $periodos
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
     * obtenerReunionesNoConvocadas
     */
    public function obtenerReunionesNoConvocadas()
    {
        return Meeting::All()->where('convocada', false)->where('celebrada', false);
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

                    $fecha = Carbon::parse($reunion->fechareunion)->format('d-m-Y');
                    $correo = false;

                    foreach ($reunion->attendees as $asistente) {
                        $notificaciones = $this->notificaciones->notificacionesPorTipoyUserid(
                            'App\Notifications\ReunionConvocada',
                            $asistente->id
                        );
                        foreach ($notificaciones as $notificacion) {
                            if ($notificacion->data['reunion']['id'] === $reunion->id) {
                                $notificacion->delete();
                                $this->socios->buscarsocioporid($asistente->id)
                                ->notify(new ReunionConvocada($reunion, $fecha, $correo));
                            }
                        }
                    }
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
}
