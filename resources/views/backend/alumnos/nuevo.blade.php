@extends('backend.layouts.backend')

@if (count($hijos) > 0)
    @component('backend.components.headerpage', [
        'icono_title' => 'fa fa-users',
        'trans_msg_title' => trans('message.membersbook'),
        'items' => [
            ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
            ['href' => route('socios.list'), 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
            ['href' => '', 'icono' => 'fa fa-graduation-cap', 'texto' => trans('acciones_crud.students')],
            ],
        ])
    @endcomponent
@else
    @component('backend.components.headerpage', [
        'icono_title' => 'fa fa-users',
        'trans_msg_title' => trans('message.membersbook'),
        'items' => [
            ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
            ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
            ['href' => '', 'icono' => 'fa fa-user-plus', 'texto' => trans('message.addmember')],
            ['href' => '', 'icono' => 'fa fa-graduation-cap', 'texto' => trans('acciones_crud.students')],
            ],
        ])
    @endcomponent
  @endif

@section('content')
    @if (count($alumnosbaja) > 0)
        <div class="btn-group" role="group">
            <a type="button" role="button" class="btn btn-danger btn-sm" href="{{ url('backend/alumnos/bajas', $socio->id) }}"><i class="fa fa-times-rectangle"></i>{{ trans('message.unsubscribesmaintenance') }}</a>
        </div>
    @endif
    <h3>{{ $socio->nombre }} {{ $socio->apellidos }}</h3>
    <h6>{{ trans('message.childrenstudents') }}</h6>
    <hr>
    @if (count($hijos) > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('cabecera_socios.id') }}</th>
                        <th>{{ trans('message.fullname') }}</th>
                        <th>{{ trans('message.birthyear') }}</th>
                        <th>{{ trans('cabecera_socios.actions') }}</th>
                    </tr>
                </thead>
                @foreach ($hijos as $hijo)
                    <tbody>
                        <td>{{ $hijo['id'] }}</td>
                        <td>{{ $hijo['nombre'] }}</td>
                        <td>{{ $hijo['anionacim'] }}</td>
                        <td>
                            <i class="text-success fa fa-eye"></i><a href="{{ url('backend/alumnos/ver', $hijo['id']) }}"><span class="text-success texto-accion">{{  trans('acciones_crud.view') }}</span></a>
                            <i class="text-warning fa fa-pencil"></i><a href="{{ url('backend/alumnos/edit', $hijo['id']) }}"<span class="text-warning texto-accion">{{  trans('acciones_crud.edit') }}</span></a>
                            <i class="text-danger fa fa-trash"></i><a href="{{ url('backend/alumnos/borrar', $hijo['id']) }}"<span class="text-danger texto-accion">{{ trans('acciones_crud.delete') }}</span></a>
                        </td>
                    </tbody>
                @endforeach
                <tfoot>
                    <tr>
                        <th>{{ trans('cabecera_socios.id') }}</th>
                        <th>{{ trans('message.fullname') }}</th>
                        <th>{{ trans('message.birthyear') }}</th>
                        <th>{{ trans('cabecera_socios.actions') }}</th>
                    </tr>
                </tfoot>
            </table>
            <p>{{ trans('message.totalchildren') }}: {{ count($hijos) }}</p>
        </div>
    @endif
    @hasrole('Administrador')
        @include('backend.includes.formulario_nuevo_alumno')
    @else
        @can('Administrar socios')
            @include('backend.includes.formulario_nuevo_alumno')
        @endcan
    @endhasrole
@endsection
