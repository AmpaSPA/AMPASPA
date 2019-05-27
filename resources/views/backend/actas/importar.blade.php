@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-comments',
    'trans_msg_title' => trans('message.meetings'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-comments', 'texto' => trans('message.meetings')],
        ['href' => route('actas.listarpendientes'), 'icono' => 'fa fa-list-alt', 'texto' => trans('acciones_crud.pendingproceedings')],
        ['href' => '', 'icono' => 'fa fa-upload', 'texto' => trans('acciones_crud.uploadsignedproceeding')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.proceedingdata') }} {{ $acta->fecha_acta }}</h3>
        <h6>({{ trans('message.proceedingauthor') }} {{ $acta->autoria }})</h6>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/assets/images/img_acta.png" class="avatar">
            {{ Form::open(['method' => 'POST', 'url' => route('actas.registrarfirmada'), 'enctype' => 'multipart/form-data']) }}
                @include('backend.includes.campos_form_acta_importar')
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-upload" aria-hidden="true"></i>{{ trans('acciones_crud.uploadsignedproceeding') }}</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
