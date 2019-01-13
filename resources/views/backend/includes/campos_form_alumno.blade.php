
@if ($modo === 'new')
<div class="form-group">
  {!! Form::hidden('user_id', $socio->id) !!}
</div>
<div class="form-group">
  {!! Form::label('nombre', trans('form_alumnos.lbfullname'), ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-user"></i></span>
      {!! Form::text('nombre', null, ['class' => 'form-control', 'name' => 'nombre', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('message.enterfullname')]) !!}
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('anionacim', trans('form_alumnos.lbbirthyear'),['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      {!! Form::text('anionacim', null, ['class' => 'form-control', 'name' => 'anionacim', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('message.enterbirthyear')]) !!}
    </div>
  </div>
</div>
@endif
@if ($modo === 'update')
  <div class="form-group">
    {!! Form::hidden('user_id', $alumno->user_id) !!}
  </div>
  <div class="form-group">
    {!! Form::label('nombre', trans('form_alumnos.lbfullname'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        {!! Form::text('nombre', null, ['class' => 'form-control', 'name' => 'nombre', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('message.enterfullname')]) !!}
      </div>
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('anionacim', trans('form_alumnos.lbbirthyear'),['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        {!! Form::text('anionacim', null, ['class' => 'form-control', 'name' => 'anionacim', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('message.enterbirthyear')]) !!}
      </div>
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('curso', trans('form_alumnos.lbcourse'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-list"></i></span>
        {!! Form::select('course_id', $listacursos, null, ['class' => 'form-control', 'placeholder' => trans('form_alumnos.entercourse')]) !!}
      </div>
    </div>
  </div>
@endif
@if($modo === 'view')
  <div class="form-group">
    {!! Form::label('nombre', trans('form_alumnos.lbfullname'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        {!! Form::label('nombre', $alumno->nombre, ['class' => 'form-control', 'name' => 'nombre']) !!}
      </div>
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('anionacim', trans('form_alumnos.lbbirthyear'),['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        {!! Form::label('anionacim', $alumno->anionacim, ['class' => 'form-control', 'name' => 'anionacim']) !!}
      </div>
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('curso', trans('form_alumnos.lbcourse'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-list"></i></span>
        {!! Form::label('curso', $alumno->course->curso, ['class' => 'form-control', 'name' => 'curso']) !!}
      </div>
    </div>
  </div>
@endif