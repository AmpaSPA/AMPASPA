@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-list-alt',
    'trans_msg_title'=> trans('message.proceedingsbook'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-list-alt', 'texto' => trans('message.proceedingsbook')],
        ['href' => route('acuerdos.list', $tema->meeting_id), 'icono' => 'fa fa-handshake-o', 'texto' => trans('acciones_crud.agreements')],
        ['href' => '', 'icono' => 'fa fa-pencil', 'texto' => trans('acciones_crud.updateagreement')],
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

        <div>
            <h3>{{ trans('form_acuerdos.lbagreement') }}</h3>
            <ul>
                <li>{{ $acuerdo->acuerdo }}</li>
            </ul>
        </div>
    </div>

    <hr class="hrazul">

    <div>
        {!! Form::model($acuerdo, ['class' => 'form-horizontal', 'url' => route('acuerdos.update', $tema->id), 'role' => 'form', 'method' => 'PATCH', 'novalidate' => 'novalidate']) !!}
            @include('backend.includes.campos_form_acuerdo')
            <div class="form-group">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button id="btnuevo" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-thumbs-o-up"></i>{{ trans('form_acuerdos.updateagreement') }}</button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

    @component('backend.components.ckeditor', [
        'field_id' => 'acuerdo'
    ])
    @endcomponent
@endsection