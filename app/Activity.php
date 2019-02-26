<?php
/**
 * PHP VERSION 7.2.5
 *
 * @abstract Definición del modelo actividades
 * @category PHP
 * @package  Ampaspa
 * @author   Luis Ponce Melero <lpmelero@gmail.com>
 * @license  http://ampaspa.local FREE
 * @link     http://ampaspa.local
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Actividades
 *
 * @category PHP
 * @package  Ampaspa
 * @author   Luis Ponce Melero <lpmelero@gmail.com>
 * @license  http://ampaspa.local FREE
 * @link     http://ampaspa.local
 */

class Activity extends Model
{
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'periodo',
        'fechaactividad',
        'nombre',
        'descripcion',
        'activitytype_id',
        'activitytarget_id',
        'subvencion',
        'precio'
    ];

    /**
     * Relación Muchos a Muchos con la tabla alumnos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany('App\Student', 'activity_student')
                    ->withPivot('activity_id', 'authorized')
                    ->withTimestamps();
    }

    /**
     * Relación Uno a Uno con la tabla Tipos de actividad
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activitytype()
    {
        return $this->belongsTo(Activitytype::class);
    }

    /**
     * Relación Uno a Muchos con la tabla colectivos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activitytarget()
    {
        return $this->belongsTo(Activitytarget::class);
    }
}
