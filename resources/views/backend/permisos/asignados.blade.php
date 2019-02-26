@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-key',
    'trans_msg_title' => trans('message.userspermissions'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('permisos.accounts'), 'icono' => 'fa fa-users', 'texto' => trans('message.userspermissions')],
        ['href' => '', 'icono' => 'fa fa-unlink', 'texto' => trans('acciones_crud.revoquepermission')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ $account->email }} <span class="textopequeño">@if(count($account->roles) > 0)({{ ($account->roles()->pluck( 'name' )->implode( ', ' )) }})@endif</span></h3>
    <h6>{{ trans('message.permissionsassignedto') }} {{ $account->nombre }} {{ $account->apellidos }}</h6>
    <hr class="hrazul">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ trans('cabecera_permisos.id') }}</th>
                    <th>{{ trans('cabecera_permisos.permission') }}</th>
                    <th>{{ trans('cabecera_permisos.actions') }}</th>
                </tr>
            </thead>
            @foreach ($permisos as $permiso)
                <tbody>
                    <td>{{ $permiso->id }}</td>
                    <td>{{ $permiso->name }}</td>
                    <td>
                        <i class="text-success fa fa-check"></i><a href="{{ url('backend/permisos/usuario/'.$account->id.'/revoque', $permiso->id) }}"><span class="text-success texto-accion">{{  trans('acciones_crud.select') }}</span></a>
                    </td>
                </tbody>
            @endforeach
            <tfoot>
                <tr>
                    <th>{{ trans('cabecera_permisos.id') }}</th>
                    <th>{{ trans('cabecera_permisos.permission') }}</th>
                    <th>{{ trans('cabecera_permisos.actions') }}</th>
                </tr>
            </tfoot>
        </table>
        <p>{{ trans('message.totalpermissions') }}: {{ count($permisos) }}</p>
    </div>
@endsection
