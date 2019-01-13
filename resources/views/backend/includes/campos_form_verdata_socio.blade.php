<div class="form-group">
  {!! Form::label('nombre', trans('socios.lbfname'), ['class' => 'col-md-4 control-label']) !!}
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-user"></i></span>
      {!! Form::text('nombre', null, ['class' => 'form-control', 'name' => 'nombre', 'value' => old('nombre'), 'autofocus' => 'autofocus', 'placeholder' => trans('message.enterfirstname')]) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('apellidos', trans('socios.lblname'),['class' => 'col-md-4 control-label']) !!}
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-user"></i></span>
      {!! Form::text('apellidos', null, ['class' => 'form-control', 'name' => 'apellidos', 'value' => old('apellidos'), 'autofocus' => 'autofocus', 'placeholder' => trans('message.enterlastname')]) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('telefono', trans('socios.lbphone'), ['class' => 'col-md-4 control-label']) !!}
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
      {!! Form::text('telefono', null, ['class' => 'form-control', 'name' => 'telefono', 'value' => old('telefono'),'autofocus' => 'autofocus', 'placeholder' => trans('message.enterphonenumber')]) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('tipodoc', trans('socios.lbdoctype'), ['class' => 'col-md-4 control-label']) !!}
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
      {!! Form::select('doctype_id', $tdocs, null, ['class' => 'form-control', 'placeholder' => trans('message.enterdocumenttype')]) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('numdoc', trans('socios.lbdocnum'), ['class' => 'col-md-4 control-label']) !!}
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
      {!! Form::text('numdoc', null, ['class' => 'form-control', 'name' => 'numdoc', 'value' => old('numdoc'), 'autofocus' => 'autofocus', 'placeholder' => trans('message.enterdocumentnumber')]) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('tipopago', trans('socios.lbpaymenttype'), ['class' => 'col-md-4 control-label']) !!}
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-euro"></i></span>
      {!! Form::select('paymenttype_id', $tpagos, null, ['class' => 'form-control', 'placeholder' => trans('message.enterpaymenttype')]) !!}
    </div>
  </div>
</div>
