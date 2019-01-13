@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.membersbook'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('socios.list'), 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
        ['href' => '', 'icono' => 'fa fa-pencil', 'texto' => trans('acciones_crud.edit')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.memberdata') }} {{ $socio->id }}</h3>
        <h6>({{ $socio->nombre }} {{ $socio->apellidos }})</h6>
    </div>
    {!! Form::model($socio, ['class' => 'form-horizontal', 'url' => ['backend/socios', $socio->id], 'role' => 'form', 'method' => 'PATCH', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_socio')
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="pull-right">
                    <button id="bteditar" type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i>{{ trans('message.updatemember') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
