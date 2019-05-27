<tr>
	<td id="celda_bloque_icono"><span class="fa fa-comments text-primary"></span></td>
	@if ($actasSinFirma > 0)
	<td id="celda_bloque_texto"><a href={{ route('reuniones.gestion') }}>{{ trans('message.meetings') }} </a><span class="text-danger fa fa-exclamation-circle"></span></td>
	@else
	<td id="celda_bloque_texto"><a href={{ route('reuniones.gestion') }}>{{ trans('message.meetings') }}</a></td>
	@endif
</tr>