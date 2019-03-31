@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-file-text',
    'trans_msg_title'=> trans('message.invoices'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('facturas.gestion'), 'icono' => 'fa fa-file-text', 'texto' => trans('message.invoices')],
        ['href' => '', 'icono' => 'fa fa-file-text-o', 'texto' => trans('message.addinvoice')],
        ],
    ])
@endcomponent

@section('content')
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => route('facturas.nuevafactura'), 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_factura')
        <div class="form-group">
            <div class="col-md-11">
                <div class="pull-right">
                    <button id="btnuevo" type="submit" class="btn btn-primary"><i class="fa fa-file-text-o"></i>{{ trans('message.addinvoice') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

    @component('backend.components.bootstrap-datepicker', [
        'field_id' => 'fecha'
    ])
    @endcomponent
@endsection
