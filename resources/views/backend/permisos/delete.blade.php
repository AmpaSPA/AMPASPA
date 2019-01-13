@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.usersaccount'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.usersaccount')],
        ['href' => route('permisos.list'), 'icono' => 'fa fa-key', 'texto' => trans('message.permissions')],
        ['href' => '', 'icono' => 'fa fa-trash', 'texto' => trans('acciones_crud.delete')],
        ],
    ])
@endcomponent

@section('content')
    <h3><strong>{{ trans('message.attention') }}:</strong></h3>
    @if ($permiso->roles->count() > 0)
        <h6>{{ trans('message.permissionsbodytitleuno') }} {{ $permiso->id }},<span class="textoazul"> <strong>{{ $permiso->name }}</strong></span>, {{ trans('message.permissionsbodytitledos') }}:</h6>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('cabecera_permisos.id') }}</th>
                        <th>{{ trans('cabecera_roles.role') }}</th>
                        <th>{{ trans('cabecera_permisos.actions') }}</th>
                    </tr>
                </thead>
                @foreach ($permiso->roles as $role)
                    <tbody>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <i class="text-success fa fa-unlink"></i><a href="{{ route('permisos.detach', [$role->id, $permiso->id]) }}"><span class="text-success texto-accion">{{  trans('form_alumnos.detach') }}</span></a>
                        </td>
                    </tbody>
                @endforeach
                <tfoot>
                    <tr>
                        <th>{{ trans('cabecera_permisos.id') }}</th>
                        <th>{{ trans('cabecera_roles.role') }}</th>
                        <th>{{ trans('cabecera_permisos.actions') }}</th>
                    </tr>
                </tfoot>
            </table>
            <table class="table-responsive">
                <tr><td><span class="textoazul">{{ trans('message.totalroleswithpermissiontextuno') }} <strong>{{ $permiso->name }}</strong>:</span> {{ $permiso->roles->count() }}</td></tr>
                <tr><td><p></p></td></tr>
                <tr><td class="text-danger"><strong>{{ trans('message.deletepermissiontext') }}</strong></td></tr>
            </table>
        </div>
    @else
        <p>{{ trans('message.thepermission') }}:</p>
        <p><span class="textoazul"><strong>{{ $permiso->name }}</strong></span>, {{ trans('message.permissionnotassignedtext') }} <a href="{{ route('permisos.destroy', $permiso->id) }}"><i class="fa fa-trash"></i></a></p>
    @endif
@endsection
