@if($modo === 'update' || $modo === 'new')
<div class="form-group">
  {!! Form::label('fechaactividad', trans('form_actividad.lbactivitydate'),['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group" id="fechaactividad">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span> {!! Form::text('fechaactividad', null, ['readonly'
      => 'readonly', 'class' => 'form-control datepicker', 'name' => 'fechaactividad', 'value' => old('fechaactividad'),
      'placeholder' => trans('form_actividad.enteractivitydate')]) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('nombre', trans('form_actividad.lbname'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-tag"></i></span> {!! Form::text('nombre', null, ['class' => 'form-control',
      'name' => 'nombre', 'value' => old('nombre'),'autofocus' => 'autofocus', 'placeholder' => trans('form_actividad.entername')])
      !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('descripcion', trans('form_actividad.lbdescription'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-tags"></i></span> {!! Form::textarea('descripcion', null, ['class'
      => 'form-control', 'rows' => '4', 'name' => 'descripcion', 'value' => old('descripcion'),'autofocus' => 'autofocus',
      'placeholder' => trans('form_actividad.enterdescription')]) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('tipoactividad', trans('form_actividad.lbactivitytype'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-list-alt"></i></span> {!! Form::select('activitytype_id', $tactividades,
      null, ['class' => 'form-control', 'placeholder' => trans('form_actividad.enteractivitytype')]) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('colectivo', trans('form_actividad.lbtarget'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-group"></i></span> {!! Form::select('activitytarget_id', $targets,
      null, ['class' => 'form-control', 'placeholder' => trans('form_actividad.entertarget')]) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('subvencion', trans('form_actividad.lbgrant'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text('subvencion', null, ['class' => 'form-control',
      'name' => 'subvencion', 'value' => old('subvencion'),'autofocus' => 'autofocus', 'placeholder' => trans('form_actividad.entergrant')])
      !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('precio', trans('form_actividad.lbprice'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text('precio', null, ['class' => 'form-control',
      'name' => 'precio', 'value' => old('precio'),'autofocus' => 'autofocus', 'placeholder' => trans('form_actividad.enterprice')])
      !!}
    </div>
  </div>
</div>
@else @if($modo === 'view')
<div class="form-group">
  {!! Form::label('fechaactividad', trans('form_actividad.lbactivitydate'),['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span> {!! Form::text(null, $actividad->fechaactividad,
      ['class' => 'form-control', 'name' => 'fechaactividad', 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('nombre', trans('form_actividad.lbname'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-tag"></i></span> {!! Form::text(null, $actividad->nombre, ['class'
      => 'form-control', 'name' => 'nombre', 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('descripcion', trans('form_actividad.lbdescription'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-tags"></i></span> {!! Form::textarea(null, $actividad->descripcion,
      ['class' => 'form-control', 'name' => 'descripcion', 'rows' => '4', 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('tipoactividad', trans('form_actividad.lbactivitytype'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-list-alt"></i></span> {!! Form::text(null, $actividad->activitytype->tipoactividad,
      ['class' => 'form-control', 'name' => 'tipoactividad', 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('colectivo', trans('form_actividad.lbtarget'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-group"></i></span> {!! Form::text(null, $actividad->activitytarget->colectivo,
      ['class' => 'form-control', 'name' => 'colectivo', 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('subvencion', trans('form_actividad.lbgrant'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text(null, $actividad->subvencion, ['class'
      => 'form-control', 'name' => 'subvencion', 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('precio', trans('form_actividad.lbprice'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text(null, $actividad->precio, ['class'
      => 'form-control', 'name' => 'precio', 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('publicada', trans('form_actividad.lbpublished'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-cloud-upload"></i></span> @if ($actividad->publicada) {!! Form::text(null,
      'Si', ['class' => 'form-control', 'name' => 'publicada', 'readonly' => 'readonly']) !!} @else {!! Form::text(null,
      'No', ['class' => 'form-control', 'name' => 'publicada', 'readonly' => 'readonly']) !!} @endif
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('cerrada', trans('form_actividad.lbclosed'), ['class' => 'col-md-3 control-label']) !!}
  <div class="col-md-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-ban"></i></span> @if ($actividad->cerrada) {!! Form::text(null, 'Si',
      ['class' => 'form-control', 'name' => 'cerrada', 'readonly' => 'readonly']) !!} @else {!! Form::text(null, 'No', ['class'
      => 'form-control', 'name' => 'cerrada', 'readonly' => 'readonly']) !!} @endif
    </div>
  </div>
</div>
@endif @endif