@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-comments',
    'trans_msg_title' => trans('message.meetings'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('reuniones.gestion'), 'icono' => 'fa fa-comments', 'texto' => trans('message.meetings')],
        ['href' => '', 'icono' => 'fa fa-plus', 'texto' => trans('message.addmeeting')],
        ],
    ])
@endcomponent

@section('content')
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => route('reuniones.nueva'), 'novalidate' => 'novalidate']) !!}
    @include('backend.includes.campos_form_reunion')
    <div class="form-group">
        <div class="col-md-11">
            <div class="pull-right">
                <button id="btnuevo" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>{{ trans('message.addmeeting') }}</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    @component('backend.components.bootstrap-datepicker', [
    'field_id' => 'fechareunion'
    ])
    @endcomponent

    @component('backend.components.timepicker', [
        'time_id' => 'time'
    ])
    @endcomponent
@endsection