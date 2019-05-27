<?php

/**
 * Created by PhpStorm.
 * User: papete
 * Date: 22/06/17
 * Time: 0:47
 */

namespace App\Repositories;

use App\Activitytype;

class ActivitytypeRepository
{
    /**
     * buscarTipoActividadPorId
     */
    public function buscarTipoActividadPorId($id)
    {
        return Activitytype::find($id)->tipoactividad;
    }
}
