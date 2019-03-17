@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-calendar',
    'trans_msg_title'=> trans('message.courses'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('periodos.gestion'), 'icono' => 'fa fa-calendar', 'texto' => trans('message.courses')],
        ['href' => '', 'icono' => 'fa fa-eye', 'texto' => trans('acciones_crud.view')]
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.perioddata') }} {{ $curso->id }}</h3>
        <h6>({{ $curso->periodo }})</h6>
    </div>
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_periodo')
    {!! Form::close() !!}
@endsection
