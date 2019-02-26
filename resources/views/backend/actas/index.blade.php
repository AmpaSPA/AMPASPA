@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-list-alt',
    'trans_msg_title'=> trans('message.proceedings'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-list-alt', 'texto' => trans('message.proceedings')],
        ],
    ])
@endcomponent

@section('content')
    <div class="btn-group" role="group">
        <a type="button" role="button" class="btn btn-info btn-sm" href="{{ url('backend/socios/create') }}"><i class="fa fa-plus"></i>{{ trans('message.addproceeding') }}</a>
    </div>

    @component('backend.components.datatable', [
        'table_id' => 'actas',
        'table_name' => 'actas',
        'route_name' => 'actas.actasdata',
        'route_param' => '',
        'columndefs' => [
            ['width' => '3%', 'targets' => 0],
            ['width' => '44%', 'targets' => 3],
            ],
        'columns'=> [
            ['data' => 'id', 'name' => 'id', 'header' => trans('cabecera_socios.id')],
            ['data' => 'nombre', 'name' => 'nombre', 'header' => trans('cabecera_actas.date')],
            ['data' => 'numdoc', 'name' => 'numdoc', 'header' => trans('cabecera_actas.authorship')],
            ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_actas.proceedingtype')],
            ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_socios.actions')],
            ],
        'filter' => 'Filtrados'
        ])
    @endcomponent

@endsection