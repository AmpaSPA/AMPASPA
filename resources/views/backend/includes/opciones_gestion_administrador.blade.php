@if ($numsocios > 0)
 	<tr>
 		<td id="celda_bloque_icono"><span class="fa fa-users text-primary"></span></td>
 		<td id="celda_bloque_texto"><a href={{ route('accounts.index') }}>{{ trans('message.usersaccount') }}</a><span class="texto-badge badge"></span></td>
 	</tr>
 @endif
 @if ($numsocios > 1)
 	<tr>
 		<td id="celda_bloque_icono"><span class="fa fa-key text-primary"></span></td>
 		<td id="celda_bloque_texto"><a href={{ route('permisos.accounts') }}>{{ trans('message.userspermissions') }}</a></td>
 	</tr>
 @endif
