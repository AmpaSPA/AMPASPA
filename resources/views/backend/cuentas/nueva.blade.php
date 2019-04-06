@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-euro',
    'trans_msg_title'=> trans('message.accountsbook'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('cuentas.list'), 'icono' => 'fa fa-euro', 'texto' => trans('message.accountsbook')],
        ['href' => '', 'icono' => 'fa fa-money', 'texto' => trans('message.additem')],
        ],
    ])
@endcomponent

@section('content')
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => route('cuentas.nuevoitem'), 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_entrada')
        <div class="form-group">
            <div class="col-md-11">
                <div class="pull-right">
                    <button id="btnuevo" type="submit" class="btn btn-primary"><i class="fa fa-money"></i>{{ trans('message.additem') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
