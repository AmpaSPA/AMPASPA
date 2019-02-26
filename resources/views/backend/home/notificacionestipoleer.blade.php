@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-envelope',
    'trans_msg_title' => trans('message.notifications'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-envelope', 'texto' => trans('message.notifications')],
        ['href' => route('home.notificacionestipo', $notificacion->type), 'icono' => 'fa fa-check', 'texto' => trans('acciones_crud.select')],
        ['href' => '', 'icono' => 'fa fa-book', 'texto' => trans('acciones_crud.read')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ $tipo }}</h3>
    <hr class="hrazul">
    @switch($tipo)
        @case('Reunión convocada')
            <h4 class="text-center textoazul">{{ trans('message.meetingdatatext') }}</h4>
            <p class="text-center">
                <strong>{{ trans('message.date') }}:</strong>
                {{ $notificacion->data['reunion']['fechareunion'] }}
                <strong>{{ trans('message.time') }}:</strong>
                {{ $notificacion->data['reunion']['horareunion'] }}
                <strong>{{ trans('message.type') }}:</strong>
                {{ $notificacion->data['reunion']['meetingtype']['tiporeunion'] }}
            </p>
            <p class="text-center">
                <strong>{{ trans('message.called') }}</strong>
                @if($notificacion->data['reunion']['convocada'] == false)
                    {{ trans('message.not') }}
                @else
                    {{ trans('message.yes') }}
                @endif
                <strong>{{ trans('message.celebrated') }}</strong>
                @if($notificacion->data['reunion']['celebrada'] == false)
                    {{ trans('message.not') }}
                @else
                    {{ trans('message.yes') }}
                @endif
            </p>

            <h4 class="text-center textoazul">{{ trans('message.agendatext') }}</h4>
            <ol>
                @foreach ($notificacion->data['reunion']['topics'] as $item)
                    <li class="textoazul"><p class="textoazul"><strong>{{ $item['titulo'] }}</strong></p></li>
                    <p>{{ $item['tema'] }}</p>
                    <p><strong>{{ trans('form_temas.lbowner') }}</strong> {{ $item['propietario'] }}</p>
                    <p><strong>{{ trans('form_temas.lbleader') }}</strong> {{ $item['responsable'] }}</p>
                @endforeach
            </ol>

            <h4 class="text-center textoazul">{{ trans('message.listofassistantstext') }}</h4>
                @foreach ($notificacion->data['reunion']['attendees'] as $item)
                    <p class="text-center textoazul"><strong>{{ $item['nombre'] }}</strong> - {{ $item['numdoc'] }}
                        @if (!$notificacion->data['reunion']['celebrada'])
                            @if ($item['numdoc'] === Auth::User()->numdoc)
                                --- <strong><a class="text-success" href="{{ route('home.notificacionesmarcar', $notificacion->id) }}"><i class="fa fa-thumbs-up"></i>{{ trans('acciones_crud.confirmassistance') }}</a></strong>
                            @endif
                        @endif
                    </p>
                @endforeach
        @break
        @case('Actividad publicada')
            <h4 class="text-center textoazul">{{ trans('message.activitydatatext') }}</h4>
            <p class="text-center">
                <strong>{{ trans('message.date') }}:</strong>
                {{ $notificacion->data['actividad']['fechaactividad'] }}
                <strong>{{ trans('message.name') }}</strong>
                {{ $notificacion->data['actividad']['nombre'] }}
            </p>
            <p class="text-center">
                <strong>{{ trans('message.published') }}</strong>
                @if($notificacion->data['actividad']['publicada'] == false)
                    {{ trans('message.not') }}
                @else
                    {{ trans('message.yes') }}
                @endif
                <strong>{{ trans('message.closed') }}</strong>
                @if($notificacion->data['actividad']['cerrada'] == false)
                    {{ trans('message.not') }}
                @else
                    {{ trans('message.yes') }}
                @endif
            </p>

            <h4 class="text-center textoazul">{{ trans('message.descriptiontext') }}</h4>
            <p>{{ $notificacion->data['actividad']['descripcion'] }}</p>

            <h4 class="text-center textoazul">{{ trans('message.complementarydatatext') }}</h4>
            <p class="text-center">
                <strong>{{ trans('message.price') }}</strong>
                {{ $notificacion->data['actividad']['precio'] }}€
                <strong>{{ trans('message.grant') }}</strong>
                {{ $notificacion->data['actividad']['subvencion'] }}€
            </p>
            <p class="text-center">
                <strong>{{ trans('message.target') }}</strong> {{ $notificacion->data['actividad']['activitytarget']['colectivo'] }}
                <strong>{{ trans('message.students') }}</strong> {{ $notificacion->data['actividad']['activitytarget']['destinoactividad'] }}
            </p>
            <p class="text-center"><strong>{{ trans('form_temas.lbleader') }}</strong> {{ $notificacion->data['actividad']['activitytype']['tipoactividad'] }}</p>

            {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET', 'url' => route('home.notificacionesvencida', $notificacion->id), 'novalidate' => 'novalidate']) !!}
            <div class="form-group">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button id="btnuevo" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i>{{ trans('acciones_crud.markasread') }}</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        @break
    @endswitch
@endsection
