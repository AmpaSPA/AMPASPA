@extends('backend.layouts.backend')

@if(!$url_profile)
    @component('backend.components.headerpage', [
        'icono_title' => 'fa fa-upload',
        'trans_msg_title' => trans('message.importsignature'),
        'items' => [
            ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
            ['href' => route('socios.gestionardocs'), 'icono' => 'fa fa-upload', 'texto' => trans('message.importdocuments')],
            ['href' => '', 'icono' => 'fa fa-upload', 'texto' => trans('message.importsignature')],
            ],
        ])
    @endcomponent
@else
    @component('backend.components.headerpage', [
        'icono_title' => 'fa fa-file-pdf-o',
        'trans_msg_title' => trans('message.importyoursignature'),
        'items' => [
            ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
            ['href' => route('profile.home', $socio->id), 'icono' => 'fa fa-pencil', 'texto' => trans('message.profile')],
            ['href' => '', 'icono' => 'fa fa-file-pdf-o', 'texto' => trans('message.importyoursignature')],
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
    @if(!$socio->firmaadhesion)
        <div class="itemdoc">
            <h3>{{ trans('message.signaturedocument') }}</h3>
            <p><strong class="text-primary">{{ trans('message.signaturedocumenttext') }}</strong></p>
            @if ($url_profile)
                {{ Form::open(['method' => 'POST', 'url' => url('backend/socios/gestionardocprofile/adhesion', $socio->id), 'enctype' => 'multipart/form-data']) }}
            @else
                {{ Form::open(['method' => 'POST', 'url' => url('backend/socios/gestionardoc/adhesion', $socio->id), 'enctype' => 'multipart/form-data']) }}
            @endif
            {!! Form::hidden('nombre', $socio->nombre) !!}
            {!! Form::hidden('apellidos', $socio->apellidos) !!}
            {!! Form::hidden('numdoc', $socio->numdoc) !!}
            {!! Form::file('firma') !!}
            @if (!$url_profile)
                <button id="btactualizafirma" type="submit" class="btn btn-primary"><i class="fa fa-upload"></i>{{ trans('message.importsignature') }}</button>
            @else
                <button id="btactualizafirma" type="submit" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i>{{ trans('message.importyoursignature') }}</button>
            @endif
            {!! Form::close() !!}
        </div>
    @endif
@endsection
