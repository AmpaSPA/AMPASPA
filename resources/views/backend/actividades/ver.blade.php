@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-universal-access',
    'trans_msg_title' => trans('message.activities'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('actividades.gestion'), 'icono' => 'fa fa-universal-access', 'texto' => trans('message.activities')],
        ['href' => '', 'icono' => 'fa fa-eye', 'texto' => trans('acciones_crud.view')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.activitydata') }} {{ $actividad->id }}</h3>
        <h6>({{ $actividad->nombre }})</h6>
    </div>
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_actividad')
    {!! Form::close() !!}
@endsection
