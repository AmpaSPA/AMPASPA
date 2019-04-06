<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateInvoiceRequest;
use App\Repositories\FacturaRepository;
use App\Repositories\PeriodoRepository;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UpdateFacturaRequest;
use App\Repositories\EntradaRepository;
use Illuminate\Support\Carbon;

class FacturasController extends Controller
{
    protected $facturas;
    protected $entradas;
    protected $periodos;

    /**
     * constructor de la clase
     */
    public function __construct(FacturaRepository $facturas, PeriodoRepository $periodos, EntradaRepository $entradas)
    {
        $this->facturas = $facturas;
        $this->entradas = $entradas;
        $this->periodos = $periodos;
    }

    /**
     * index
     */
    public function index()
    {
        $periodo = $this->periodos->buscarPeriodoActivo()->periodo;
        $aviso = $this->facturas->totalFacturasSinImportar($periodo);

        return view('backend.facturas.index', compact('aviso'));
    }

    /**
     * facturasData
     */
    public function facturasData()
    {
        $periodo = $this->periodos->buscarPeriodoActivo()->periodo;
        $invoices = $this->facturas->facturasPorPeriodo($periodo);

        return DataTables::of($invoices)
            ->addColumn(
                'importada',
                function ($invoice) {
                    if ($invoice->importada) {
                        return 'Si';
                    } else {
                        return 'No';
                    }
                }
            )
            ->addColumn(
                'action',
                function ($invoice) {
                    $btnVer = null;
                    $btnEditar = null;
                    $btnEliminar = null;

                    if ($invoice->importada) {
                        $btnVer = '<i class="text-success fa fa-eye"></i>'
                        . '<a target="_blank" href="'
                        . route('facturas.ver', $invoice->id)
                        . '">'
                        . '<span class="text-success texto-accion">'
                        . trans('acciones_crud.view')
                        . '</span>'
                        . '</a>';
                        $btnEliminar = '<i class="text-danger fa fa-trash"></i>'
                        . '<a href="'
                        . route('facturas.borrar', $invoice->id)
                        . '">'
                        . '<span class="text-danger texto-accion">'
                        . trans('acciones_crud.delete')
                        . '</span>'
                        . '</a>';
                    } else {
                        $btnEditar = '<i class="text-warning fa fa-pencil"></i>'
                        . '<a href="'
                        . route('facturas.editar', $invoice->id)
                        . '">'
                        . '<span class="text-warning texto-accion">'
                        . trans('acciones_crud.edit')
                        . '</span>'
                        . '</a>';
                    }

                    return $btnVer . ' ' . $btnEditar . ' ' . $btnEliminar;
                }
            )
            ->make(true);
    }

    /**
     * create
     */
    public function create()
    {
        $modo = 'new';
        return view('backend.facturas.nueva', compact('modo'));
    }

    /**
     * nuevaFactura
     */
    public function nuevaFactura(CreateInvoiceRequest $request)
    {
        $data = $this->facturas->crearFactura($request);

        flash(trans('acciones_crud.addedinvoice', ['factura' => $data->emisor]))->success();
        return redirect(route('facturas.gestion'));
    }

    /**
     * importarFactura
     */
    public function importarFactura($codigo)
    {
        $factura = $this->facturas->facturasPorCodigo($codigo);

        return view('backend.facturas.importar', compact('factura'));
    }

    /**
     * registrarDocumento
     */
    public function registrarDocumento(UpdateFacturaRequest $request)
    {
        $periodo = $this->periodos->buscarPeriodoActivo();

        $ruta = public_path('assets/docs/facturas/');
        $filename = $periodo->aniodesde . $periodo->aniohasta . '-' . $request->id_factura . '.pdf';

        if (file_exists($ruta.$filename)) {
            unlink($ruta.$filename);
        }

        $request->file('documento')->move($ruta, $filename);

        $this->facturas->actualizaDocumento($ruta . $filename, $request->id_factura);

        flash(trans('acciones_crud.importedinvoice', ['factura' => $filename]))->success();
        return redirect(route('facturas.gestion'));
    }

    /**
     * ver
     */
    public function ver($factura_id)
    {
        $factura = $this->facturas->buscarFacturaPorId($factura_id);
        $pdf = $factura->factura;

        header('Content-type: application/pdf');
        readfile($pdf);
    }

    /**
     * borrar
     */
    public function borrar($id)
    {
        $factura = $this->facturas->buscarFacturaPorId($id);
        $entrada = $this->entradas->buscarEntradaPorFacturaId($factura->id);
        $fecha = Carbon::parse($entrada->created_at)->format('d-m-Y');

        if ($entrada) {
            return view('backend.facturas.borrar', compact('factura', 'entrada', 'fecha'));
        } else {
            $this->borrarPdf($factura->id);
            $this->facturas->borrarFactura($factura->id);

            flash(trans('acciones_crud.deletedinvoice', ['factura' => $factura->codigo]))->success();
            return redirect(route('facturas.gestion'));
        }
    }

    /**
     * eliminar
     */
    public function eliminar($id_entrada, $id_factura)
    {
        $codigo = $this->facturas->buscarFacturaPorId($id_factura)->codigo;

        $this->borrarPdf($id_factura);

        $this->entradas->borrarEntrada($id_entrada);
        $this->facturas->borrarFactura($id_factura);

        flash(trans('acciones_crud.deletedinvoiceentry', ['factura' => $codigo]))->success();
        return redirect(route('facturas.gestion'));
    }

    /**
     * borrarPdf
     */
    public function borrarPdf($id_factura)
    {
        $periodo = $this->periodos->buscarPeriodoActivo();

        $ruta = public_path('assets/docs/facturas/');
        $filename = $periodo->aniodesde . $periodo->aniohasta . '-' . $id_factura . '.pdf';

        if (file_exists($ruta.$filename)) {
            unlink($ruta.$filename);
        }

        return;
    }

    /**
     * editar
     */
    public function editar($id)
    {
        $factura = $this->facturas->buscarFacturaPorId($id);
        $modo = 'update';

        return view('backend.facturas.editar', compact('factura', 'modo'));
    }

    public function update($id, CreateInvoiceRequest $request)
    {
        $factura = $this->facturas->updateFactura($id, $request);

        flash(trans('acciones_crud.updateinvoice', ['factura' => $factura->emisor]))->success();
        return redirect(route('facturas.gestion'));
    }
}
