@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-universal-access',
    'trans_msg_title' => trans('message.activities'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-universal-access', 'texto' => trans('message.activities')],
        ],
    ])
@endcomponent

@section('content')
    <div class="btn-group" role="group">
        <a type="button" role="button" class="btn btn-info btn-sm" href="{{ url('backend/actividades/create') }}"><i class="fa fa-puzzle-piece"></i>{{ trans('message.addactivity') }}</a>
        @if ($hay_actividades_a_publicar)
            <a type="button" role="button" class="btn btn-success btn-sm" href="{{ route('actividades.publishactivity') }}"><i class="fa fa-newspaper-o"></i>{{ trans('message.publishactivity') }}</a>
        @endif
        @if ($hay_actividades_a_cancelar)
            <a type="button" role="button" class="btn btn-danger btn-sm" href="{{ route('actividades.cancelactivity') }}"><i class="fa fa-history"></i>{{ trans('message.cancelactivity') }}</a>
        @endif
    </div>

    @component('backend.components.datatable', [
        'table_id' => 'actividades',
        'table_name' => 'actividades',
        'route_name' => 'actividades.actividadesdata',
        'route_param' => '',
        'columndefs' => [
            ['width' => '3%', 'targets' => 0],
            ['width' => '30%', 'targets' => 3],
        ],
        'columns' => [
            ['data' => 'id', 'name' => 'id', 'header' => trans('form_actividad.cabid')],
            ['data' => 'fechaactividad', 'name' => 'fechaactividad', 'header' => trans('form_actividad.cabdate')],
            ['data' => 'nombre', 'name' => 'nombre', 'header' => trans('form_actividad.cabname')],
            ['data' => 'subvencion', 'name' => 'subvencion', 'header' => trans('form_actividad.cabgrant')],
            ['data' => 'action', 'name' => 'action', 'header' => trans('form_actividad.cabactions')],
        ],
        'filter' => 'Filtradas'
    ])
    @endcomponent
@endsection
