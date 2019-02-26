<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\SocioRepository;
use App\Repositories\PeriodoRepository;

class NotificationRepository
{
    protected $periodos;
    protected $socios;

    /**
     * __construct
     *
     * @param  mixed $periodos
     *
     * @return void
     */
    public function __construct(PeriodoRepository $periodos, SocioRepository $socios)
    {
        $this->periodos = $periodos;
        $this->socios = $socios;
    }

    /**
     * notificacionesPendientesPorUserid
     */
    public function tipoNotificacionesPendientesPorUserid($user_id)
    {
        return $notificaciones = DB::table('notifications')
                                ->whereNull('read_at')
                                ->where('notifiable_id', $user_id)
                                ->select(DB::raw('type, count(*) as total_tipo'))
                                ->groupBy('type')
                                ->get();
    }

    /**
     * notificacionesPorTipoyUserid
     */
    public function notificacionesPorTipoyUserid($tipo, $user_id)
    {
        return $this->socios->buscarsocioporid($user_id)->unreadNotifications->where('type', $tipo);
    }

    /**
     * notificacionesPorIdyUserid
     */
    public function notificacionesPorIdyUserid($id, $user_id)
    {
        return $this->socios->buscarsocioporid($user_id)->unreadNotifications->where('id', $id)->last();
    }
}
