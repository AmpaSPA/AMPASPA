<tr>
	<td id="celda_bloque_icono"><span class="fa fa-file-text text-primary"></span></td>
	@if ($facturas_pendientes > 0)
		<td id="celda_bloque_texto"><a href={{ route('facturas.gestion') }}>{{ trans('message.invoices') }}</a><span class="texto-badge badge">{{ $facturas_pendientes }}</span></td>
	@else
		<td id="celda_bloque_texto"><a href={{ route('facturas.gestion') }}>{{ trans('message.invoices') }}</a></td>
	@endif
</tr>