<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'periodo',
        'codigo',
        'fecha',
        'emisor',
        'destinatario',
        'concepto',
        'factura',
        'importe'
    ];

    /**
     * Relación Uno a Uno con la tabla Entradas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
}
