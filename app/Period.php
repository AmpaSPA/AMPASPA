<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    /**
     * @var string
     */
    protected $table = 'periods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'periodo',
        'aniodesde',
        'aniohasta',
        'cuota',
        'ingresos',
        'gastos',
        'saldo',
        'totalsocios',
        'activo',
    ];

    public function proceedings()
    {
        return $this->hasMany('App\Proceeding');
    }
}
