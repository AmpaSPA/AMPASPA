    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => url('backend/alumnos/nuevoalumno'), 'novalidate' => 'novalidate']) !!}
      @include('backend.includes.campos_form_alumno')
      <div class="form-group">
        <div class="col-md-12">
          <div class="pull-right">
            <button id="btnuevo" type="submit" class="btn btn-primary"><i class="fa fa-graduation-cap" aria-hidden="true"></i>{{ trans('message.assignstudents') }} a {{ $socio->nombre }} {{ $socio->apellidos }}</button>
          </div>
        </div>
      </div>
    {!! Form::close() !!}
    