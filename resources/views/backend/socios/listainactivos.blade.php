@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-upload',
    'trans_msg_title' => trans('message.importdocuments'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-upload', 'texto' => trans('message.importdocuments')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.pendingimportdocuments') }}</h3>
    <p>{{ trans('message.markeddocuments') }}</p>

    @component('backend.components.datatable', [
        'table_id' => 'sociosinactivos',
        'table_name' => 'documentos',
        'route_name' => 'socios.inactivosdata',
        'route_param' => '',
        'columndefs' => [
            ['width' => '3%', 'targets' => 0],
            ['width' => '35%', 'targets' => 4],
            ],
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'header' => trans('cabecera_socios.id')],
            ['data' => 'nombre', 'name' => 'nombre', 'header' => trans('cabecera_socios.fullname')],
            ['data' => 'firma', 'name' => 'firma', 'header' => trans('cabecera_socios.signature')],
            ['data' => 'recibo', 'name' => 'recibo', 'header' => trans('cabecera_socios.payment')],
            ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_socios.action')],
            ],
        'filter' => 'Filtrados'
        ])
    @endcomponent
@endsection
