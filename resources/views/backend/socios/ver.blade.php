@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
      'icono_title' => 'fa fa-users',
      'trans_msg_title' => trans('message.membersbook'),
      'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('socios.list'), 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
        ['href' => '', 'icono' => 'fa fa-eye', 'texto' => trans('acciones_crud.view')],
    ],
      ])
@endcomponent

@section('content')
  <div class="bg-primary">
    <h3>{{ trans('message.memberdata') }} {{ $socio->id }}</h3>
    <h6>({{ $socio->nombre }} {{ $socio->apellidos }})</h6>
  </div>
  {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET', 'novalidate' => 'novalidate']) !!}
    @include('backend.includes.campos_form_socio')
    <div class="form-group">
      <div class="col-md-6 col-md-offset-4">
        <div class="pull-right">
          <a id="btverprofile" type="button" class="btn btn-primary" href="{{ url('backend/socios/ver/profile', $socio->id) }}"><i class="fa fa-user" aria-hidden="true"></i>{{ trans('message.profile') }}</a>
          @if($socio->firmacorrecta)
            <a id="btverfirma" target="_blank" type="button" class="btn btn-success" href="{{ route('socios.firma', $socio->id) }}"><i class="fa fa-check" aria-hidden="true"></i>{{ trans('message.signature') }}</a>
          @endif
          @if($socio->corrientepago)
            <a id="btverrecibo" target="_blank" type="button" class="btn btn-warning" href="{{ route('socios.recibo', $socio->id) }}"><i class="fa  fa-list-alt " aria-hidden="true"></i>{{ trans('message.receipt') }}</a>
          @endif
        </div>
      </div>
    </div>
  {!! Form::close() !!}
@endsection
