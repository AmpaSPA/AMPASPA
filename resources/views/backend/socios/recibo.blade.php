@extends('backend.layouts.backend')

@if(!$url_profile)
    @component('backend.components.headerpage', [
        'icono_title' => 'fa fa-upload',
        'trans_msg_title' => trans('message.importreceipt'),
        'items' => [
            ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
            ['href' => route('socios.gestionardocs'), 'icono' => 'fa fa-upload', 'texto' => trans('message.importdocuments')],
            ['href' => '', 'icono' => 'fa fa-upload', 'texto' => trans('message.importreceipt')],
            ],
        ])
    @endcomponent
@else
    @component('backend.components.headerpage', [
        'icono_title' => 'fa fa-file-pdf-o',
        'trans_msg_title' => trans('message.importreceipt'),
        'items' => [
            ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
            ['href' => route('profile.home', $socio->id), 'icono' => 'fa fa-pencil', 'texto' => trans('message.profile')],
            ['href' => '', 'icono' => 'fa fa-file-pdf-o', 'texto' => trans('message.importreceipt')],
            ],
        ])
    @endcomponent
@endif

@section('content')
    <h3>{{ $socio->nombre }} {{ $socio->apellidos }}</h3>
    @if ($socio->justificantepago && $socio->firmaadhesion)
        <p class="text-center"><strong class="text-primary">{{ trans('message.nopendingdocumentation') }}</strong></p>
    @else
        <p>{{ trans('message.pendingdocumentation') }}:</p>
    @endif
    @if (!$socio->justificantepago)
        <div class="itemdoc">
            <h3>{{ trans('message.receiptdocument') }}</h3>
            <p><strong class="text-primary">{{ trans('message.receiptdocumenttext') }}</strong></p>
            @if ($url_profile)
                {{ Form::open(['method' => 'POST', 'url' => url('backend/socios/gestionardocprofile/justificante', $socio->id), 'enctype' => 'multipart/form-data']) }}
            @else
                {{ Form::open(['method' => 'POST', 'url' => url('backend/socios/gestionardoc/justificante', $socio->id), 'enctype' => 'multipart/form-data']) }}
            @endif
            {!! Form::hidden('nombre', $socio->nombre) !!}
            {!! Form::hidden('apellidos', $socio->apellidos) !!}
            {!! Form::hidden('numdoc', $socio->numdoc) !!}
            {!! Form::file('jpago') !!}
            @if (!$url_profile)
                <button id="btactualizajpago" type="submit" class="btn btn-primary"><i class="fa fa-upload"></i>{{ trans('message.importreceipt') }}</button>
            @else
                <button id="btactualizajpago" type="submit" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i>{{ trans('message.importyourreceipt') }}</button>
            @endif
            {!! Form::close() !!}
        </div>
    @endif
@endsection
