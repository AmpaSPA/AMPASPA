@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-list-alt',
    'trans_msg_title'=> trans('message.proceedingsbook'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('actas.list'), 'icono' => 'fa fa-list-alt', 'texto' => trans('message.proceedingsbook')],
        ['href' => '', 'icono' => 'fa fa-handshake-o', 'texto' => trans('acciones_crud.agreements')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.meetingtopics', ['fecha' => $fecha, 'tipo' => $tipo]) }}</h3>

    @component('backend.components.datatable', [
        'table_id' => 'temas',
        'table_name' => 'temas',
        'route_name' => 'acuerdos.acuerdosdata',
        'route_param' => $id_reunion,
        'columndefs' => [
            ['width' => '25%', 'targets' => 1]
            ],
        'columns'=> [
            ['data' => 'titulo', 'name' => 'titulo', 'header' => trans('form_temas.cabtopic')],
            ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_socios.actions')]
            ],
        'filter' => 'Filtrados'
        ])
    @endcomponent
@endsection