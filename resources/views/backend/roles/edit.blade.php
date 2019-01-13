@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.usersaccount'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.usersaccount')],
        ['href' => route('roles.list'), 'icono' => 'fa fa-male', 'texto' => trans('message.roles')],
        ['href' => '', 'icono' => 'fa fa-pencil', 'texto' => trans('acciones_crud.edit')],
        ],
    ])
@endcomponent

@section('content')
    {!! Form::model($rol, ['class' => 'form-horizontal', 'url' => url('backend/roles/update', $rol->id), 'role' => 'form', 'method' => 'PATCH', 'novalidate' => 'novalidate']) !!}
        <div class="form-group">
            {!! Form::label('name', trans('socios.lbfname'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-id-card textoazul"></i></span>
                    {!! Form::text('name', null, ['class' => 'form-control', 'name' => 'name', 'autofocus' => 'autofocus']) !!}
                </div>
            </div>
        </div>

        <div class='form-group'>
            <div class="col-md-6 col-md-offset-4 ">
                <h4 class="textoazul">{{ trans('message.assignpermissionstorole') }}</h4>
                @foreach ($permisos_marcados as $fila)
                    @if($fila['marca'] === '1')
                        {{ Form::checkbox('permisos[]',  $fila['id'], true) }}
                        {{ Form::label($fila['name'], $fila['name']) }}<br>
                    @else
                        {{ Form::checkbox('permisos[]',  $fila['id']) }}
                        {{ Form::label($fila['name'], $fila['name']) }}<br>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="pull-right">
                    <button id="bteditar" type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i>{{ trans('message.updaterole') }}</button>
                </div>
            </div>
        </div>
    {{ Form::close() }}
@endsection
