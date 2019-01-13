@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-id-card',
    'trans_msg_title' => trans('message.profile'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('profile.home', Auth::user()->id), 'icono' => 'fa fa-id-card', 'texto' => trans('message.profile')],
        ['href' => '', 'icono' => 'fa fa-lock', 'texto' => trans('message.changepasswordof')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.memberdata') }} {{ Auth::user()->id }}</h3>
        <h6>({{ Auth::user()->nombre }} {{ Auth::user()->apellidos }})</h6>
    </div>
    {!! Form::model(Auth::user(), ['id' => 'form-change-password', 'role' => 'form', 'method' => 'POST', 'url' => url('backend/socios/changepassword'), 'novalidate' => 'novalidate', 'class' => 'form-horizontal' ]) !!}
        <div class="form-group">
            {!! Form::label('current_password', trans('socios.lbcurrpassword'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    {!! Form::password('', ['class' => 'form-control', 'name' => 'current_password', 'autofocus' => 'autofocus', 'placeholder' => trans('message.entercurrentpassword')]) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('password', trans('socios.lbnewpassword'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    {!! Form::password('', ['class' => 'form-control', 'name' => 'password', 'autofocus' => 'autofocus', 'placeholder' => trans('message.enternewpassword')]) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('password', trans('socios.lbconfpassword'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    {!! Form::password('', ['class' => 'form-control', 'name' => 'password_confirmation', 'autofocus' => 'autofocus', 'placeholder' => trans('message.newpasswordconfirmation')]) !!}
                </div>
            </div>
        </div>    <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="pull-right">
                    <button id="btchangepass" type="submit" class="btn btn-danger"><i class="fa fa-lock"></i>{{ trans('message.changeyourpassword') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
