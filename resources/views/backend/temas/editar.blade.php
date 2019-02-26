@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-comments',
    'trans_msg_title' => trans('message.meetings'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-comments', 'texto' => trans('message.meetings')],
        ['href' => route('temas.reunion', $tema->meeting_id), 'icono' => 'fa fa-align-justify', 'texto' => trans('acciones_crud.topics')],
        ['href' => '', 'icono' => 'fa fa-pencil', 'texto' => trans('acciones_crud.edit')]
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('form_temas.topicdata') }} {{ $tema->id }}</h3>
        <h6>({{ $tema->titulo }})</h6>
    </div>
    {!! Form::model($tema, ['class' => 'form-horizontal', 'url' => ['backend/temas', $tema->id], 'role' => 'form', 'method' => 'PATCH', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_tema')
        <div class="form-group">
            <div class="col-md-11">
                <div class="pull-right">
                    <button id="bteditar" type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i>{{ trans('form_temas.updatetopic') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
