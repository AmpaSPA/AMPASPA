@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.usersaccount'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.usersaccount')],
        ['href' => route('permisos.list'), 'icono' => 'fa fa-key', 'texto' => trans('message.permissions')],
        ['href' => '', 'icono' => 'fa fa-handshake-o', 'texto' => trans('message.addpermission')],
        ],
    ])
@endcomponent

@section('content')
    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => url('backend/permisos/nuevopermiso'), 'novalidate' => 'novalidate']) !!}
        <div class="form-group">
            {!! Form::label('name', trans('socios.lbfname'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key textoazul"></i></span>
                    {!! Form::text('name', '', ['class' => 'form-control', 'name' => 'name', 'autofocus' => 'autofocus']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="pull-right">
                    <button id="btnuevo" type="submit" class="btn btn-primary"><i class="fa fa-handshake-o"></i>{{ trans('message.addnewpermission') }}</button>
                </div>
            </div>
        </div>
    {{ Form::close() }}
@endsection
