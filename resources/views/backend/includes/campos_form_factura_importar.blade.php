<div class="form-group">
    {!! Form::hidden('id_factura', $factura->id) !!}
</div>
<div class="form-group">
    {!! Form::label(null, trans('form_factura.lbfrom')) !!}
    {!! Form::label(null, $factura->emisor, ['class' => 'control-label text-info']) !!}
</div>
<div class="form-group">
    {!! Form::label(null, trans('form_factura.lbinvoicedate')) !!}
    {!! Form::label(null, $factura->fecha, ['class' => 'control-label text-info']) !!}
</div>
<div class="form-group">
    {!! Form::label(null, trans('form_factura.lbamount')) !!}
    {!! Form::label(null, $factura->importe, ['class' => 'control-label text-info']) !!}<span class="textoazul">€</span>
</div>
<br><br>
<div class="form-group">
    {!! Form::file('documento') !!}
</div>
