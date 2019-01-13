@extends('backend.layouts.backend')

@section('titleheader')
    @if (!$url_alumno)
        @component('backend.components.headerpage', [
            'icono_title' => 'fa fa-list-alt',
            'trans_msg_title' => trans('message.authorizations'),
            'items' => [
                ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
                ['href' => route('home.autorizaciones'), 'icono' => 'fa fa-list-alt', 'texto' => trans('message.authorizations')],
                ['href' => '', 'icono' => 'fa fa-check', 'texto' => trans('acciones_crud.select')],
                ],
            ])
        @endcomponent
    @else
        @component('backend.components.headerpage', [
            'icono_title' => 'fa fa-eye',
            'trans_msg_title' => trans('message.authorizations'),
            'items' => [
                ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
                ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
                ['href' => '', 'icono' => 'fa fa-graduation-cap', 'texto' => trans('acciones_crud.addstudent')],
                ['href' => route('alumnos.ver', $alumno->id), 'icono' => 'fa fa-eye', 'texto' => rans('acciones_crud.viewstudent')],
                ['href' => '', 'icono' => 'fa fa-eye', 'texto' => trans('message.authorizations')],
                ],
            ])
        @endcomponent
    @endif
@endsection

@section('content')
    <h3>{{ trans('message.authorizationsfor') }} {{ $alumno->nombre }}</h3>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="text-info"><i class="fa fa-universal-access"></i>{{ trans('message.activitiespendingauthorization') }}</h4>
            <strong class="textopequeño">{{ trans('message.authorizeactivitytext') }}</strong>
        </div>
        <div class="panel-body">
            @if(count($act_pend_aut) > 0)
                @foreach($act_pend_aut as $pendientes)
                    <h5>
                        <div class="text-info" data-toggle="collapse" data-target="#{{ $pendientes['id'] }}">
                            <a href="#"><i class="fa fa-universal-access"></i> {{ $pendientes['nombre'] }}</a>
                        </div>
                    </h5>
                    <ul id="{{ $pendientes['id'] }}" class="collapse">
                        <li>{{ trans('form_actividad.lbactivitydate') }} {{ $pendientes['fecha'] }}.</li>
                        <li>{{ trans('form_actividad.lbdescription') }} {{ $pendientes['descripcion'] }}.</li>

                        @if ($pendientes['tipo'] == 'COLEGIO')
                            <li>{{ trans('message.organizedbyschool') }} {{ $pendientes['tipo'] }}.</li>
                        @else
                            <li>{{ trans('message.organizedbyampa') }} {{ $pendientes['tipo'] }}.</li>
                        @endif

                        @if ($pendientes['precio'] > 0)
                            <li>{{ trans('form_actividad.lbprice') }} {{ $pendientes['precio'] }}€.</li>
                            <li>{{ trans('form_actividad.lbgrant') }} {{ $pendientes['subvencion'] }}€.</li>
                        @else
                            <li>{{ trans('message.free') }}.</li>
                        @endif

                        <br>
                        <div class="pull-right"><a href="{{ route('home.autorizaractividad', [$alumno->id, $pendientes['id']]) }}" class="btn btn-sm btn-primary"><span class="fa fa-check"></span>{{  trans('acciones_crud.authorize') }}</a>
                        </div>
                    </ul>
                @endforeach
            @else
                <p class="text-success text-center">{{ $alumno->nombre }} {{ trans('message.nopendingactivities') }}.</p>
            @endif
        </div>
    </div>
    <div class="panel panel-success">
        <div class="panel-heading"><h4 class="text-success"><i class="fa fa-check"></i>{{ trans('message.activitiesalreadyauthorized') }}</h4>
        </div>
        <div class="panel-body">

            @if(count($act_ya_aut) > 0)
                @foreach($act_ya_aut as $autorizadas)
                    <h5 class="text-success"><i class="fa fa-check"></i> {{ $autorizadas['nombre'] }}</h5>
                    <ul>
                        <li>{{ trans('form_actividad.lbactivitydate') }} {{ $autorizadas['fecha'] }}</li>
                        <li>{{ trans('form_actividad.lbdescription') }} {{ $autorizadas['descripcion'] }}</li>
                    </ul>
                @endforeach
            @else
                <p class="text-success text-center">{{ $alumno->nombre }} {{ trans('message.noauthorizedactivities') }}.</p>
            @endif
        </div>
    </div>
    <div class="panel panel-danger">
            <div class="panel-heading">
                <h4 class="text-danger"><i class="fa fa-times"></i>{{ trans('message.abandonedactivities') }}</h4>
            </div>
            <div class="panel-body">
        
                @if(count($act_desistida) > 0) @foreach($act_desistida as $desistidas)
                <h5 class="text-danger"><i class="fa fa-times"></i> {{ $desistidas['nombre'] }}</h5>
                <ul>
                    <li>{{ trans('form_actividad.lbactivitydate') }} {{ $desistidas['fecha'] }}</li>
                    <li>{{ trans('form_actividad.lbdescription') }} {{ $desistidas['descripcion'] }}</li>
                </ul>
                @endforeach @else
                <p class="text-danger text-center">{{ $alumno->nombre }} {{ trans('message.noabandonedactivities') }}.</p>
                @endif
            </div>
        </div>
@endsection
