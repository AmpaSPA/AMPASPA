@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.membersbook'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('socios.list'), 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
        ['href' => '', 'icono' => 'fa fa-times-rectangle', 'texto' => trans('message.unsubscribesmaintenance')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.membersunscribedtext') }}</h3>
    <hr>
    @if (count($bajas) > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('cabecera_socios.id') }}</th>
                        <th>{{ trans('cabecera_socios.fname') }}</th>
                        <th>{{ trans('cabecera_socios.lname') }}</th>
                        <th>{{ trans('cabecera_socios.email') }}</th>
                        <th>{{ trans('acciones_crud.unscribeddate') }}</th>
                        <th>{{ trans('cabecera_socios.actions') }}</th>
                    </tr>
                </thead>
                @foreach ($bajas as $baja)
                    <tbody>
                        <td>{{ $baja->id }}</td>
                        <td>{{ $baja->nombre }}</td>
                        <td>{{ $baja->apellidos }}</td>
                        <td>{{ $baja->email }}</td>
                        <td>{{ $baja->deleted_at }}</td>
                        <td>
                            <i class="text-primary fa fa-rotate-left"></i><a href="{{ url('backend/socios/bajas/restore', $baja->id) }}"><span class="text-primary texto-accion">{{  trans('acciones_crud.restore') }}</span></a>
                            <i class="text-danger fa fa-rotate-right"></i><a href="{{ url('backend/socios/bajas/forcedelete' ,$baja->id) }}"><span class="text-danger texto-accion">{{ trans('acciones_crud.forcedelete') }}</span></a>
                            <i class="text-success fa fa-graduation-cap"></i><a href="{{ url('backend/socios/bajas/verhijos', $baja->nombre.' '.$baja->apellidos) }}"><span class="text-success texto-accion">{{ trans('acciones_crud.children') }}</span></a>
                        </td>
                    </tbody>
                @endforeach
            </table>
            <td>{{ trans('message.totalmembersunscribed') }}: {{ $bajas->count() }}</td>
        </div>
    @endif
@endsection
