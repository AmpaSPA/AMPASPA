@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-universal-access',
    'trans_msg_title' => trans('message.activities'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('actividades.gestion'), 'icono' => 'fa fa-universal-access', 'texto' => trans('message.activities')],
        ['href' => '', 'icono' => 'fa fa-puzzle-piece', 'texto' => trans('message.addactivity')],
        ],
    ])
@endcomponent

@section('content')
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => url('backend/actividades/nuevaactividad'), 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_actividad')
        <div class="form-group">
            <div class="col-md-11">
                <div class="pull-right">
                    <button id="btnuevo" type="submit" class="btn btn-primary"><i class="fa fa-puzzle-piece"></i>{{ trans('message.addactivity') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

    @component('backend.components.bootstrap-datepicker', [
        'field_id' => 'fechaactividad'
    ])
    @endcomponent

    @component('backend.components.ckeditor', [
        'field_id' => 'descripcion'
    ])
    @endcomponent
@endsection
