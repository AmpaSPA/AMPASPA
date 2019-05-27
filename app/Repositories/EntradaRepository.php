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
    protected $facturas;
    protected $tipoEntrada;

    /**
     * __construct
     *
     * @param  mixed $periodos
     *
     * @return void
     */
    public function __construct(
        PeriodoRepository $periodos,
        SocioRepository $socios,
        FacturaRepository $facturas,
        EntrytypeRepository $tipoEntrada
    ) {
        $this->periodos    = $periodos;
        $this->socios      = $socios;
        $this->facturas    = $facturas;
        $this->tipoEntrada = $tipoEntrada;
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
    public function totalImportesPeriodo($periodo)
    {
        return DB::table('entries')
            ->where('periodo', $periodo)
            ->select(DB::raw('entrytype_id, sum(importe) as total_importe'))
            ->groupBy('entrytype_id')
            ->get();
    }

    /**
     * totalEntradasPeriodo
     */
    public function totalEntradasPeriodo($periodo, $tipo_id)
    {
        return Entry::wherePeriodoAndEntrytypeId($periodo, $tipo_id)->count();
    }

    /**
     * crearEntrada
     */
    public function crearEntrada($request)
    {
        $data = new Entry();

        $data->periodo      = $this->periodos->buscarPeriodoActivo()->periodo;
        $data->invoice_id   = $request->invoice_id;
        $data->entrytype_id = $request->entrytype_id;
        $data->descripcion  = $request->descripcion;
        $data->importe      = $this->facturas->buscarFacturaPorId($request->invoice_id)->importe;
        $data->save();

        return $data;
    }

    /**
     * crearEntradaReciboSocio
     */
    public function crearEntradaReciboSocio($datosEntrada)
    {
        if ($this->buscarEntradaPorFacturaId($datosEntrada['invoice_id']) === null) {
            $data = new Entry();

            $data->periodo      = $datosEntrada['periodo'];
            $data->invoice_id   = $datosEntrada['invoice_id'];
            $data->entrytype_id = $datosEntrada['entrytype_id'];
            $data->descripcion  = $datosEntrada['descripcion'];
            $data->importe      = $datosEntrada['importe'];
            $data->domiciliacion = $datosEntrada['domiciliacion'];

            $data->save();
        }

        return $data;
    }

    /**
     * updateEntrada
     */
    public function updateEntrada($id, $request)
    {
        $entrada = $this->buscarEntradaPorId($id);

        $entrada->periodo = $this->periodos->buscarPeriodoActivo()->periodo;

        if ($request->invoice_id) {
            $entrada->invoice_id = $request->invoice_id;
        }
        if ($request->entrytype_id) {
            $entrada->entrytype_id = $request->entrytype_id;
        }
        if ($request->descripcion) {
            $entrada->descripcion = $request->descripcion;
        }

        $entrada->importe = $this->facturas->buscarFacturaPorId($request->invoice_id)->importe;

        $entrada->save();

        return $entrada;
    }

    /**
     * calcularImportesPeriodo
     */
    public function calcularImportesPeriodo($periodo)
    {
        $totalIngresosPeriodo = 0;
        $totalGastosPeriodo   = 0;
        $saldoPeriodo         = 0;

        $totalEntradasPeriodo = [
            'ingreso' => $totalIngresosPeriodo,
            'gasto'   => $totalGastosPeriodo,
            'saldo'   => $saldoPeriodo,
        ];

        $totalImportesPeriodo = $this->totalImportesPeriodo($periodo);

        foreach ($totalImportesPeriodo as $importe) {
            if ($this->tipoEntrada->buscarTipoEntradaPorId($importe->entrytype_id)->tipoentrada === 'Ingreso') {
                $totalEntradasPeriodo['ingreso'] = $importe->total_importe;
            } else {
                $totalEntradasPeriodo['gasto'] = $importe->total_importe;
            }
        };

        $totalEntradasPeriodo['saldo'] = $totalEntradasPeriodo['ingreso'] - $totalEntradasPeriodo['gasto'];

        return $totalEntradasPeriodo;
    }

    /**
     * borrarEntrada
     */
    public function borrarEntrada($id)
    {
        return Entry::where('id', '=', $id)->forceDelete();
    }
}
