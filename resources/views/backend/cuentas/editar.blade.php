@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-euro',
    'trans_msg_title'=> trans('message.accountsbook'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('cuentas.list'), 'icono' => 'fa fa-euro', 'texto' => trans('message.accountsbook')],
        ['href' => '', 'icono' => 'fa fa-pencil', 'texto' => trans('acciones_crud.edit')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.entrydata') }} {{ $entrada->id }}</h3>
        <h6>{{ trans('form_entrada.lbinvoice') }} {{ $entrada->invoice->codigo }} - {{ trans('form_entrada.lbamount') }} {{ $entrada->importe }}€</h6>
    </div>
    {!! Form::model($entrada, ['class' => 'form-horizontal', 'url' => route('cuentas.update', $entrada->id), 'role' => 'form', 'method' => 'PATCH', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_entrada')
        <div class="form-group">
            <div class="col-md-11">
                <div class="pull-right">
                    <button id="bteditar" type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i>{{ trans('message.updateentry') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
