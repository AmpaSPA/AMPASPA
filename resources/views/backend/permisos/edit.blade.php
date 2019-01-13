@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.usersaccount'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.usersaccount')],
        ['href' => route('permisos.list'), 'icono' => 'fa fa-key', 'texto' => trans('message.permissions')],
        ['href' => '', 'icono' => 'fa fa-pencil', 'texto' => trans('acciones_crud.edit')],
        ],
    ])
@endcomponent

@section('content')
    {!! Form::model($permiso, ['class' => 'form-horizontal', 'url' => url('backend/permisos/update', $permiso->id), 'role' => 'form', 'method' => 'PATCH', 'novalidate' => 'novalidate']) !!}
        <div class="form-group">
            {!! Form::label('name', trans('socios.lbfname'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key textoazul"></i></span>
                    {!! Form::text('name', null, ['class' => 'form-control', 'name' => 'name', 'autofocus' => 'autofocus']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="pull-right">
                    <button id="bteditar" type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i>{{ trans('message.updatepermission') }}</button>
                </div>
            </div>
        </div>
    {{ Form::close() }}
@endsection
