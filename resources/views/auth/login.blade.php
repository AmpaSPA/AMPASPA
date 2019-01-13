@extends('backend.layouts.backend')

@section('content')
    <div class="col-md-4 col-md-offset-4">
        <div class="login-page">
            <div class="login-box">
                <div class="login-logo">
                    <a href="{{ url('/') }}"><img class="img-responsive" alt="AMPA SPAB" src="assets/images/logoampa.png"></a>
                </div>
                <div class="login-welcome">
                    <p> Bienvenid@ al área privada del AMPA del colegio</p>
                </div>
                <div class="login-box-body">
                    @include('includes.errores')
                    <p class="login-box-msg"> {{ trans('message.siginsession') }} </p>
                    {{ Form::open(['method' => 'POST', 'url' => '/login', 'novalidate' => 'novalidate']) }}
                    <div class="input-group">
                        {{ Form::email('email', null, ['class' => 'form-control', 'name' => 'email', 'value' => old('email'), 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('message.email')]) }}
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    </div>
                    <div class="input-group">
                        {{ Form::password('password', ['class' => 'form-control', 'name' => 'password', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('message.password')]) }}
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            {{ Form::submit(trans('message.buttonsign'), ['class' => 'btn btn-primary pull-right', 'id' => 'accede', 'name' => 'login']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                    <a href="{{ url('/password/reset') }}">{{ trans('message.forgotpassword') }}</a><br>
                </div>
            </div>
        </div>
    </div>
@endsection
