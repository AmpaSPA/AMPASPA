@extends('frontend.layouts.paginas_auxiliares')

@section('titleheader')
  {{ trans('contacto.dropus') }}
@endsection

@section('breadcrumb')
  <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>{{ trans('message.home') }}</a></li>
@endsection

@section('content')
  @include('includes.errores')
  {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => url('contacto'), 'novalidate' => 'novalidate']) !!}
    @include('frontend.includes.campos_form_contacto')
  <div class="form-group">
    <div class="col-md-6 col-md-offset-4">
      <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i>{{ trans('message.submit') }}</button>
    </div>
  </div>
  {!! Form::close() !!}
@endsection