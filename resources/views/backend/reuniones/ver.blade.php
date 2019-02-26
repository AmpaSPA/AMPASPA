@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-comments',
    'trans_msg_title' => trans('message.meetings'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('reuniones.gestion'), 'icono' => 'fa fa-comments', 'texto' => trans('message.meetings')],
        ['href' => '', 'icono' => 'fa fa-eye', 'texto' => trans('acciones_crud.view')]
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.meetingdata') }} {{ $reunion->id }}</h3>
        <h6>({{ $reunion->fechareunion }})</h6>
    </div>
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_reunion')
    {!! Form::close() !!}
@endsection
