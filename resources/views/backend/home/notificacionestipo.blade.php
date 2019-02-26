@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-envelope',
    'trans_msg_title' => trans('message.notifications'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('home.notificaciones'), 'icono' => 'fa fa-envelope', 'texto' => trans('message.notifications')],
        ['href' => '', 'icono' => 'fa fa-check', 'texto' => trans('acciones_crud.select')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.unreadnotificationsof') }} {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h3>
    <h6>{{ trans('message.notificationtype') }}: <strong class="textoazul">{{ $tipo }}</strong></h6>
    <hr class="hrazul">

    @if ($notificaciones->count() > 0)
        <div class="table-responsive">
            @switch($tipo)
                @case('Reunión convocada')
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans('form_reunion.cabid') }}</th>
                                <th>{{ trans('form_reunion.cabdate') }}</th>
                                <th>{{ trans('form_reunion.cabtime') }}</th>
                                <th>{{ trans('form_reunion.cabtype') }}</th>
                                <th>{{ trans('form_reunion.cabstatus') }}</th>
                                <th>{{ trans('form_reunion.cabactions') }}</th>
                            </tr>
                        </thead>
                        @foreach ($notificaciones as $notificacion)
                            <tbody>
                                <td>{{ $notificacion->data['reunion']['id'] }}</td>
                                <td>{{ $notificacion->data['reunion']['fechareunion'] }}</td>
                                <td>{{ $notificacion->data['reunion']['horareunion'] }}</td>
                                <td>{{ $notificacion->data['reunion']['meetingtype']['tiporeunion'] }}</td>
                                <td>
                                    @if ($notificacion->data['reunion']['celebrada'])
                                        {{ trans('form_reunion.celebrated') }}
                                    @else
                                        {{ trans('form_reunion.pending') }}
                                    @endif
                                </td>
                                <td>
                                    @if (!$notificacion->data['reunion']['celebrada'])
                                        <i class="text-info fa fa-book"></i><a href="{{ route('home.notificacionestipoleer', $notificacion->id) }}"><span class="text-info texto-accion">{{  trans('acciones_crud.read') }}</span></a>
                                    @else
                                        <i class="text-danger fa fa-check"></i><a href="{{ route('home.notificacionesvencida', $notificacion->id) }}"><span class="text-danger texto-accion">{{  trans('acciones_crud.markasread') }}</span></a>
                                    @endif
                                </td>
                            </tbody>
                        @endforeach
                        <tfoot>
                            <tr>
                                <th>{{ trans('form_reunion.cabid') }}</th>
                                <th>{{ trans('form_reunion.cabdate') }}</th>
                                <th>{{ trans('form_reunion.cabtime') }}</th>
                                <th>{{ trans('form_reunion.cabtype') }}</th>
                                <th>{{ trans('form_reunion.cabstatus') }}</th>
                                <th>{{ trans('form_reunion.cabactions') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                    <p>{{ trans('message.totalnotifications') }}: {{ $notificaciones->count() }}</p>
                @break
                @case('Actividad publicada')
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans('form_actividad.cabid') }}</th>
                                <th>{{ trans('form_actividad.cabdate') }}</th>
                                <th>{{ trans('form_actividad.cabname') }}</th>
                                <th>{{ trans('form_actividad.cabtype') }}</th>
                                <th>{{ trans('form_actividad.cabstatus') }}</th>
                                <th>{{ trans('form_actividad.cabactions') }}</th>
                            </tr>
                        </thead>
                        @foreach ($notificaciones as $notificacion)
                            <tbody>
                                <td>{{ $notificacion->data['actividad']['id'] }}</td>
                                <td>{{ $notificacion->data['actividad']['fechaactividad'] }}</td>
                                <td>{{ $notificacion->data['actividad']['nombre'] }}</td>
                                <td>{{ $notificacion->data['actividad']['activitytype']['tipoactividad'] }}</td>
                                <td>
                                    @if ($notificacion->data['actividad']['cerrada'])
                                        {{ trans('form_reunion.celebrated') }}
                                    @else
                                        {{ trans('form_reunion.pending') }}
                                    @endif
                                </td>
                                <td>
                                    @if (!$notificacion->data['actividad']['cerrada'])
                                        <i class="text-info fa fa-book"></i><a href="{{ route('home.notificacionestipoleer', $notificacion->id) }}"><span class="text-info texto-accion">{{  trans('acciones_crud.read') }}</span></a>
                                    @else
                                        <i class="text-danger fa fa-check"></i><a href="{{ route('home.notificacionesvencida', $notificacion->id) }}"><span class="text-danger texto-accion">{{  trans('acciones_crud.markasread') }}</span></a>
                                    @endif
                                </td>
                            </tbody>
                        @endforeach
                        <tfoot>
                            <tr>
                                <th>{{ trans('form_actividad.cabid') }}</th>
                                <th>{{ trans('form_actividad.cabdate') }}</th>
                                <th>{{ trans('form_actividad.cabname') }}</th>
                                <th>{{ trans('form_actividad.cabtype') }}</th>
                                <th>{{ trans('form_actividad.cabstatus') }}</th>
                                <th>{{ trans('form_actividad.cabactions') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                    <p>{{ trans('message.totalnotifications') }}: {{ $notificaciones->count() }}</p>
                @break
            @endswitch
        </div>
    @endif
@endsection
