@extends('backend.layouts.backend')

@if($accion === 'asignar')
    @component('backend.components.headerpage', [
        'icono_title' => 'fa fa-users',
        'trans_msg_title' => trans('message.usersaccount'),
        'items' => [
            ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
            ['href' => route('accounts.index'), 'icono' => 'fa fa-users', 'texto' => trans('message.usersaccount')],
            ['href' => '', 'icono' => 'fa fa-link', 'texto' => trans('message.assignrole')],
            ],
        ])
    @endcomponent
@else
    @component('backend.components.headerpage', [
        'icono_title' => 'fa fa-users',
        'trans_msg_title' => trans('message.usersaccount'),
        'items' => [
            ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
            ['href' => route('accounts.index'), 'icono' => 'fa fa-users', 'texto' => trans('message.usersaccount')],
            ['href' => '', 'icono' => 'fa fa-unlink', 'texto' => trans('message.unassignrole')],
            ],
        ])
    @endcomponent
@endif

@section('content')
    <h3>{{ $account->email }}</h3>
    @if($accion === 'asignar')
        <p>{{ trans('message.availablesrolefor', ['cuenta' => $account->nombre . ' '. $account->apellidos ]) }}</p>
    @else
        <p>{{ trans('message.rolesthatuserhas', ['cuenta' => $account->nombre . ' '. $account->apellidos ]) }}</p>
    @endif
    <hr>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ trans('cabecera_roles.id') }}</th>
                    <th>{{ trans('cabecera_roles.role') }}</th>
                    <th>{{ trans('cabecera_roles.permission') }}</th>
                    <th>{{ trans('cabecera_roles.actions') }}</th>
                </tr>
            </thead>
            @foreach ($roles_disponibles as $rol)
                <tbody>
                    <td>{{ $rol['id'] }}</td>
                    <td>{{ $rol['name'] }}</td>
                    <td style="width:65%">{{ $rol['permisos'] }}</td>
                    <td>
                        @if($accion === 'asignar')
                            <i class="text-success fa fa-link"></i><a href="{{ url('backend/useraccounts/'.$account->id.'/attach', $rol['name']) }}"><span class="text-success texto-accion">{{  trans('form_alumnos.attach') }}</span></a>
                        @else
                            <i class="text-danger fa fa-unlink"></i><a href="{{ url('backend/useraccounts/'.$account->id.'/detach', $rol['name']) }}"><span class="text-danger texto-accion">{{  trans('form_alumnos.detach') }}</span></a>
                        @endif
                    </td>
                </tbody>
            @endforeach
            <tfoot>
                <tr>
                    <th>{{ trans('cabecera_roles.id') }}</th>
                    <th>{{ trans('cabecera_roles.role') }}</th>
                    <th>{{ trans('cabecera_roles.permission') }}</th>
                    <th>{{ trans('cabecera_roles.actions') }}</th>
                </tr>
            </tfoot>
        </table>
        <p>{{ trans('message.totalroles') }}: {{ count($roles_disponibles) }}</p>
    </div>
@endsection
