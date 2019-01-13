@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.usersaccount'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.usersaccount')],
        ],
    ])
@endcomponent

@section('content')
    <div class="btn-group" role="group">
        <a href="{{ route('roles.list') }}" class="btn btn-info btn-sm"><i class="fa fa-male"></i>{{ trans('message.roles') }}</a>
        <a href="{{ route('permisos.list') }}" class="btn btn-primary btn-sm"><i class="fa  fa-key"></i>{{ trans('message.permissions') }}</a>
    </div>
    @component('backend.components.datatable', [
        'table_id' => 'accounts',
        'table_name' => 'cuentas de usuario',
        'route_name' => 'accounts.accountsdata',
        'route_param' => '',
        'columndefs' => [
                ['width' => '3%', 'targets' => 0],
                ['width' => '35%', 'targets' => 4],
            ],
        'columns' => [
                ['data' => 'id', 'name' => 'id', 'header' => trans('cabecera_socios.id')],
                ['data' => 'email', 'name' => 'email', 'header' => trans('cabecera_socios.email')],
                ['data' => 'fecha_alta', 'name' => 'fecha_alta', 'header' => trans('cabecera_socios.createdat')],
                ['data' => 'rol', 'name' => 'rol', 'header' => trans('cabecera_socios.roles')],
                ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_socios.actions')],
            ],
        'filter' => 'Filtradas'
        ])
    @endcomponent
@endsection
