<tr>
	<td id="celda_bloque_icono"><span class="fa fa-calendar text-primary"></span></td>
	@if (now()->month >= 9 && now()->month <= 11)
		<td id="celda_bloque_texto"><a href={{ route( 'periodos.gestion') }}>{{ trans('message.courses') }} </a><span class="text-danger fa fa-exclamation-circle"></span></td>
	@else
		<td id="celda_bloque_texto"><a href={{ route( 'periodos.gestion') }}>{{ trans('message.courses') }}</a></td>
	@endif
</tr>