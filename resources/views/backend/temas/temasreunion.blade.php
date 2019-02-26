@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-comments',
    'trans_msg_title' => trans('message.meetings'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('reuniones.gestion'), 'icono' => 'fa fa-comments', 'texto' => trans('message.meetings')],
        ['href' => '', 'icono' => 'fa fa-align-justify', 'texto' => trans('acciones_crud.topics')]
        ],
    ])
@endcomponent

@section('content')
    <div>
        <h3>{{ trans('message.meetingtopics', ['fecha' => $fecha, 'tipo' => $tipo]) }}</h3>
        <h6>({{ trans('message.topicstarget') }})</h6>
    </div>

    <hr class="hrazul">

    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_tema')
    {!! Form::close() !!}
@endsection
