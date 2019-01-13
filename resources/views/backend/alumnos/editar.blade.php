@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.membersbook'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
        ['href' => route('alumnos.socio', $alumno->user_id), 'icono' => 'fa fa-graduation-cap', 'texto' => trans('acciones_crud.students')],
        ['href' => '', 'icono' => 'fa fa-pencil', 'texto' => trans('acciones_crud.edit')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('form_alumnos.studentdata') }} {{ $alumno->id }}</h3>
        <h6>({{ $alumno->nombre }})</h6>
    </div>
    {!! Form::model($alumno, ['class' => 'form-horizontal', 'url' => ['backend/alumnos', $alumno->id], 'role' => 'form', 'method' => 'PATCH', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_alumno')
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="pull-right">
                    <button id="bteditar" type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i>{{ trans('form_alumnos.updatestudent') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
