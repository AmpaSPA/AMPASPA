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
     * buscarEntradaPorId
     */
    public function buscarEntradaPorId($id)
    {
        return Entry::find($id);
    }

    /**
     * buscarEntradaPorFacturaId
     */
    public function buscarEntradaPorFacturaId($id_factura)
    {
        return Entry::whereInvoiceId($id_factura)->first();
    }

    /**
     * entradasPeriodo
     */
    public function entradasPeriodo($periodo)
    {
        return Entry::wherePeriodo($periodo)->get();
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

    /**
     * crearEntrada
     */
    public function crearEntrada($request)
    {
        $data = new Entry();

        $data->periodo = $this->periodos->buscarPeriodoActivo()->periodo;
        $data->invoice_id = $request->factura;
        $data->fecha = $request->fecha;
        $data->tipo = $request->tipo;
        $data->descripcion = $request->descripcion;
        $data->importe = $request->importe;
        $data->save();

        return $data;
    }

    public function updateEntrada($id, $request)
    {
        $entrada = $this->buscarEntradaPorId($id);

        $entrada->periodo = $this->periodos->buscarPeriodoActivo()->periodo;

        if ($request->fecha) {
            $entrada->fecha = $request->fecha;
        }
        if ($request->emisor) {
            $entrada->emisor = strtoupper($request->emisor);
        }
        if ($request->destinatario) {
            $entrada->destinatario = strtoupper($request->destinatario);
        }
        if ($request->tipo) {
            $entrada->tipo = $request->tipo;
        }
        if ($request->concepto) {
            $entrada->concepto = $request->concepto;
        }
        if ($request->descripcion) {
            $entrada->descripcion = $request->descripcion;
        }
        if ($request->codigofactura) {
            $entrada->codigofactura = $request->codigofactura;
        }
        if ($request->importe) {
            $entrada->importe = $request->importe;
        }

        $entrada->save();

        return $entrada;
    }

    /**
     * borrarEntrada
     */
    public function borrarEntrada($id)
    {
            return Entry::where('id', '=', $id)->forceDelete();
    }
}
