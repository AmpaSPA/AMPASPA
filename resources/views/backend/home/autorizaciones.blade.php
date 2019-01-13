@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-list-alt',
    'trans_msg_title' => trans('message.authorizations'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-list-alt', 'texto' => trans('message.authorizations')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.pendingauthorizationsfor') }} {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ trans('cabecera_socios.id') }}</th>
                    <th>{{ trans('cabecera_socios.student') }}</th>
                    <th>{{ trans('cabecera_socios.pendingauthorizations') }}</th>
                    <th>{{ trans('cabecera_socios.action') }}</th>
                </tr>
            </thead>
            @foreach ($autorizaciones_pendientes as $autorizacion_pendiente)
                <tbody>
                    <td>{{ $autorizacion_pendiente['id'] }}</td>
                    <td>{{ $autorizacion_pendiente['nombre'] }}</td>
                    <td>{{ $autorizacion_pendiente['tot_aut_pend'] }}</td>
                    <td>
                        <i class="text-success fa fa-check"></i><a href="{{ route('home.autorizaralumno', $autorizacion_pendiente['id']) }}"><span class="text-success texto-accion">{{  trans('acciones_crud.select') }}</span></a>
                    </td>
                </tbody>
            @endforeach
            <tfoot>
                <tr>
                    <th>{{ trans('cabecera_socios.id') }}</th>
                    <th>{{ trans('cabecera_socios.student') }}</th>
                    <th>{{ trans('cabecera_socios.pendingauthorizations') }}</th>
                    <th>{{ trans('cabecera_socios.action') }}</th>
                </tr>
            </tfoot>
        </table>
        <p>{{ trans('message.totalpendingauthorizations') }}: {{ $total_aut_pendientes }}</p>
    </div>
@endsection
