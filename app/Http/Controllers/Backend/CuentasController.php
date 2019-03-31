<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Repositories\EntradaRepository;
use App\Repositories\FacturaRepository;
use App\Repositories\PeriodoRepository;
use App\Http\Requests\CreateEntryRequest;

class CuentasController extends Controller
{
    protected $periodo;
    protected $entrada;
    protected $factura;

    /**
     * __construct: Constructor de la clase. Usa los modelos: Periods y Entry
     */
    public function __construct(PeriodoRepository $periodo, EntradaRepository $entrada, FacturaRepository $factura)
    {
        $this->periodo = $periodo;
        $this->entrada = $entrada;
        $this->factura = $factura;
    }

    /**
     * cuentasData
     */
    public function cuentasData()
    {
        $curso = $this->periodo->buscarPeriodoActivo()->periodo;
        $entries = $this->entrada->entradasPeriodo($curso)->sortByDesc('created_at');

        return DataTables::of($entries)
        ->addColumn(
            'created_at',
            function ($entry) {
                return Carbon::parse($entry->created_at)->format('d-m-Y');
            }
        )
        ->addColumn(
            'importe',
            function ($entry) {
                return $entry->invoice->importe;
            }
        )
        ->addColumn(
            'link',
            function ($entry) {
                return route('facturas.ver', $entry->invoice_id);
            }
        )
        ->addColumn(
            'codigo',
            function ($entry) {
                return $entry->invoice->codigo;
            }
        )
        ->addColumn(
            'saldo',
            function ($entry) use ($entries) {
                $saldo = 0;
                foreach ($entries as $item) {
                    if ($item->created_at <= $entry->created_at) {
                        switch ($item->tipo) {
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
                $btnEliminar = '<i class="text-danger fa fa-trash"></i>'
                . '<a href="'
                . route('cuentas.borrar', $entry->id)
                . '">'
                . '<span class="text-danger texto-accion">'
                . trans('acciones_crud.delete')
                . '</span>'
                . '</a>';

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
        $facturas = $this->factura->facturasImportadasPorPeriodo($this->periodo->buscarPeriodoActivo()->periodo);

        return view('backend.cuentas.nueva', compact('modo', 'facturas'));
    }

    /**
     * nuevoItem: Se guarda en la BBDD la entrada en cuenta informada en el formulario de alta
     */
    public function nuevoItem(CreateEntryRequest $request)
    {
        $data = $this->entrada->crearEntrada($request);
        $periodo = $this->periodo->buscarPeriodoActivo();

        $this->periodo->actualizarSaldoPeriodo($periodo->periodo);

        flash(trans('acciones_crud.addedentry', ['entrada' => $data->concepto]))->success();
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
        $modo = 'update';
        $facturas = $this->factura->facturasImportadasPorPeriodo($this->periodo->buscarPeriodoActivo()->periodo);
        $item = $this->entrada->buscarEntradaPorId($id);

        return view('backend.cuentas.editar', compact('modo', 'item', 'facturas'));
    }

    public function update($id, CreateEntryRequest $request)
    {
        $entrada = $this->entrada->updateEntrada($id, $request);

        flash(trans('acciones_crud.updateentry', ['fecha' => $entrada->fecha]))->success();
        return redirect(route('cuentas.list'));
    }
}
