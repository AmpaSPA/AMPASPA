@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
        'icono_title' => 'fa fa-universal-access',
        'trans_msg_title' => trans('message.activities'),
        'items' => [
            ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
            ['href' => route('actividades.gestion'), 'icono' => 'fa fa-universal-access', 'texto' => trans('message.activities')],
            ['href' => '', 'icono' => 'fa fa-address-book', 'texto' => trans('acciones_crud.seeassignments')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.studentsenrolledactivity') }} {{ $actividad->nombre }}</h3>
    <h6><strong>{{ trans('form_actividad.lbtarget') }}</strong> {{ $actividad->activitytarget->colectivo }} </h6>
    <h6><strong class="textoazul">{{ trans('message.currentauthorizations') }}</strong> {{ $total_autorizaciones }}</h6>
    
    @component('backend.components.datatable', [
        'table_id' => 'alumnosactividad',
        'table_name' => 'estudiantes asignados',
        'route_name' => 'actividades.asignacionesdata',
        'route_param' => $actividad->id,
        'columndefs' => [
                ['width' => '3%', 'targets' => 0],
                ['width' => '20%', 'targets' => 5],
            ],
        'columns' => [
                ['data' => 'id', 'name' => 'id', 'header' => trans('acciones_crud.id')],
                ['data' => 'nombre', 'name' => 'nombre', 'header' => trans('cabecera_socios.fullname')],
                ['data' => 'anionacim', 'name' => 'anionacim', 'header' => trans('message.birthyear')],
                ['data' => 'curso', 'name' => 'curso', 'header' => trans('message.course')],
                ['data' => 'autorizacion', 'name' => 'autorizacion', 'header' => trans('message.authorization')],
                ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_socios.action')],
            ],
        'filter' => 'Filtrados'
        ])
    @endcomponent
@endsection
