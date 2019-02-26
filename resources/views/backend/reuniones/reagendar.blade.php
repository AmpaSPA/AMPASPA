@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-comments',
    'trans_msg_title' => trans('message.meetings'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('reuniones.gestion'), 'icono' => 'fa fa-comments', 'texto' => trans('message.meetings')],
        ['href' => '', 'icono' => 'fa fa-calendar', 'texto' => trans('acciones_crud.backtoschedule')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.meetingdata') }} {{ $reunion->id }}</h3>
        <h6>({{ $reunion->fechareunion }})</h6>
    </div>

    {!! Form::model($reunion, ['class' => 'form-horizontal', 'url' => ['backend/reuniones', $reunion->id], 'role' => 'form', 'method' => 'PATCH', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_reunion')
        <div class="form-group">
            <div class="col-md-11">
                <div class="pull-right">
                    <button id="bteditar" type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i>{{ trans('message.updatemeeting') }}</button>
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
