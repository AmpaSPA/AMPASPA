<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Notificationtype;

class TiposnotificacionRepository
{
    /**
     * crearTipoNotificacion
     */
    public function crearTipoNotificacion($icononotificacion, $tiponotificacion, $textonotificacion)
    {
        if ($this->buscarNotificacionPorTipo($tiponotificacion)->count() === 0) {
            $data = new Notificationtype();
            $data->icono = $icononotificacion;
            $data->tiponotificacion = $tiponotificacion;
            $data->notificacion = $textonotificacion;
            $data->save();
        }
    }

    /**
     * textoNotificacionesPorTipo
     */
    public function textoNotificacionPorTipo($tiponotificacion)
    {
        return DB::table('notificationtypes')
            ->select(['icono', 'notificacion'])
            ->where('tiponotificacion', $tiponotificacion)
            ->first();
    }

    /**
     * buscarNotificacionPorTipo
     */
    public function buscarNotificacionPorTipo($tiponotificacion)
    {
        return Notificationtype::all()->where('tiponotificacion', $tiponotificacion);
    }
}
