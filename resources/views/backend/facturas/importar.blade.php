@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-file-text',
    'trans_msg_title'=> trans('message.invoices'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('facturas.gestion'), 'icono' => 'fa fa-file-text', 'texto' => trans('message.invoices')],
        ['href' => '', 'icono' => 'fa fa-download', 'texto' => trans('message.importinvoice')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.invoicedata') }} {{ $factura->codigo }}</h3>
        <h6>({{ $factura->concepto }})</h6>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/assets/images/img_factura.png" class="avatar">
            {{ Form::open(['method' => 'POST', 'url' => route('facturas.documento'), 'enctype' => 'multipart/form-data']) }}
                @include('backend.includes.campos_form_factura_importar')
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-download" aria-hidden="true"></i>{{ trans('message.importinvoice') }}</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
