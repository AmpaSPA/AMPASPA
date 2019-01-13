@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-search',
    'trans_msg_title' => trans('message.verifyreceipt'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('profile.validardocs'), 'icono' => 'fa fa-search', 'texto' => trans('message.verifydocuments')],
        ['href' => '', 'icono' => 'fa fa-search', 'texto' => trans('message.verifyreceipt')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.verifyreceiptof') }} {{ $socio->nombre }} {{ $socio->apellidos }}</h3>
    <h6>{{ trans('message.verifyreceipttext') }}</h6><br>
    <div class="table-responsive">
        <tbody>
            <tr>
                <ul>
                    <li><strong class="text-primary">{{ trans('message.stepone') }}</strong> {{ trans('message.verifyreceiptsteponetext') }}<br> <a id="btverrecibo" target="_blank" type="button" class="btn btn-warning center-block" href="{{ route('socios.recibo', $socio->id) }}"><i class="fa  fa-list-alt " aria-hidden="true"></i>{{ trans('message.viewreceipt') }}</a></li><br>
                    <li><strong class="text-primary">{{ trans('message.steptwo') }}</strong> {{ trans('message.verifyreceiptsteptwotext') }}<br> <a id="btverrecibo" type="button" class="btn btn-success center-block" href="{{ route('socios.confirmarrecibo', $socio->id) }}"><i class="fa  fa-check " aria-hidden="true"></i>{{ trans('message.confirmreceipt') }}</a></li><br>
                    <li><strong class="text-primary">{{ trans('message.stepthree') }}</strong> {{ trans('message.verifyreceiptstepthreetext') }}<br> <a id="btverrecibo" type="button" class="btn btn-danger center-block" href="{{ route('socios.rechazarrecibo', $socio->id) }}"><i class="fa  fa-close " aria-hidden="true"></i>{{ trans('message.rejectreceipt') }}</a></li><br>
                </ul>
            </tr>
        </tbody>
    </div>
@endsection
