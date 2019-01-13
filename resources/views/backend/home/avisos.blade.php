@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-bullhorn',
    'trans_msg_title' => trans('message.warnings'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-bullhorn', 'texto' => trans('message.warnings')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.openwarningsfor') }} {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h3>
    <div class="panel panel-info">
        <div class="panel-body">
            @if(count($avisos_abiertos) > 0)
                @foreach($avisos_abiertos as $aviso_abierto)
                    @if($loop->iteration > 1)
                        <hr>
                    @endif
                    <h5 class="text-info"><i class="fa fa-bullhorn"></i> {{ $aviso_abierto['codigo'] }}</h5>
                    <ul>
                        <p><strong>{{ trans('message.date') }}:</strong> {{ $aviso_abierto['fecha'] }}</p>
                        <p class="text-danger"><strong>{{ trans('message.warning') }}:</strong> {{ $aviso_abierto['aviso'] }}</p>
                        <p><strong>{{ trans('message.solution') }}:</strong> {{ $aviso_abierto['solucion'] }}</p>
                    </ul>
                @endforeach
            @endif
        </div>
    </div>
@endsection

