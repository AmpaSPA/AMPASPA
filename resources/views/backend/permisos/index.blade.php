@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.usersaccount'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('accounts.index'), 'icono' => 'fa fa-users', 'texto' => trans('message.usersaccount')],
        ['href' => '', 'icono' => 'fa fa-key', 'texto' => trans('message.permissions')],
        ],
    ])
@endcomponent

@section('content')
    <div class="btn-group" role="group">
        <a type="button" role="button" class="btn btn-primary btn-sm" href="{{ url('backend/permisos/create') }}"><i class="fa fa-handshake-o"></i>{{ trans('message.addpermission') }}</a>
    </div>

    @component('backend.components.datatable', [
        'table_id' => 'permisos',
        'table_name' => 'permisos',
        'route_name' => 'permisos.permisosdata',
        'route_param' => '',
        'columndefs' => [
                ['width' => '3%', 'targets' => 0],
                ['width' => '20%', 'targets' => 2],
            ],
        'columns' => [
                ['data' => 'id', 'name' => 'id', 'header' => trans('cabecera_permisos.id')],
                ['data' => 'name', 'name' => 'name', 'header' => trans('cabecera_permisos.permission')],
                ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_permisos.actions')],
            ],
        'filter' => 'Filtrados'
        ])
    @endcomponent
@endsection
