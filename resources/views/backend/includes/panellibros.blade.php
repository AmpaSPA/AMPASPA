<!-- Panel 2: Libros -->
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#acordeon" href="#bloque1">
          <span class="icono_bloque fa fa-book"></span>{{ trans('message.books')}}</a>
        </h4>
    </div>
    <div id="bloque1" class="panel-collapse collapse">
        <div class="panel-body">
            <table class="table">
                <tr>
                    <td id="celda_bloque_icono"><span class="fa fa-eur text-primary"></span></td>
                    @if ($saldoPeriodo
                    < 0) <td id="celda_bloque_texto"><a href="{{ route('cuentas.list') }}">{{ trans('message.accountsbook') }}</a><span class="texto-badge badge badgerojo">{{ $saldoPeriodo }}€</span></td>
                        @else
                        <td id="celda_bloque_texto"><a href="{{ route('cuentas.list') }}">{{ trans('message.accountsbook') }}</a><span class="texto-badge badge badgeverde">{{ $saldoPeriodo }}€</span></td>
                        @endif
                </tr>
                <tr>
                    <td id="celda_bloque_icono"><span class="fa fa-list-alt text-primary"></span></td>
                    <td id="celda_bloque_texto"><a href="{{ route('actas.list') }}">{{ trans('message.proceedingsbook') }}</a><span class="texto-badge badge">@if($numActas > 0){{ $numActas }}@endif</span></td>
                </tr>
                <tr>
                    <td id="celda_bloque_icono"><span class="fa fa-users text-primary"></span></td>
                    <td id="celda_bloque_texto"><a href="{{ url('backend/socios') }}">{{ trans('message.membersbook') }}</a><span class="texto-badge badge">@if($numsocios > 0){{ $numsocios }}@endif</span></td>
                </tr>
            </table>
        </div>
    </div>
</div>