@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-id-card',
    'trans_msg_title' => trans('message.profile'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-id-card', 'texto' => trans('message.profile')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-primary">
        <h3>{{ trans('message.memberdata') }} {{ $profile->user_id }}</h3>
        <h6>({{ $profile->user->nombre }} {{ $profile->user->apellidos }})</h6>
    </div>
    <div class="row text-right">
        <div class="col-md-9 col-md-offset-3">
            <div class="dropdown show">
                <a class="btn btn-link btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuIdioma" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-language"></i>{{ trans('message.chooselanguage') }}</a>
                <div id="idioma" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuIdioma">
                    <a class="dropdown-item textopequeño" href="{{ url('backend/profile/lang', 'es') }}"><img src="/assets/images/flags/es.png"> {{ trans('message.castilian') }}</a>
                    <a class="dropdown-item textopequeño" href="{{ url('backend/profile/lang', 'en') }}"><img src="/assets/images/flags/gb.png"> {{ trans('message.english') }}</a>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->corrientepago)
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <img src="/assets/images/uploads/{{ $profile->id }}/avatars/{{ $profile->avatar }}" class="avatar">
                @if (Auth::user()->roles()->pluck( 'name' )->implode( ', ' ) <> '')
                    <h4>{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }} <span class="textopequeño text-info">({{ Auth::user()->roles()->pluck( 'name' )->implode(', ') }})</span></h4>
                @else
                    <h4>{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }} <span class="textopequeño text-info">({{ trans('message.withoutprofile') }})</span></h4>
                @endif
                @if (Auth::user()->permissions->count() > 0)
                    <p>{{ trans('message.userpermissions') }}:<span class="text-info"> {{ Auth::user()->permissions()->pluck('name')->implode( ', ' ) }}</span></p>
                @endif
                {{ Form::open(['method' => 'POST', 'url' => url('backend/profile/avatar'), 'enctype' => 'multipart/form-data']) }}
                    @include('backend.includes.campos_form_avatar')
                    <div class="btn-group" role="group">
                        <button id="btchangeavatar" type="submit" class="pull-left btn btn-sm btn-primary"><i class="fa fa-file-image-o" aria-hidden="true"></i>{{ trans('message.changeavatar') }}</button>
                        <a id="btchangeinfo" type="button" class="pull-left btn btn-sm btn-info" href="{{ route('profile.info', Auth::user()->id) }}"><i class="fa fa-address-card"></i>{{ trans('message.aboutyou') }}</a>
                        <a id="bthijos" type="button" class="pull-left btn btn-sm btn-success" href="{{ route('profile.tushijos', Auth::user()->id) }}"><i class="fa fa-graduation-cap"></i>{{ trans('message.yourchildren') }}</a>
                        <a id="btchangepass" type="button" class="pull-left btn btn-sm btn-warning" href="{{ url('backend/socios/showchangepassword') }}"><i class="fa fa-lock"></i>{{ trans('message.changeyourpassword') }}</a>
                        <a id="btchangedata" type="button" class="pull-left btn btn-sm btn-danger" href="{{ route('socios.verdata', Auth::user()->id) }}"><i class="fa fa-address-card"></i>{{ trans('message.changeyourdata') }}</a>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
        @if (Auth::user()->firmacorrecta)
            <div class="row text-center">
                <div class="col-md-10 col-md-offset-1">
                    <h4>{{ trans('message.documentsof') }} {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h4>

                    @if (Auth::user()->paymenttype->tipopago != 'Domiciliación a mi cuenta')
                        <a id="btverultimorecibo" type="button" class="btn btn-sm btn-primary" target="_blank" href="{{ route('socios.recibo', $profile->user_id) }}"><i class="fa fa-list-alt"></i>{{ trans('message.lastreceipt') }}</a>
                    @endif

                    <a id="btverfirmaprofile" type="button" class="btn btn-sm btn-primary" target="_blank" href="{{ route('socios.firma', $profile->user_id) }}"><i class="fa fa-check"></i>{{ trans('message.signature') }}</a>
                </div>
            </div>
        @else
            @if (!Auth::user()->firmaimportada)
                <div class="row text-center">
                    <div class="col-md-10 col-md-offset-1">
                        <h4>{{ trans('message.documentsof') }} {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h4>

                        @if (Auth::user()->paymenttype->tipopago != 'Domiciliación a mi cuenta')
                            <a id="btverultimorecibo" type="button" class="btn btn-sm btn-primary" target="_blank" href="{{ route('socios.recibo', $profile->user_id) }}"><i class="fa fa-list-alt"></i>{{ trans('message.lastreceipt') }}</a>
                        @endif

                        <h4>{{ trans('message.pendingimportsignature', ['socio' => Auth::user()->nombre]) }}:</h4>
                        <a type="button" class="btn btn-link" href="{{ route('socios.gestionardocprofile', Auth::user()->id) }}"><i class="text-danger fa fa-file-pdf-o"></i>{{ trans('message.importyoursignature') }}</a>
                    </div>
                </div>
            @else
                <div class="row text-center">
                    <div class="col-md-10 col-md-offset-1">
                        <h4>{{ Auth::user()->nombre }}, {{ trans('message.verifyingsignature') }}</h4>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-10 col-md-offset-1">
                        <h4>{{ trans('message.documentsof') }} {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h4>

                        @if (Auth::user()->paymenttype->tipopago != 'Domiciliación a mi cuenta')
                            <a id="btverultimorecibo" type="button" class="btn btn-sm btn-primary" target="_blank" href="{{ route('socios.recibo', $profile->user_id) }}"><i class="fa fa-list-alt"></i>{{ trans('message.lastreceipt') }}</a>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    @else
        @if (Auth::user()->reciboimportado)
            <div class="row text-center">
                <div class="col-md-10 col-md-offset-1">
                    <h4>{{ Auth::user()->nombre }}, {{ trans('message.verifyingreceipt') }}</h4>
                </div>
            </div>
            @if (Auth::user()->firmacorrecta)
                <div class="row text-center">
                    <div class="col-md-10 col-md-offset-1">
                        <h4>{{ trans('message.documentsof') }} {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h4>
                        <a id="btverfirmaprofile" type="button" class="btn btn-sm btn-primary" target="_blank" href="{{ route('socios.firma', $profile->user_id) }}"><i class="fa fa-check"></i>{{ trans('message.signature') }}</a>
                    </div>
                </div>
            @else
                @if (!Auth::user()->firmaimportada)
                    <div class="row text-center">
                        <div class="col-md-10 col-md-offset-1">
                            <h4>{{ trans('message.pendingimportsignature', ['socio' => Auth::user()->nombre]) }}:</h4>
                            <a type="button" class="btn btn-link" href="{{ route('socios.gestionardocprofile', Auth::user()->id) }}"><i class="text-danger fa fa-file-pdf-o"></i>{{ trans('message.importyoursignature') }}</a>
                        </div>
                    </div>
                @else
                    <div class="row text-center">
                        <div class="col-md-10 col-md-offset-1">
                            <h4>{{ Auth::user()->nombre }}, {{ trans('message.verifyingsignature') }}</h4>
                        </div>
                    </div>
                @endif
            @endif
        @else
            @if (!Auth::user()->reciboimportado)
                @if ($profile->user->paymenttype->tipopago !== 'Domiciliación a mi cuenta')
                    <div class="row text-center">
                        <div class="col-md-10 col-md-offset-1">
                            <h4>{{ trans('message.nocurrentpaymenttext', ['socio' => Auth::user()->nombre]) }}:</h4>
                            <a type="button" class="btn btn-link" href="{{ route('socios.gestionarrecprofile', Auth::user()->id) }}"><i class="text-danger fa fa-file-pdf-o"></i>{{ trans('message.importyourreceipt') }}</a>
                        </div>
                    </div>
                @endif
            @else
                <div class="row text-center">
                    <div class="col-md-10 col-md-offset-1">
                        <h4>{{ Auth::user()->nombre }}, {{ trans('message.verifyingreceipt') }}</h4>
                    </div>
                </div>
            @endif
            @if (!Auth::user()->firmaimportada)
                <div class="row text-center">
                    <div class="col-md-10 col-md-offset-1">
                        <h4>{{ trans('message.nocurrentsignaturetext', ['socio' => Auth::user()->nombre]) }}:</h4>
                        <a type="button" class="btn btn-link" href="{{ route('socios.gestionardocprofile', Auth::user()->id) }}"><i class="text-danger fa fa-file-pdf-o"></i>{{ trans('message.importyoursignature') }}</a>
                    </div>
                </div>
            @else
                @if(!Auth::user()->firmacorrecta)
                    <div class="row text-center">
                        <div class="col-md-10 col-md-offset-1">
                            <h4>{{ Auth::user()->nombre }}, {{ trans('message.verifyingsignature') }}</h4>
                        </div>
                    </div>
                @else
                    <div class="row text-center">
                        <div class="col-md-10 col-md-offset-1">
                            <h4>{{ trans('message.documentsof') }} {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h4>
                            <a id="btverfirmaprofile" type="button" class="btn btn-sm btn-primary" target="_blank" href="{{ route('socios.firma', $profile->user_id) }}"><i class="fa fa-check"></i>{{ trans('message.signature') }}</a>
                        </div>
                    </div>
                @endif
            @endif
        @endif
    @endif
@endsection
