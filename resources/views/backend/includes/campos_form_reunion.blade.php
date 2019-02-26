@if($modo === 'update' || $modo === 'new')
    <div class="form-group">
        {!! Form::label('fechareunion', trans('form_reunion.lbmeetingdate'),['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group" id="fechareunion">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                 {!! Form::text('fechareunion', null, ['readonly' => 'readonly', 'class' => 'form-control datepicker', 'name' => 'fechareunion', 'value' => old('fechareunion'), 'placeholder' => trans('form_reunion.entermeetingdate')]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('horareunion', trans('form_reunion.lbmeetingtime'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group bootstrap-timepicker timepicker">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                {!! Form::text('horareunion', null, ['id'=> 'time', 'readonly' => 'readonly', 'class' => 'form-control', 'name' => 'horareunion', 'value' => old('horareunion'), 'placeholder' => trans('form_reunion.entermeetingtime')]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('tiporeunion', trans('form_reunion.lbmeetingtype'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-filter"></i></span>
                {!! Form::select('meetingtype_id', $treuniones, null, ['class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => trans('form_reunion.entermeetingtype')]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('nota', trans('form_reunion.lbnote'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                {!! Form::textarea('nota', null, ['class' => 'form-control', 'rows' => '4', 'name' => 'nota', 'value' => old('nota'),'autofocus' => 'autofocus', 'placeholder' => trans('form_reunion.enternote')]) !!}
            </div>
        </div>
    </div>
@else
    @if($modo === 'view')
        <div class="form-group">
            {!! Form::label('horareunion', trans('form_reunion.lbmeetingtime'), ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                    {!! Form::text(null, $reunion->horareunion, ['class' => 'form-control', 'name' => 'horareunion', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('tiporeunion', trans('form_reunion.lbmeetingtype'), ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-filter"></i></span>
                    {!! Form::text(null, $reunion->meetingtype->tiporeunion, ['class' => 'form-control', 'name' => 'tiporeunion', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('nota', trans('form_reunion.lbnote'), ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                    {!! Form::textarea(null, $reunion->nota, ['class' => 'form-control', 'name' => 'nota', 'rows' => '4', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
    @endif
@endif