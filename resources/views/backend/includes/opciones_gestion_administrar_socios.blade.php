<tr>
	<td id="celda_bloque_icono"><span class="fa fa-universal-access text-primary"></span></td>
	<td id="celda_bloque_texto"><a href={{ route('actividades.gestion') }}>{{ trans('message.activities') }}</a></td>
</tr>
@if ($docs_pendientes_importar > 0)
  	<tr>
		<td id="celda_bloque_icono"><span class="fa fa-upload text-primary "></span></td>
		<td id="celda_bloque_texto"><a href={{ route('socios.gestionardocs') }}>{{ trans('message.importdocuments') }}</a><span class="texto-badge badge">{{ $docs_pendientes_importar }}</span></td>
	</tr>
@endif 
@if ($verificar_documentos > 0)
  	<tr>
		<td id="celda_bloque_icono"><span class="fa fa-search text-primary "></span></td>
		<td id="celda_bloque_texto"><a href={{ route('profile.validardocs') }}>{{ trans('message.verifydocuments') }}</a><span class="texto-badge badge">{{ $verificar_documentos }}</span></td>
	</tr>
@endif