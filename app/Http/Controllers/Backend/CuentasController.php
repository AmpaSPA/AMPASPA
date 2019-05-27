<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEntryRequest;
use App\Repositories\EntradaRepository;
use App\Repositories\EntrytypeRepository;
use App\Repositories\FacturaRepository;
use App\Repositories\PeriodoRepository;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class CuentasController extends Controller
{
    protected $periodo;
    protected $entrada;
    protected $factura;
    protected $tipoEntrada;

    /**
     * __construct: Constructor de la clase. Usa los modelos: Periods y Entry
     */
    public function __construct(
        PeriodoRepository $periodo,
        EntradaRepository $entrada,
        FacturaRepository $factura,
        EntrytypeRepository $tipoEntrada
    ) {
        $this->periodo     = $periodo;
        $this->entrada     = $entrada;
        $this->factura     = $factura;
        $this->tipoEntrada = $tipoEntrada;
    }

    /**
     * cuentasData
     */
    public function cuentasData()
    {
        $curso   = $this->periodo->buscarPeriodoActivo()->periodo;
        $entries = $this->entrada->entradasPeriodo($curso)->sortByDesc('created_at');

        return DataTables::of($entries)
            ->addColumn(
                'created_at',
                function ($entry) {
                    return Carbon::parse($entry->created_at)->format('d-m-Y');
                }
            )
            ->addColumn(
                'domiciliacion',
                function ($entry) {
                    if ($entry->domiciliacion) {
                        return 'Si';
                    } else {
                        return 'No';
                    }
                }
            )
            ->addColumn(
                'tipo',
                function ($entry) {
                    return $entry->entrytype->tipoentrada;
                }
            )
            ->addColumn(
                'codigo',
                function ($entry) {
                    return $entry->invoice->codigo;
                }
            )
            ->addColumn(
                'importe',
                function ($entry) {
                    return $entry->invoice->importe . '€';
                }
            )
            ->addColumn(
                'saldo',
                function ($entry) use ($entries) {
                    $saldo = 0;
                    foreach ($entries as $item) {
                        if ($item->created_at <= $entry->created_at) {
                            switch ($item->entrytype->tipoentrada) {
                                case 'Ingreso':
                                    $saldo = $saldo + $item->importe;
                                    break;
                                case 'Gasto':
                                    $saldo = $saldo - $item->importe;
                                    break;
                            }
                        }
                    }
                    return $saldo;
                }
            )
            ->addColumn(
                'action',
                function ($entry) {
                    $btnFactura = null;

                    $btnVer = '<i class="text-success fa fa-eye"></i>'
                    . '<a href = "'
                    . route('cuentas.ver', $entry->id)
                    . '">'
                    . '<span class="text-success texto-accion">'
                    . trans('acciones_crud.view')
                        . '</span>'
                        . '</a>';
                    $btnEditar = '<i class="text-warning fa fa-pencil"></i>'
                    . '<a href="'
                    . route('cuentas.editar', $entry->id)
                    . '">'
                    . '<span class="text-warning texto-accion">'
                    . trans('acciones_crud.edit')
                        . '</span>'
                        . '</a>';
                    if (!$entry->domiciliacion) {
                        $btnFactura = '<i class="text-info fa fa-file-text"></i>'
                        . '<a href="'
                        . route('facturas.ver', $entry->invoice->id)
                        . '">'
                        . '<span class="text-info texto-accion">'
                        . trans('acciones_crud.invoice')
                            . '</span>'
                            . '</a>';
                    }

                    return $btnVer . ' ' . $btnEditar . ' ' . $btnFactura;
                }
            )
            ->make(true);
    }

    /**
     * create
     */
    public function create()
    {
        $modo         = 'new';
        $tiposEntrada = $this->tipoEntrada->tiposEntrada();
        $facturas     = $this->factura->facturasImportadasPorPeriodo($this->periodo->buscarPeriodoActivo()->periodo);

        return view('backend.cuentas.nueva', compact('modo', 'facturas', 'tiposEntrada'));
    }

    /**
     * nuevoItem: Se guarda en la BBDD la entrada en cuenta informada en el formulario de alta
     */
    public function nuevoItem(CreateEntryRequest $request)
    {
        $data     = $this->entrada->crearEntrada($request);
        $importes = $this->entrada->calcularImportesPeriodo($data->periodo);

        $this->periodo->actualizarImportes($data->periodo, $importes);

        flash(trans('acciones_crud.addedentry', ['entrada' => $data->created_at]))->success();
        return redirect(route('cuentas.list'));
    }

    /**
     * ver
     */
    public function ver($id)
    {
        $modo = 'view';
        $item = $this->entrada->buscarEntradaPorId($id);

        return view('backend.cuentas.ver', compact('modo', 'item'));
    }

    /**
     * editar
     */
    public function editar($id)
    {
        $modo         = 'update';
        $tiposEntrada = $this->tipoEntrada->tiposEntrada();
        $facturas     = $this->factura->facturasImportadasPorPeriodo($this->periodo->buscarPeriodoActivo()->periodo);
        $entrada      = $this->entrada->buscarEntradaPorId($id);

        return view('backend.cuentas.editar', compact('modo', 'entrada', 'facturas', 'tiposEntrada'));
    }

    /**
     * update
     */
    public function update($id, CreateEntryRequest $request)
    {
        $entrada  = $this->entrada->updateEntrada($id, $request);
        $importes = $this->entrada->calcularImportesPeriodo($entrada->periodo);

        $this->periodo->actualizarImportes($importes);

        flash(
            trans(
                'acciones_crud.updateentry',
                [
                    'fecha' => Carbon::parse($entrada->created_at)->format('d-m-Y'),
                ]
            )
        )->success();
        return redirect(route('cuentas.list'));
    }
}
