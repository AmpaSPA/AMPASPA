<div class="form-group">
  {!! Form::label('correo', trans('contacto.lbemail'), ['class' => 'col-md-4 control-label']) !!}
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
      {!! Form::email('correo', null, ['class' => 'form-control', 'name' => 'correo', 'value' => old('correo'), 'autofocus' => 'autofocus', 'placeholder' => trans('contacto.enteremail')]) !!}
    </div>
  </div>
</div>

<div class="form-group">
  {!! Form::label('asunto', trans('contacto.lbsubject'), ['class' => 'col-md-4 control-label']) !!}
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-file"></i></span>
      {!! Form::text('asunto', null, ['class' => 'form-control', 'name' => 'asunto', 'value' => old('asunto'), 'autofocus' => 'autofocus', 'placeholder' => trans('contacto.entersubject')]) !!}
    </div>
  </div>
</div>

<div class="form-group">
  {!! Form::label('mensaje', trans('contacto.lbtext'),['class' => 'col-md-4 control-label']) !!}
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
      {!! Form::textarea('mensaje', null, ['class' => 'form-control', 'name' => 'mensaje', 'rows' => '3', 'value' => old('apellidos'), 'autofocus' => 'autofocus', 'placeholder' => trans('contacto.entertext')]) !!}
    </div>
  </div>
</div>