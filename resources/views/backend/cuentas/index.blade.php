@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-euro',
    'trans_msg_title'=> trans('message.accountsbook'),
    'items' => [
        ['href' => route('home'), 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-euro', 'texto' => trans('message.accountsbook')],
        ],
    ])
@endcomponent

@section('content')
    <table>
        <tr>
            <td style="width: 5%"><a type="button" role="button" class="btn btn-info btn-sm" href="{{ route('cuentas.createitem') }}"><i class="fa fa-money"></i>{{ trans('message.additem') }}</a></td>
            <td style="width: 95%; font-size: 20px; text-align: right">
            @if ($saldoPeriodo >= 0)
                <p class="text-success">{{ trans('message.currentbalance') }} {{ $saldoPeriodo }}€</p>
            @else
                <p class="text-danger">{{ trans('message.currentbalance') }} {{ $saldoPeriodo }}€</p>
            @endif
            </td>
        </tr>
    </table>

    @component('backend.components.datatable', [
        'table_id' => 'movimientos',
        'table_name' => 'movimientos',
        'route_name' => 'cuentas.cuentasdata',
        'route_param' => '',
        'columndefs' => [
            ['width' => '100%', 'targets' => 6]
            ],
        'columns'=> [
            ['data' => 'created_at', 'name' => 'created_at', 'header' => trans('cabecera_cuentas.entrydate')],
            ['data' => 'domiciliacion', 'name' => 'domiciliacion', 'header' => trans('cabecera_cuentas.debit')],
            ['data' => 'tipo', 'name' => 'tipo', 'header' => trans('cabecera_cuentas.type')],
            ['data' => 'codigo', 'name' => 'codigo', 'header' => trans('cabecera_cuentas.invoicecode')],
            ['data' => 'importe', 'name' => 'importe', 'header' => trans('cabecera_cuentas.amount')],
            ['data' => 'saldo', 'name' => 'saldo', 'header' => trans('cabecera_cuentas.balance')],
            ['data' => 'action', 'name' => 'action', 'header' => trans('cabecera_cuentas.actions')],
            ],
        'filter' => 'Filtrados'
        ])
    @endcomponent
@endsection