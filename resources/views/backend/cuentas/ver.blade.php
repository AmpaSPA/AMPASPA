@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-euro',
    'trans_msg_title'=> trans('message.accountsbook'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('cuentas.list'), 'icono' => 'fa fa-euro', 'texto' => trans('message.accountsbook')],
        ['href' => '', 'icono' => 'fa fa-eye', 'texto' => trans('acciones_crud.view')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.entrydata') }} {{ $item->id }}</h3>
        <h6>({{ $item->concepto }})</h6>
    </div>
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_entrada')
    {!! Form::close() !!}
@endsection
