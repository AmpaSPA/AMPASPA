<?php

namespace App\Repositories;

use App\Entrytype;

class EntrytypeRepository
{

    /**
     * buscarIdPorTipoEntrada
     */
    public function buscarIdPorTipoEntrada($tipo)
    {
        return Entrytype::whereTipoentrada($tipo)->first();
    }

    /**
     * buscarTipoEntradaPorId
     */
    public function buscarTipoEntradaPorId($id)
    {
        return Entrytype::whereId($id)->first();
    }

    /**
     * tiposEntrada
     */
    public function tiposEntrada()
    {
        return Entrytype::all()->pluck('tipoentrada', 'id');
    }
}
