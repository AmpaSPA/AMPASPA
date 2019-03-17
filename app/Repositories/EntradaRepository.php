<?php

namespace App\Repositories;

use App\Entry;
use App\Repositories\PeriodoRepository;
use App\Repositories\SocioRepository;
use Illuminate\Support\Facades\DB;

class EntradaRepository
{
    protected $periodos;
    protected $socios;

    /**
     * __construct
     *
     * @param  mixed $periodos
     *
     * @return void
     */
    public function __construct(PeriodoRepository $periodos, SocioRepository $socios)
    {
        $this->periodos = $periodos;
        $this->socios = $socios;
    }

    /**
     * notificacionesPendientesPorUserid
     */
    public function totalImportePeriodo($periodo, $tipo)
    {
        return DB::table('entries')
            ->where('periodo', $periodo)
            ->where('tipo', $tipo)
            ->select(DB::raw('sum(importe) as total_importe'))
            ->groupBy('tipo')
            ->first();
    }

    /**
     * totalEntradasPeriodo
     */
    public function totalEntradasPeriodo($periodo, $tipo)
    {
        return Entry::wherePeriodoAndTipo($periodo, $tipo)->count();
    }
}
