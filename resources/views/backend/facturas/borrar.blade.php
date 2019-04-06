@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-file-text',
    'trans_msg_title'=> trans('message.invoices'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('facturas.gestion'), 'icono' => 'fa fa-file-text', 'texto' => trans('message.invoices')],
        ['href' => '', 'icono' => 'fa fa-trash', 'texto' => trans('acciones_crud.delete')],
        ],
    ])
@endcomponent

@section('content')
    <h3><strong>{{ trans('message.attention') }}:</strong></h3>
    <p>Se ha encontrado una entrada relacionada con la factura <strong class="textoazul">{{ $factura->codigo }}</strong>. Si se confirma el borrado de dicha factura, también será borrada la entrada siguiente:</p>
    <p><strong>{{ trans('form_entrada.lbdescription') }}</strong> {{ $entrada->descripcion }}</p>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ trans('form_entrada.cabid') }}</th>
                    <th>{{ trans('form_entrada.cabdate') }}</th>
                    <th>{{ trans('form_entrada.cabtype') }}</th>
                    <th>{{ trans('form_entrada.cabamount') }}</th>
                    <th>{{ trans('form_entrada.cabactions') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $entrada->id }}</td>
                    <td>{{ $fecha }}</td>
                    <td>{{ $entrada->entrytype->tipoentrada }}</td>
                    <td>{{ $entrada->importe }}€</td>
                    <td><a class="text-danger" href="{{ route('facturas.eliminar', [$entrada->id, $factura->id]) }}"><i class="fa fa-trash"></i>{{ trans('message.delete') }}</a></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
