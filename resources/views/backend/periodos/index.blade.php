@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-calendar',
    'trans_msg_title'=> trans('message.courses'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-calendar', 'texto' => trans('message.courses')]
        ],
    ])
@endcomponent

@section('content')

    @component('backend.components.datatable', [
        'table_id' => 'cursos',
        'table_name' => 'cursos',
        'route_name' => 'periodos.periodosdata',
        'route_param' => '',
        'columndefs' => [
                ['width' => '3%', 'targets' => 0],
                ['width' => '50%', 'targets' => 4],
            ],
        'columns' => [
                ['data' => 'id', 'name' => 'id', 'header' => trans('form_periodo.cabid')],
                ['data' => 'periodo', 'name' => 'periodo', 'header' => trans('form_periodo.cabcourse')],
                ['data' => 'cuotaeuros', 'name' => 'cuotaeuros', 'header' => trans('form_periodo.cabsubscription')],
                ['data' => 'estado', 'name' => 'estado', 'header' => trans('form_periodo.cabstatus')],
                ['data' => 'action', 'name' => 'action', 'header' => trans('form_periodo.cabactions')],
            ],
        'filter' => 'Filtrados'
        ])
    @endcomponent
@endsection