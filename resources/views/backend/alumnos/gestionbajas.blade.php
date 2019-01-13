@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.membersbook'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
        ['href' => route('alumnos.socio', $socio->id), 'icono' => 'fa fa-graduation-cap', 'texto' => trans('acciones_crud.students')],
        ['href' => '', 'icono' => 'fa fa-times-rectangle', 'texto' => trans('message.unsubscribesmaintenance')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ $socio->nombre }} {{ $socio->apellidos }}</h3>
    <h6>{{ trans('message.unscribedstudentstext') }}</h6>
    <hr>
    @if (count($alumnosbajas) > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('cabecera_socios.id') }}</th>
                        <th>{{ trans('form_alumnos.cabfullname') }}</th>
                        <th>{{ trans('form_alumnos.cabbirthyear') }}</th>
                        <th>{{ trans('form_alumnos.cabcourse') }}</th>
                        <th>{{ trans('acciones_crud.unscribeddate') }}</th>
                        <th>{{ trans('cabecera_socios.actions') }}</th>
                    </tr>
                </thead>
                @foreach ($alumnosbajas as $alumnosbaja)
                    <tbody>
                        <td>{{ $alumnosbaja->id }}</td>
                        <td>{{ $alumnosbaja->nombre }}</td>
                        <td>{{ $alumnosbaja->anionacim }}</td>
                        <td>{{ $alumnosbaja->course->curso }}</td>
                        <td>{{ $alumnosbaja->deleted_at }}</td>
                        <td>
                            <i class="text-primary fa fa-rotate-left"></i><a href="{{ url('backend/alumnos/bajas/restore', $alumnosbaja->id) }}"><span class="text-primary texto-accion">{{  trans('acciones_crud.restore') }}</span></a>
                            <i class="text-danger fa fa-rotate-right"></i><a href="{{ url('backend/alumnos/bajas/forcedelete' ,$alumnosbaja->id) }}"><span class="text-danger texto-accion">{{ trans('acciones_crud.forcedelete') }}</span></a>
                        </td>
                    </tbody>
                @endforeach
            </table>
            <td>{{ trans('message.totalmembersunscribed') }}: {{ $alumnosbajas->count() }}</td>
        </div>
    @endif
@endsection
