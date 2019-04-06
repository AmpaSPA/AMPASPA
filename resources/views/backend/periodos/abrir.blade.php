@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-calendar',
    'trans_msg_title'=> trans('message.courses'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-calendar-times-o', 'texto' => trans('message.close')]
        ],
    ])
@endcomponent

@section('content')
    <p>{{ trans('message.newcoursetitle') }}</p>
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => route('periodos.nuevo'), 'novalidate' => 'novalidate']) !!}
    @include('backend.includes.campos_form_periodo')
    <div class="form-group">
        <div class="col-md-11">
            <div class="pull-right">
                <button id="btnuevo" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-calendar-plus-o"></i>{{ trans('message.opencourse') }}</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
