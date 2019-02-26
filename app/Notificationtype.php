<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificationtype extends Model
{
    /**
     * @var string
     */
    protected $table = 'notificationtypes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icono',
        'tiponotificacion',
        'notificacion'
    ];

}
