<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\RecibosRepository;
use Yajra\DataTables\DataTables;

class RecibosController extends Controller
{
    protected $recibos;

    /**
     * __construct
     */
    public function __construct(RecibosRepository $recibos)
    {
        $this->recibos = $recibos;
    }

    /**
     * recibosData
     */
    public function recibosData($id)
    {
        $recibos = $this->recibos->buscarRecibosAntiguosPorUsuario($id);

        return DataTables::of($recibos)
            ->addColumn(
                'domiciliacion',
                function ($recibo) {
                    if ($recibo->domiciliacion) {
                        return trans('message.yes');
                    } else {
                        return trans('message.not');
                    }
                }
            )
            ->addColumn(
                'estado',
                function ($recibo) {
                    if ($recibo->estado) {
                        return 'Pagado';
                    } else {
                        return 'Pendiente';
                    }
                }
            )
            ->addColumn(
                'importe',
                function ($recibo) {
                    return $recibo->importe . '€';
                }
            )
            ->addColumn(
                'action',
                function ($recibo) {
                    if (!$recibo->domiciliacion) {
                        return '<i class="text-success fa fa-eye"></i>'
                        . '<a target="_blank" href="'
                        . route('recibos.ver', $recibo->id)
                        . '">'
                        . '<span class="text-success texto-accion">'
                        . trans('acciones_crud.view')
                            . '</span>'
                            . '</a>';
                    } else {
                        return 'n/a';
                    }
                }
            )
            ->make(true);
    }

    /**
     * ver
     */
    public function ver($recibo_id)
    {
        $recibo = $this->recibos->buscarReciboPorId($recibo_id);
        $pdf    = $recibo->ruta . $recibo->fichero;

        header('Content-type: application/pdf');
        readfile($pdf);
    }
}
