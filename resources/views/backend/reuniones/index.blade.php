@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-comments',
    'trans_msg_title' => trans('message.meetings'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-comments', 'texto' => trans('message.meetings')],
        ],
    ])
@endcomponent

@section('content')
    <div class="btn-group" role="group">
        <a type="button" role="button" class="btn btn-info btn-sm" href="{{ route('reuniones.create') }}"><i class="fa fa-plus"></i>{{ trans('message.addmeeting') }}</a>
        @if ($hay_reuniones_a_convocar)
            <a type="button" role="button" class="btn btn-success btn-sm" href="{{ route('reuniones.arrangemeeting') }}"><i class="fa fa-bullhorn"></i>{{ trans('message.arrangemeeting') }}</a>
        @endif
        @if ($hay_reuniones_a_cancelar)
            <a type="button" role="button" class="btn btn-danger btn-sm" href="{{ route('reuniones.cancelmeeting') }}"><i class="fa fa-history"></i>{{ trans('message.cancelmeeting') }}</a>
        @endif
    </div>
    @if ($aviso > 0)
        <div class="bg-danger text-danger">
            <h5 class="alert-heading"><strong>{{ trans('message.important') }}</strong></h5>
            <p><strong>(*) </strong>{{ trans_choice('message.noimportproceedings', $aviso, ['numero' => $aviso]) }} {{ trans('message.importproceedingtextone') }} {{ trans('message.importproceedingtexttwo') }}<a class="text-danger" href="{{ route('actas.listarpendientes') }}"><strong> {{ trans('message.here') }}</strong></a>.</p>
        </div>
        <br>
    @endif

    @component('backend.components.datatable', [
        'table_id' => 'reuniones',
        'table_name' => 'reuniones',
        'route_name' => 'reuniones.reunionesdata',
        'route_param' => '',
        'columndefs' => [
                ['width' => '3%', 'targets' => 0],
                ['width' => '20%', 'targets' => 3],
            ],
        'columns' => [
                ['data' => 'id', 'name' => 'id', 'header' => trans('form_reunion.cabid')],
                ['data' => 'fechareunion', 'name' => 'fechareunion', 'header' => trans('form_reunion.cabdate')],
                ['data' => 'horareunion', 'name' => 'horareunion', 'header' => trans('form_reunion.cabtime')],
                ['data' => 'tipo', 'name' => 'tipo', 'header' => trans('form_reunion.cabtype')],
                ['data' => 'estado', 'name' => 'estado', 'header' => trans('form_reunion.cabstatus')],
                ['data' => 'action', 'name' => 'action', 'header' => trans('form_reunion.cabactions')],
            ],
        'filter' => 'Filtradas'
        ])
    @endcomponent
@endsection
