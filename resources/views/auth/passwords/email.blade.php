@extends('auth.passwords.layout')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-question',
    'trans_msg_title' => trans('message.forgotpassword'),
    'items' => [
        ['href' => route('login'), 'icono' => 'fa fa-sign-in', 'texto' => trans('message.myampa')],
        ['href' => '', 'icono' => 'fa fa-question', 'texto' => trans('message.forgotpassword')],
        ],
    ])
@endcomponent

@section('content')
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => url('password/email')]) !!}
        <div class="form-group">
            {!! Form::label('email', trans('socios.lbmail'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    {!! Form::email('email', null, ['class' => 'form-control', 'name' => 'email', 'value' => old('email'), 'autofocus' => 'autofocus', 'placeholder' => trans('message.enteremail')]) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="pull-right">
                    <button id="btsendlink" type="submit" class="btn btn-primary"><i class="fa fa-envelope"></i>{{ trans('message.sendpassword') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
