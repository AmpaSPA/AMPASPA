@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-comments',
    'trans_msg_title' => trans('message.meetings'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('reuniones.gestion'), 'icono' => 'fa fa-comments', 'texto' => trans('message.meetings')],
        ['href' => '', 'icono' => 'fa fa-align-justify', 'texto' => trans('acciones_crud.topics')]
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.meetingtopics', ['fecha' => $fecha, 'tipo' => $reunion->meetingtype()->pluck('tiporeunion')->implode('')]) }}</h3>
    <h6>{{ trans('message.topicstarget') }}</h6>
    <hr class="hrazul">
    @if (count($apartados) > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('cabecera_temas.id') }}</th>
                        <th>{{ trans('cabecera_temas.title') }}</th>
                        <th>{{ trans('cabecera_temas.owner') }}</th>
                        <th>{{ trans('cabecera_temas.actions') }}</th>
                    </tr>
                </thead>
                @foreach ($apartados as $apartado)
                    <tbody>
                        <td>{{ $apartado['id'] }}</td>
                        <td>{{ $apartado['titulo'] }}</td>
                        <td>{{ $apartado['propietario'] }}</td>
                        <td>
                            <i class="text-success fa fa-eye"></i><a href="{{ url('backend/temas/ver', $apartado['id']) }}"><span class="text-success texto-accion">{{  trans('acciones_crud.view') }}</span></a>
                            <i class="text-warning fa fa-pencil"></i><a href="{{ url('backend/temas/editar', $apartado['id']) }}"><span class="text-warning texto-accion">{{  trans('acciones_crud.edit') }}</span></a>
                            <i class="text-danger fa fa-trash"></i><a href="{{ url('backend/temas/borrar', $apartado['id']) }}"><span class="text-danger texto-accion">{{ trans('acciones_crud.delete') }}</span></a>
                        </td>
                    </tbody>
                @endforeach
                <tfoot>
                    <tr>
                        <th>{{ trans('cabecera_temas.id') }}</th>
                        <th>{{ trans('cabecera_temas.title') }}</th>
                        <th>{{ trans('cabecera_temas.owner') }}</th>
                        <th>{{ trans('cabecera_temas.actions') }}</th>
                    </tr>
                </tfoot>
            </table>
            <p>{{ trans('message.totaltopics') }}: {{ count($apartados) }}</p>
        </div>
    @endif
    @hasrole('Administrador')
        @include('backend.includes.formulario_nuevo_tema')
    @else
        @can('Administrar socios')
            @include('backend.includes.formulario_nuevo_tema')
        @endcan
    @endhasrole
@endsection
