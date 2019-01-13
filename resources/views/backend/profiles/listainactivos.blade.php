@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-search',
    'trans_msg_title' => trans('message.verifydocuments'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-search', 'texto' => trans('message.verifydocuments')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.pendingverifydocuments') }}</h3>

    @component('backend.components.datatable', [
        'table_id' => 'perfilesinactivos',
        'table_name' => 'documentos',
        'route_name' => 'profile.inactivosdata',
        'route_param' => '',
        'columndefs' => [
                ['width' => '3%', 'targets' => 0],
                ['width' => '20%', 'targets' => 3],
            ],
        'columns' => [
                ['data' => 'id', 'name' => 'id', 'header' => trans('acciones_crud.id')],
                ['data' => 'avatar', 'name' => 'avatar', 'header' => trans('acciones_crud.avatar')],
                ['data' => 'nombre', 'name' => 'nombre', 'header' => trans('cabecera_socios.fullname')],
                ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_socios.action')],
            ],
        'filter' => 'Filtrados'
        ])
    @endcomponent
@endsection
