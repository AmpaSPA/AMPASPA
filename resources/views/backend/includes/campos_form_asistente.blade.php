@if ($modo === 'new')
    <div class="form-group">
        {!! Form::hidden('meeting_id', $reunion->id) !!}
    </div>
    <div class="form-group">
        {!! Form::label('fullname', trans('form_asistentes.lbfullname'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    {!! Form::select('id', $asistentes, null, ['class' => 'form-control', 'placeholder' => trans('form_asistentes.selectfullname')]) !!}
            </div>
        </div>
    </div>
@else
    @if ($modo === 'update')
        <div class="form-group">
            {!! Form::hidden('meeting_id', $tema->meeting_id) !!}
        </div>
        <div class="form-group">
            {!! Form::label('titulo', trans('form_temas.lbtitle'), ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bookmark"></i></span> {!! Form::text('titulo', null, ['class' =>
                    'form-control', 'name' => 'titulo', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('form_temas.entertitle')])
                    !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('propietario', trans('form_temas.lbowner'),['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span> {!! Form::text('propietario', null, ['class'
                    => 'form-control', 'name' => 'propietario', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder'
                    => trans('form_temas.enterowner')]) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('responsable', trans('form_temas.lbleader'),['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check"></i></span> {!! Form::text('responsable', null, ['class'
                    => 'form-control', 'name' => 'responsable', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder'
                    => trans('form_temas.enterleader')]) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('tema', trans('form_temas.lbtopic'), ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tags"></i></span> {!! Form::textarea('tema', null, ['class'
                => 'form-control', 'rows' => '4', 'name' => 'tema', 'value' => old('tema'),'autofocus' => 'autofocus',
                'placeholder' => trans('form_temas.entertopic')]) !!}
              </div>
            </div>
          </div>
    @else
        @if($modo === 'view')
            <div class="form-group">
                {!! Form::label('titulo', trans('form_temas.lbtitle'), ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bookmark"></i></span> {!! Form::text('titulo', $tema->titulo,
                        ['class' => 'form-control', 'name' => 'titulo', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('propietario', trans('form_temas.lbowner'),['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span> {!! Form::text('propietario', $tema->propietario,
                        ['class' => 'form-control', 'name' => 'propietario', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('responsable', trans('form_temas.lbleader'), ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-check"></i></span> {!! Form::text('responsable', $tema->responsable,
                        ['class' => 'form-control', 'name' => 'responsable', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('tema', trans('form_temas.lbtopic'), ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tags"></i></span> {!! Form::textarea(null, $tema->tema,
                        ['class' => 'form-control', 'name' => 'tema', 'rows' => '4', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
            </div>
        @endif
    @endif
@endif
