@extends('frontend.layouts.paginas_auxiliares')

@section('titleheader')
  {{ trans('contacto.dropus') }}
@endsection

@section('breadcrumb')
  <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>{{ trans('message.home') }}</a></li>
@endsection

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">Atencion!!!</h3></div>
    <div class="panel-body">
      <h4>Tu mensaje ha sido enviado, pronto responderemos a tu solicitud.</h4>
    </div>
    <div class="panel-footer">
      <a href="{{ url('/#contact') }}" class="btn btn-primary btn-xs">Volver</a>
    </div>
  </div>
@endsection