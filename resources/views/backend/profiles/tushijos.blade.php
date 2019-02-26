@extends('backend.layouts.backend')

@section('breadcrumb')
    @if (count($hijos) > 0)
        @component('backend.components.headerpage', [
            'icono_title' => 'fa fa-id-card',
            'trans_msg_title' => trans('message.profile'),
            'items' => [
                ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
                ['href' => route('profile.home', $socio->id), 'icono' => 'fa fa-id-card', 'texto' => trans('message.profile')],
                ['href' => '', 'icono' => 'fa fa-graduation-cap', 'texto' => trans('message.yourchildren')],
                ],
            ])
        @endcomponent
    @else
        @component('backend.components.headerpage', [
            'icono_title' => 'fa fa-id-card',
            'trans_msg_title' => trans('message.profile'),
            'items' => [
                ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
                ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
                ['href' => '', 'icono' => 'fa fa-user-plus', 'texto' => trans('message.addmember')],
                ['href' => '', 'icono' => 'ffa fa-graduation-cap', 'texto' => trans('acciones_crud.addstudent')],
                ],
            ])
        @endcomponent
    @endif
@endsection

@section('content')
    <h3>{{ $socio->nombre }} {{ $socio->apellidos }}</h3>
    <h6>{{ trans('message.childrenstudents') }}</h6>
    <hr class="hrazul">
    @if(count($hijos) > 0)
        @foreach ($hijos as $hijo)
            @php
                $act_autorizadas = false;
                $act_desistidas = false;
            @endphp
            @foreach ($hijo->activities as $actividad)
                @if ($actividad->pivot->authorized)
                    @php
                        $act_autorizadas = true;
                    @endphp
                @endif
                @if (!$actividad->pivot->authorized && $actividad->cerrada)
                    @php
                        $act_desistidas = true;
                    @endphp
                @endif
            @endforeach
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="panel-title" data-toggle="collapse" data-target="#{{ $hijo->id }}">
                        <a href="#"><i class="fa fa-graduation-cap"></i> {{ $hijo->nombre }}</a>
                    </div>
                </div>
                <div id="{{ $hijo->id }}" class="panel-body collapse">
                    <ul>
                        <li>{{ trans('form_alumnos.lbbirthyear') }} {{ $hijo->anionacim }}.</li>
                        <li>{{ trans('form_alumnos.lbcourse') }} {{ $hijo->course->curso }}.</li>
                    </ul>
                    <div class="table-responsive">
                        <h5 class="text-info"><strong>{{ trans('message.authorizedactivities') }}</strong></h5>
                        <table class="table table-striped">
                            @if ($act_autorizadas)
                                <thead>
                                    <tr>
                                        <th>{{ trans('form_alumnos.id') }}</th>
                                        <th>{{ trans('form_alumnos.activitydate') }}</th>
                                        <th>{{ trans('form_alumnos.name') }}</th>
                                        <th>{{ trans('form_alumnos.description') }}</th>
                                        <th>{{ trans('form_alumnos.organicedby') }}</th>
                                        <th>{{ trans('form_alumnos.activitytarget') }}</th>
                                    </tr>
                                </thead>
                                @foreach ($hijo->activities as $actividad)
                                    @if ($actividad->pivot->authorized)
                                        <tbody>
                                            <tr>
                                                <td>{{ $actividad->id }}</td>
                                                <td>{{ $actividad->fechaactividad }}</td>
                                                <td>{{ $actividad->nombre }}</td>
                                                <td>{{ $actividad->descripcion }}</td>
                                                <td>{{ $actividad->activitytype->tipoactividad }}</td>
                                                <td>{{ $actividad->activitytarget->colectivo }}</td>
                                            </tr>
                                        </tbody>
                                    @endif
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <th>{{ trans('form_alumnos.id') }}</th>
                                        <th>{{ trans('form_alumnos.activitydate') }}</th>
                                        <th>{{ trans('form_alumnos.name') }}</th>
                                        <th>{{ trans('form_alumnos.description') }}</th>
                                        <th>{{ trans('form_alumnos.organicedby') }}</th>
                                        <th>{{ trans('form_alumnos.activitytarget') }}</th>
                                    </tr>
                                </tfoot>
                            @else
                                <tbody>
                                    <tr>
                                        <td class="text-center text-danger"><strong>{{ trans('message.noauthorizedactivities') }}</strong></td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                    <div class="table-responsive">
                        <h5 class="text-danger"><strong>{{ trans('message.abandonedactivities') }}</strong></h5>
                        <table class="table table-striped">
                            @if ($act_desistidas)
                                <thead>
                                    <tr>
                                        <th>{{ trans('form_alumnos.id') }}</th>
                                        <th>{{ trans('form_alumnos.activitydate') }}</th>
                                        <th>{{ trans('form_alumnos.name') }}</th>
                                        <th>{{ trans('form_alumnos.description') }}</th>
                                        <th>{{ trans('form_alumnos.organicedby') }}</th>
                                        <th>{{ trans('form_alumnos.activitytarget') }}</th>
                                    </tr>
                                </thead>
                                @foreach ($hijo->activities as $actividad)
                                    @if (!$actividad->pivot->authorized && $actividad->cerrada)
                                        <tbody>
                                            <tr>
                                                <td>{{ $actividad->id }}</td>
                                                <td>{{ $actividad->fechaactividad }}</td>
                                                <td>{{ $actividad->nombre }}</td>
                                                <td>{{ $actividad->descripcion }}</td>
                                                <td>{{ $actividad->activitytype->tipoactividad }}</td>
                                                <td>{{ $actividad->activitytarget->colectivo }}</td>
                                            </tr>
                                        </tbody>
                                    @endif
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <th>{{ trans('form_alumnos.id') }}</th>
                                        <th>{{ trans('form_alumnos.activitydate') }}</th>
                                        <th>{{ trans('form_alumnos.name') }}</th>
                                        <th>{{ trans('form_alumnos.description') }}</th>
                                        <th>{{ trans('form_alumnos.organicedby') }}</th>
                                        <th>{{ trans('form_alumnos.activitytarget') }}</th>
                                    </tr>
                                </tfoot>
                            @else
                                <tbody>
                                    <tr>
                                        <td class="text-center text-danger"><strong>{{ trans('message.noabandonedactivities') }}</strong></td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
