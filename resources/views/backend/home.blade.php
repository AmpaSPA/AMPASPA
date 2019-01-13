@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-home',
    'trans_msg_title' => trans('message.controlpanel'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
    ],
    ])
@endcomponent

@section('content')
    <h4>{{ trans('message.wellcome') }} <a href={{ URL::route('profile.home', Auth::user()->id) }}>{{ Auth::user()->nombre }}   {{ Auth::user()->apellidos }}</a>
    </h4>
    <div class="container">

        <!-- PANEL NOTIFICACIONES -->
        <div class="col-md-2">
            <div id="panel_notificaciones" class="panel panel-default">
                <div class="panel-heading"><img id="imgpanelcorreo" class="img-responsive center-block" src="assets/images/imgpanelcorreo.png" alt="NOTIFICACIONES">
                </div>
                <div class="panel-footer text-center">{{ trans('message.notificationspanel') }}
                </div>
            </div>
        </div>

        <!-- PENEL RECIBOS -->
        <div class="col-md-2">
            <div id="panel_recibos" class="panel panel-default">
                <div class="panel-heading"><img id="imgpanelrecibos" class="img-responsive center-block" src="assets/images/imgpanelrecibos.png" alt="RECIBOS">
                </div>
                <div class="panel-footer text-center">{{ trans('message.receiptspanel') }}
                </div>
            </div>
        </div>

        <!-- PANEL AVISOS -->
        <div class="col-md-2">
            <div id="panel_avisos" class="panel panel-default">
                @if($avisos > 0)
                    <div class="panel-heading"><a href="{{ route('home.avisos') }}"><img id="imgpanelavisos" class="img-responsive center-block" src="assets/images/imgpanelavisos.png" alt="AVISOS"></a>
                    </div>
                    <div class="panel-footer text-center"><a href="{{ route('home.avisos') }}">{{ trans('message.warningspanel') }}</a><span class="texto-badge badge">{{ $avisos }}</span>
                    </div>
                @else
                    <div class="panel-heading"><img id="imgpanelavisos" class="img-responsive center-block" src="assets/images/imgpanelavisos.png" alt="AVISOS">
                    </div>
                    <div class="panel-footer text-center">{{ trans('message.warningspanel') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- PANEL AUTORIZACIONES -->
        <div class="col-md-2">
            <div id="panel_autorizaciones" class="panel panel-default">
                @if($autorizaciones > 0)
                    <div class="panel-heading"><a href="{{ route('home.autorizaciones') }}"><img id="imgpanelautorizaciones" class="img-responsive center-block" src="assets/images/imgpanelautorizaciones.png" alt="AUTORIZACIONES"></a>
                    </div>
                    <div class="panel-footer text-center"><a href="{{ route('home.autorizaciones') }}">{{ trans('message.authrizationspanel') }}</a><span class="texto-badge badge">{{ $autorizaciones }}</span>
                    </div>
                @else
                    <div class="panel-heading"><img id="imgpanelautorizaciones" class="img-responsive center-block" src="assets/images/imgpanelautorizaciones.png" alt="AUTORIZACIONES">
                    </div>
                    <div class="panel-footer text-center">{{ trans('message.authrizationspanel') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
