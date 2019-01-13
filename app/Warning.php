<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    /**
     * @var string
     */
    protected $table = 'warnings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'fecha',
    'codigo',
    'aviso',
    'solucion',
    'user_id',
    'cerrado',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
