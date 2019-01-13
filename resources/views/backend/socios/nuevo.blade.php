@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.membersbook'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('socios.list'), 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
        ['href' => '', 'icono' => 'fa fa-user-plus', 'texto' => trans('message.addmember')],
        ],
    ])
@endcomponent

@section('content')
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => url('backend/socios/nuevosocio'), 'novalidate' => 'novalidate']) !!}
        @include('backend.includes.campos_form_socio')
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="pull-right">
                    <button id="btnuevo" type="submit" class="btn btn-primary"><i class="fa fa-user-plus"></i>{{ trans('message.addnewmember') }}</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
