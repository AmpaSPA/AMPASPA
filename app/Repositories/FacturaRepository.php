<?php

namespace App\Repositories;

use App\Invoice;
use App\Repositories\PeriodoRepository;

class FacturaRepository
{
    protected $periodos;

    public function __construct(PeriodoRepository $periodos)
    {
        $this->periodos = $periodos;
    }
    /**
     * buscarFacturaPorId
     */
    public function buscarFacturaPorId($id)
    {
        return Invoice::find($id);
    }

    /**
     * facturasPorCodigo
     */
    public function facturasPorCodigo($codigo)
    {
        return Invoice::whereCodigo($codigo)->first();
    }

    /**
     * facturasPorPeriodo
     */
    public function facturasPorPeriodo($periodo)
    {
        return Invoice::wherePeriodo($periodo)->get();
    }

    /**
     * facturasPorPeriodoyDocumento
     */
    public function facturasPorPeriodoyDocumento($periodo, $factura)
    {
        return Invoice::wherePeriodoAndFactura($periodo, $factura)->first();
    }

    /**
     * totalFacturasSinImportar
     */
    public function totalFacturasSinImportar($periodo)
    {
        return Invoice::wherePeriodoAndImportada($periodo, false)->count();
    }

    /**
     * facturasImportadasPorPeriodo
     */
    public function facturasImportadasPorPeriodo($periodo)
    {
        return Invoice::wherePeriodoAndImportada($periodo, true)->pluck('codigo', 'id');
    }

    /**
     * crearFactura
     */
    public function crearFactura($request)
    {
        $periodo = $this->periodos->buscarPeriodoActivo();
        $codigo  = $periodo->aniodesde . $periodo->aniohasta;

        $data               = new Invoice();
        $data->periodo      = $periodo->periodo;
        $data->codigo       = $codigo;
        $data->fecha        = $request->fecha;
        $data->emisor       = strtoupper($request->emisor);
        $data->destinatario = strtoupper($request->destinatario);
        $data->concepto     = $request->concepto;
        $data->importe      = $request->importe;
        $data->save();

        $factura = $this->buscarFacturaPorId($data->id);

        $factura->codigo = $codigo . '-' . $factura->id;
        $factura->save();

        return $factura;
    }

    /**
     * updateFactura
     */
    public function updateFactura($id, $request)
    {
        $factura = $this->buscarFacturaPorId($id);

        if ($request->fecha) {
            $factura->fecha = $request->fecha;
        }
        if ($request->emisor) {
            $factura->emisor = $request->emisor;
        }
        if ($request->destinatario) {
            $factura->destinatario = $request->destinatario;
        }
        if ($request->concepto) {
            $factura->concepto = $request->concepto;
        }
        if ($request->importe >= 0) {
            $factura->importe = $request->importe;
        }

        $factura->save();

        return $factura;
    }

    /**
     * actualizaDocumento
     */
    public function actualizaDocumento($filename, $id)
    {
        $factura            = $this->buscarFacturaPorId($id);
        $factura->factura   = $filename;
        $factura->importada = true;
        $factura->save();
    }

    /**
     * borrarFactura
     */
    public function borrarFactura($id)
    {
        return Invoice::where('id', '=', $id)->forceDelete();
    }

    /**
     * crearFacturaReciboSocio
     */
    public function crearFacturaReciboSocio($datosRecibo)
    {
        if (!$this->facturasPorPeriodoyDocumento($datosRecibo['periodo'], $datosRecibo['factura'])) {
            $codigo = substr($datosRecibo['periodo'], 0, 4) . substr($datosRecibo['periodo'], 5, 4);

            $data               = new Invoice();
            $data->periodo      = $datosRecibo['periodo'];
            $data->codigo       = $codigo;
            $data->fecha        = $datosRecibo['fecha'];
            $data->emisor       = strtoupper($datosRecibo['emisor']);
            $data->destinatario = strtoupper($datosRecibo['destinatario']);
            $data->concepto     = $datosRecibo['concepto'];
            $data->factura      = $datosRecibo['factura'];
            $data->importe      = $datosRecibo['importe'];
            $data->importada    = $datosRecibo['importada'];
            $data->save();

            $factura = $this->buscarFacturaPorId($data->id);

            $factura->codigo = $codigo . '-' . $factura->id;
            $factura->save();

            return $factura;
        }
    }
}
