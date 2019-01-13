@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-id-card',
    'trans_msg_title' => trans('message.profile'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('profile.home', $socio->id), 'icono' => 'fa fa-id-card', 'texto' => trans('message.profile')],
        ['href' => '', 'icono' => 'fa fa-address-card', 'texto' => trans('message.changeyourdata')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.memberdata') }} {{ Auth::user()->id }}</h3>
        <h6>({{ Auth::user()->nombre }} {{ Auth::user()->apellidos }})</h6>
    </div>
    {!! Form::model($socio, ['class' => 'form-horizontal', 'url' => ['backend/socios/changedata', $socio->id], 'role' => 'form', 'method' => 'PATCH', 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_verdata_socio')
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="pull-right">
                    <button id="bteditar" type="submit" class="btn btn-primary"><i class="fa fa-address-card"></i>{{ trans('message.changeyourdata') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
