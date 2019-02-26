@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-envelope',
    'trans_msg_title' => trans('message.notifications'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-envelope', 'texto' => trans('message.notifications')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.unreadnotificationsof') }} {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h3>

    @component('backend.components.datatable', [
	    'table_id' => 'notificaciones',
	    'table_name' => 'tipos de notificación',
		'route_name' => 'home.tiponotificacionesdata',
		'route_param' => '',
        'columndefs' => [
                ['width' => '95%', 'targets' => 0],
                ['width' => '5%', 'targets' => 2],
            ],
        'columns' => [
                ['data' => 'icono', 'name' => 'icono', 'header' => trans('notificaciones.cabtype')],
                ['data' => 'total_tipo', 'name' => 'total_tipo', 'header' => trans('notificaciones.cabtotaltype')],
                ['data' => 'action', 'name' => 'action', 'header' => trans('notificaciones.cabactions')],
            ],
        'filter' => 'Filtradas'
        ])
    @endcomponent
@endsection
