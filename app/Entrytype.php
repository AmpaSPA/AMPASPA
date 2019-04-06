<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrytype extends Model
{
    /**
     * @var string
     */
    protected $table = 'entrytypes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipoentrada',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entries()
    {
        return $this->hasMany('App\Entry');
    }}
