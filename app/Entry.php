<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table = 'entries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'periodo',
        'entrytype_id',
        'descripcion',
        'importe'
    ];

    /**
     * Relación Uno a Uno con la tabla Facturas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Relación Uno a Uno con la tabla Tipos de entrada
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entrytype()
    {
        return $this->belongsTo(Entrytype::class);
    }
}
