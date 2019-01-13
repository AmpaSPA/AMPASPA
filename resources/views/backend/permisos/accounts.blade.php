@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-key',
    'trans_msg_title' => trans('message.userspermissions'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-key', 'texto' => trans('message.userspermissions')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.usersaccount') }}</h3>

    @component('backend.components.datatable', [
        'table_id' => 'accounts_permissions',
        'table_name' => 'cuentas de usuario',
        'route_name' => 'permisos.usersdata',
        'route_param' => '',
        'columndefs' => [
                ['width' => '3%', 'targets' => 0],
                ['width' => '35%', 'targets' => 3],
            ],
        'columns' => [
                ['data' => 'id', 'name' => 'id', 'header' => trans('cabecera_socios.id')],
                ['data' => 'email', 'name' => 'email', 'header' => trans('cabecera_socios.email')],
                ['data' => 'permiso', 'name' => 'permiso', 'header' => trans('cabecera_socios.permisos')],
                ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_socios.actions')],
            ],
        'filter' => 'Filtradas'
        ])
    @endcomponent
@endsection
