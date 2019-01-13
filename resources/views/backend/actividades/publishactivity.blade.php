@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-universal-access',
    'trans_msg_title' => trans('message.activities'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('actividades.gestion'), 'icono' => 'fa fa-universal-access', 'texto' => trans('message.activities')],
        ['href' => '', 'icono' => 'fa fa-newspaper-o', 'texto' => trans('message.publishactivity')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.unpublishedactivities') }}</h3>

	@component('backend.components.datatable', [
	    'table_id' => 'actividades',
	    'table_name' => 'actividades',
		'route_name' => 'actividades.nopublicadasdata',
		'route_param' => '',
	    'columndefs' => [
	            ['width' => '3%', 'targets' => 0],
	            ['width' => '10%', 'targets' => 3],
	        ],
	    'columns' => [
	            ['data' => 'id', 'name' => 'id', 'header' => trans('form_actividad.cabid')],
	            ['data' => 'nombre', 'name' => 'nombre', 'header' => trans('form_actividad.cabname')],
	            ['data' => 'descripcion', 'name' => 'descripcion', 'header' => trans('form_actividad.cabdescription')],
	            ['data' => 'action', 'name' => 'action', 'header' => trans('form_actividad.cabactions')],
	        ],
	    'filter' => 'Filtradas'
	    ])
	@endcomponent
@endsection
