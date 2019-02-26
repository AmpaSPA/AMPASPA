@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-comments',
    'trans_msg_title' => trans('message.meetings'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('reuniones.gestion'), 'icono' => 'fa fa-comments', 'texto' => trans('message.meetings')],
        ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('acciones_crud.attendees')]
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.meetingattendees', ['fecha' => $fecha, 'tipo' => $reunion->meetingtype()->pluck('tiporeunion')->implode('')]) }}</h3>

    @component('backend.components.datatable', [
        'table_id' => 'asistentes',
        'table_name' => 'asistentes',
        'route_name' => 'asistentes.asistentesdata',
        'route_param' => $reunion->id,
        'columndefs' => [
            ['width' => '3%', 'targets' => 0],
            ['width' => '44%', 'targets' => 3],
            ],
        'columns'=> [
            ['data' => 'id', 'name' => 'id', 'header' => trans('cabecera_socios.id')],
            ['data' => 'nombre', 'name' => 'nombre', 'header' => trans('cabecera_socios.fullname')],
            ['data' => 'numdoc', 'name' => 'numdoc', 'header' => trans('cabecera_socios.document')],
            ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_socios.actions')],
            ],
        'filter' => 'Filtrados'
        ])
    @endcomponent

    <hr class="hrazul">

    @hasrole('Administrador')
        @include('backend.includes.formulario_nuevo_asistente')
    @else
        @can('Administrar socios')
            @include('backend.includes.formulario_nuevo_asistente')
        @endcan
    @endhasrole
@endsection
