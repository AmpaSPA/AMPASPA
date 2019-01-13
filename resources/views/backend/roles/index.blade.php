@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.usersaccount'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('accounts.index'), 'icono' => 'fa fa-users', 'texto' => trans('message.usersaccount')],
        ['href' => '', 'icono' => 'fa fa-male', 'texto' => trans('message.roles')],
        ],
    ])
@endcomponent

@section('content')
    <div class="btn-group" role="group">
        <a type="button" role="button" class="btn btn-primary btn-sm" href="{{ route('roles.create') }}"><i class="fa fa-id-card"></i>{{ trans('message.addrole') }}</a>
    </div>

    @component('backend.components.datatable', [
        'table_id' => 'roles',
        'table_name' => 'roles',
        'route_name' => 'roles.rolesdata',
        'route_param' => '',
        'columndefs' => [
                ['width' => '3%', 'targets' => 0],
                ['width' => '20%', 'targets' => 3],
            ],
        'columns' => [
                ['data' => 'id', 'name' => 'id', 'header' => trans('cabecera_roles.id')],
                ['data' => 'name', 'name' => 'name', 'header' => trans('cabecera_roles.role')],
                ['data' => 'permiso', 'name' => 'permiso', 'header' => trans('cabecera_roles.permission')],
                ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_roles.actions')],
            ],
        'filter' => 'Filtrados'
        ])
    @endcomponent
@endsection
