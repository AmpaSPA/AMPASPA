@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-euro',
    'trans_msg_title' => trans('message.receipts'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-euro', 'texto' => trans('message.receipts')],
        ],
    ])
@endcomponent
@section('content')
    <h3>{{ trans('message.oldreceiptsof') }}</h3>
    <h6>{{ trans('message.member') }}<span class="textoazul"> <strong> {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }} - {{ Auth::user()->numdoc }}</strong></span></h6>

    @component('backend.components.datatable', [
        'table_id' => 'recibos',
        'table_name' => 'recibos',
        'route_name' => 'recibos.recibosdata',
        'route_param' => Auth::user()->id,
        'columndefs' => [
            ['width' => '30%', 'targets' => 4],
        ],
        'columns' => [
            ['data' => 'periodo', 'name' => 'periodo', 'header' => trans('form_recibo.cabperiod')],
            ['data' => 'domiciliacion', 'name' => 'domiciliacion', 'header' => trans('form_recibo.cabdebit')],
            ['data' => 'importe', 'name' => 'importe', 'header' => trans('form_recibo.cabamount')],
            ['data' => 'estado', 'name' => 'estado', 'header' => trans('form_recibo.cabstatus')],
            ['data' => 'action', 'name' => 'action', 'header' => trans('form_recibo.cabactions')],
        ],
        'filter' => 'Filtrados'
        ])
    @endcomponent
@endsection
