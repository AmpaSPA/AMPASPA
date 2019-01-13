@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title'=> trans('message.membersbook'),
    'items' => [ 
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
        ], 
    ]) 
@endcomponent 

@section('content')
    <div class="btn-group" role="group">
        <a type="button" role="button" class="btn btn-info btn-sm" href="{{ url('backend/socios/create') }}"><i class="fa fa-user-plus"></i>{{ trans('message.addmember') }}</a>    
        @if (count($sociosbaja) > 0)
            <a type="button" role="button" class="btn btn-danger btn-sm" href="{{ url('backend/socios/bajas') }}"><i class="fa fa-times-rectangle"></i>{{ trans('message.unsubscribesmaintenance') }}</a>    
        @endif
        <a type="button" role="button" class="btn btn-primary btn-sm" href="{{ url('backend/socios/importcsv') }}"><i class="fa fa-file-excel-o "></i>{{ trans('message.massaddmembers') }}</a>
    </div>

    @component('backend.components.datatable', [
        'table_id' => 'socios', 
        'table_name' => 'socios', 
        'route_name' => 'socios.sociosdata',
        'route_param' => '', 
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

@endsection