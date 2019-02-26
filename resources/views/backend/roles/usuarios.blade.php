@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.usersaccount'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.usersaccount')],
        ['href' => route('roles.list'), 'icono' => 'fa fa-male', 'texto' => trans('message.roles')],
        ['href' => '', 'icono' => 'fa fa-trash', 'texto' => trans('acciones_crud.delete')],
        ],
    ])
@endcomponent

@section('content')
    @if ($usuarios->count() > 0)
        <h3><strong>{{ trans('message.attention') }}:</strong></h3>
        <h6>{{ trans('message.rolassignedfollowingusers', ['role' => $role->name]) }}:</h6>
        <hr class="hrazul">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('cabecera_socios.id') }}</th>
                        <th>{{ trans('cabecera_socios.email') }}</th>
                        <th>{{ trans('cabecera_socios.createdat') }}</th>
                        <th>{{ trans('cabecera_socios.action') }}</th>
                    </tr>
                </thead>
                @foreach ($usuarios as $usuario)
                    <tbody>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->created_at->format( 'd/m/Y' ) }}</td>
                        <td>
                            <i class="text-danger fa fa-unlink"></i><a href="{{ url('backend/roles/'.$usuario->id.'/detach', $role->name) }}"><span class="text-danger texto-accion">{{  trans('form_alumnos.detach') }}</span></a>
                        </td>
                    </tbody>
                @endforeach
                <tfoot>
                    <tr>
                        <th>{{ trans('cabecera_socios.id') }}</th>
                        <th>{{ trans('cabecera_socios.email') }}</th>
                        <th>{{ trans('cabecera_socios.createdat') }}</th>
                        <th>{{ trans('cabecera_socios.action') }}</th>
                    </tr>
                </tfoot>
            </table>
            <table class="table-responsive">
                <tr><td><span class="textoazul">{{ trans('message.totaluserwithrole', ['role' => $role->name, 'numero' => $usuarios->count()]) }}</td></tr>
                <tr><td><p></p></td></tr>
                <tr><td class="text-danger"><strong>{{ trans('message.deleteroletext') }}</strong></td></tr>
            </table>
        </div>
    @else
        <h3><strong>{{ trans('message.attention') }}:</strong></h3>
        <p>{{ trans('message.confirmdeleteroletextuno') }} <span class="textoazul"><strong>{{ $role->name }}</strong></span>, {{ trans('message.confirmdeleteroletextdos') }} <a href="{{ url('backend/roles/destroy', $role->id) }}"><i class="fa fa-trash"></i></a></p>
    @endif
@endsection
