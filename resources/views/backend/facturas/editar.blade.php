@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-file-text',
    'trans_msg_title'=> trans('message.invoices'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('facturas.gestion'), 'icono' => 'fa fa-file-text', 'texto' => trans('message.invoices')],
        ['href' => '', 'icono' => 'fa fa-pencil', 'texto' => trans('acciones_crud.edit')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.invoicedata') }} {{ $factura->emisor }}</h3>
        <h6>({{ $factura->concepto }})</h6>
    </div>
    {!! Form::model($factura, ['class' => 'form-horizontal', 'url' => route('facturas.update', $factura->id), 'role' => 'form', 'method' => 'PATCH', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_factura')
        <div class="form-group">
            <div class="col-md-11">
                <div class="pull-right">
                    <button id="bteditar" type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i>{{ trans('message.updateinvoice') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

    @component('backend.components.bootstrap-datepicker', [
      'field_id' => 'fecha'
    ])
    @endcomponent
@endsection
