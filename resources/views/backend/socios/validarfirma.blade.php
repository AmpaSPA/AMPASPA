@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-search',
    'trans_msg_title' => trans('message.verifydocuments'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('profile.validardocs'), 'icono' => 'fa fa-search', 'texto' => trans('message.verifydocuments')],
        ['href' => '', 'icono' => 'fa fa-search', 'texto' => trans('message.verifysignature')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.verifysignatureof') }} {{ $socio->nombre }} {{ $socio->apellidos }}</h3>
    <p id="texto_verificar_firma">{{ trans('message.verifysignaturetext') }}</p>
    <div class="table-responsive">
        <tbody>
            <tr>
                <ul>
                    <li><strong class="text-primary">{{ trans('message.stepone') }}</strong> {{ trans('message.verifysignaturesteponetext') }}<a id="btverfirmaprofile" target="_blank" type="button" class="btn btn-warning center-block" href="{{ route('socios.firma', $socio->id) }}"><i class="fa fa-list-alt" aria-hidden="true"></i>{{ trans('message.viewthesignature') }}</a></li>
                    <li><strong class="text-primary">{{ trans('message.steptwo') }}</strong> {{ trans('message.verifysignaturesteptwotext') }}<a id="btconfirmarfirma" type="button" class="btn btn-success center-block" href="{{ route('socios.confirmarfirma', $socio->id) }}"><i class="fa fa-check" aria-hidden="true"></i>{{ trans('message.confirmsignature') }}</a></li>
                    <li><strong class="text-primary">{{ trans('message.stepthree') }}</strong> {{ trans('message.verifysignaturestepthreetext') }}<a id="btrechazarfirma" type="button" class="btn btn-danger center-block" href="{{ route('socios.rechazarfirma', $socio->id) }}"><i class="fa fa-close" aria-hidden="true"></i>{{ trans('message.rejectsignature') }}</a></li>
                </ul>
            </tr>
        </tbody>
    </div>
@endsection
