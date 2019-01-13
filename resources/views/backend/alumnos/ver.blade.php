@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.membersbook'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
        ['href' => route('alumnos.socio', $alumno->user_id), 'icono' => 'fa fa-graduation-cap', 'texto' => trans('acciones_crud.students')],
        ['href' => '', 'icono' => 'fa fa-eye', 'texto' => trans('acciones_crud.view')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('form_alumnos.studentdata') }} {{ $alumno->id }}</h3>
        <h6>({{ $alumno->nombre }})</h6>
    </div>
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_alumno')
    {!! Form::close() !!}
@endsection
