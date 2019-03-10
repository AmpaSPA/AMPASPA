@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-list-alt',
    'trans_msg_title'=> trans('message.proceedingsbook'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('actas.list'), 'icono' => 'fa fa-list-alt', 'texto' => trans('message.proceedingsbook')],
        ['href' => '', 'icono' => 'fa fa-handshake-o', 'texto' => trans('acciones_crud.addagreements')],
        ],
    ])
@endcomponent

@section('content')
    <div>
        <div>
            <h3>{{ trans('form_temas.lbtopic') }} <span class="textoazul">{{ $tema->titulo }}</span></h3>
            <ul>
                <li>{{ $tema->tema }}</li>
            </ul>
        </div>
    </div>

    <hr class="hrazul">

    <div>
        <div>
            <h3>{{ trans('form_acuerdos.lbagreement') }}</h3>
        </div>
        {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => route('acuerdos.nuevo', $tema->id), 'novalidate' => 'novalidate']) !!}
            @include('backend.includes.campos_form_acuerdo')
            <div class="form-group">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button id="btnuevo" type="submit" class="btn btn-success btn-sm"><i class="fa fa-thumbs-o-up"></i>{{ trans('form_acuerdos.addagreement') }}</button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection