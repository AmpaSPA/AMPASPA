@extends('auth.passwords.layout')

@component('backend.components.headerpage', [
    'icono_title' => '',
    'trans_msg_title' => trans('message.resetpassword'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-sign-in', 'texto' => trans('message.myampa')],
        ['href' => route('password.request'), 'icono' => 'fa fa-question', 'texto' => trans('message.forgotpassword')],
        ['href' => '', 'icono' => 'fa fa-share', 'texto' => trans('message.resetpassword')],
        ],
    ])
@endcomponent

@section('content')
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => url('/password/reset')]) !!}
    {!! Form::hidden('token', $token) !!}
    <div class="form-group">
        {!! Form::label('email', trans('socios.lbmail'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                {!! Form::email('email', null, ['class' => 'form-control', 'name' => 'email', 'value' => old('email'), 'utofocus' => 'autofocus', 'placeholder' => trans('message.enteremail')]) !!}
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
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <div class="pull-right">
                <button id="btchangepass" type="submit" class="btn btn-danger"><i class="fa fa-share"></i>{{ trans('message.resetpassword') }}</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
