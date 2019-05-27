@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-universal-access',
    'trans_msg_title' => trans('message.activities'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('actividades.gestion'), 'icono' => 'fa fa-universal-access', 'texto' => trans('message.activities')],
        ['href' => '', 'icono' => 'fa fa-pencil', 'texto' => trans('acciones_crud.edit')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.activitydata') }} {{ $actividad->id }}</h3>
        <h6>({{ $actividad->nombre }})</h6>
    </div>
    {!! Form::model($actividad, ['class' => 'form-horizontal', 'url' => ['backend/actividades', $actividad->id], 'role' => 'form', 'method' => 'PATCH', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_actividad')
        <div class="form-group">
            <div class="col-md-11">
                <div class="pull-right">
                    <button id="bteditar" type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i>{{ trans('message.updateactivity') }}</button>
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
