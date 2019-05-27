@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-file-text',
    'trans_msg_title' => trans('message.invoices'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-file-text', 'texto' => trans('message.invoices')],
        ],
    ])
@endcomponent

@section('content')
    <div class="btn-group" role="group">
        <a type="button" role="button" class="btn btn-info btn-sm" href="{{ route('facturas.create') }}"><i class="fa fa-download"></i>{{ trans('message.addinvoice') }}</a>
    </div>

    @if ($aviso > 0)
        <div class="bg-danger text-danger">
            <h5 class="alert-heading"><strong>{{ trans('message.important') }}</strong></h5>
            <p><strong>(*) </strong>{{ trans_choice('message.noimportinvoices', $aviso, ['numero' => $aviso]) }} {{ trans('message.importinvoicetext') }}</p>
        </div>
        <br>
    @endif

    @component('backend.components.datatable', [
        'table_id' => 'facturas',
        'table_name' => 'facturas',
        'route_name' => 'facturas.facturasdata',
        'route_param' => '',
        'columndefs' => [
            ['width' => '3%', 'targets' => 0],
            ['width' => '50%', 'targets' => 2],
            ['width' => '30%', 'targets' => 4],
        ],
        'columns' => [
            ['data' => 'codigo', 'name' => 'codigo', 'header' => trans('form_factura.cabcode')],
            ['data' => 'importada', 'name' => 'importada', 'header' => trans('form_factura.cabimported')],
            ['data' => 'fecha', 'name' => 'fecha', 'header' => trans('form_factura.cabdate')],
            ['data' => 'emisor', 'name' => 'emisor', 'header' => trans('form_factura.cabfrom')],
            ['data' => 'importe', 'name' => 'importe', 'header' => trans('form_factura.cabamount')],
            ['data' => 'action', 'name' => 'action', 'header' => trans('form_factura.cabactions')],
        ],
        'filter' => 'Filtradas'
    ])
    @endcomponent
@endsection
