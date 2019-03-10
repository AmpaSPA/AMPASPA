@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-list-alt',
    'trans_msg_title'=> trans('message.proceedingsbook'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-list-alt', 'texto' => trans('message.proceedingsbook')],
        ],
    ])
@endcomponent

@section('content')
    @component('backend.components.datatable', [
        'table_id' => 'actas',
        'table_name' => 'actas',
        'route_name' => 'actas.actasdata',
        'route_param' => '',
        'columndefs' => [
            ['width' => '3%', 'targets' => 0],
            ['width' => '44%', 'targets' => 4],
            ],
        'columns'=> [
            ['data' => 'fecha_acta', 'name' => 'fecha_acta', 'header' => trans('cabecera_actas.date')],
            ['data' => 'autoria', 'name' => 'autoria', 'header' => trans('cabecera_actas.authorship')],
            ['data' => 'reunion', 'name' => 'reunion', 'header' => trans('form_reunion.cabmeeting')],
            ['data' => 'tipo', 'name' => 'tipo', 'header' => trans('form_reunion.cabtype')],
            ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_socios.actions')],
            ],
        'filter' => 'Filtrados'
        ])
    @endcomponent
@endsection