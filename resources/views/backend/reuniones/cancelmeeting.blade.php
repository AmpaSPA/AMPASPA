@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-comments',
    'trans_msg_title' => trans('message.meetings'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('reuniones.gestion'), 'icono' => 'fa fa-comments', 'texto' => trans('message.meetings')],
        ['href' => '', 'icono' => 'fa fa-history', 'texto' => trans('message.cancelmeeting')]
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.arrangedmeetings') }}</h3>

	@component('backend.components.datatable', [
	    'table_id' => 'reuniones',
	    'table_name' => 'reuniones',
		'route_name' => 'reuniones.convocadasdata',
		'route_param' => '',
        'columndefs' => [
                ['width' => '3%', 'targets' => 0],
                ['width' => '30%', 'targets' => 3],
            ],
        'columns' => [
                ['data' => 'id', 'name' => 'id', 'header' => trans('form_reunion.cabid')],
                ['data' => 'fechareunion', 'name' => 'fechareunion', 'header' => trans('form_reunion.cabdate')],
                ['data' => 'horareunion', 'name' => 'horareunion', 'header' => trans('form_reunion.cabtime')],
                ['data' => 'tipo', 'name' => 'tipo', 'header' => trans('form_reunion.cabtype')],
                ['data' => 'action', 'name' => 'action', 'header' => trans('form_reunion.cabactions')],
            ],
        'filter' => 'Filtradas'
        ])
    @endcomponent
@endsection
