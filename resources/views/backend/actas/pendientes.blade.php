@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-comments',
    'trans_msg_title' => trans('message.meetings'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('reuniones.gestion'), 'icono' => 'fa fa-comments', 'texto' => trans('message.meetings')],
        ['href' => '', 'icono' => 'fa fa-list-alt', 'texto' => trans('acciones_crud.pendingproceedings')]
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.pendingimportproceedings') }}</h3>
    @component('backend.components.datatable', [
        'table_id' => 'actas',
        'table_name' => 'actas',
        'route_name' => 'actas.pendientesdata',
        'route_param' => '',
        'columndefs' => [
            ['width' => '3%', 'targets' => 0],
            ['width' => '44%', 'targets' => 5],
            ],
        'columns'=> [
            ['data' => 'fecha_acta', 'name' => 'fecha_acta', 'header' => trans('cabecera_actas.date')],
            ['data' => 'autoria', 'name' => 'autoria', 'header' => trans('cabecera_actas.authorship')],
            ['data' => 'reunion', 'name' => 'reunion', 'header' => trans('form_reunion.cabmeeting')],
            ['data' => 'tipo', 'name' => 'tipo', 'header' => trans('form_reunion.cabtype')],
            ['data' => 'estado', 'name' => 'estado', 'header' => trans('cabecera_actas.cabstatus')],
            ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_socios.actions')]
            ],
        'filter' => 'Filtrados'
        ])
    @endcomponent
@endsection
