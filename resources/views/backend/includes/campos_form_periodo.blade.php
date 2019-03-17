@if($modo === 'update' || $modo === 'new')
    <div class="form-group">
        {!! Form::hidden('nuevoCurso', $nuevoCurso) !!}
        {!! Form::hidden('antiguoCurso', $periodo->periodo) !!}
    </div>
    <div class="form-group">
        {!! Form::label('cuota', trans('form_periodo.lbnewsubscription', ['curso' => $nuevoCurso]),['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group" id="cuota">
                <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text('cuota', null,
                ['class' => 'form-control', 'name' => 'cuota', 'value' => old('cuota'),
                'placeholder' => trans('form_periodo.entersubscription')]) !!}
            </div>
        </div>
    </div>
@else
    @if($modo === 'view')
        @if ($curso->activo)
            <h6>{{ trans('message.datatodate') }}</h6>
        @endif
        <div class="form-group">
            {!! Form::label('cuota', trans('form_periodo.lbsubscription'),['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text(null, $curso->cuota,
                    ['class' => 'form-control', 'name' => 'cuota', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
        @if (!$curso->activo)
            <div class="form-group">
                {!! Form::label('ingresos', trans('form_periodo.lbincome'),['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text(null, $curso->ingresos,
                        ['class' => 'form-control', 'name' => 'ingresos', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('gastos', trans('form_periodo.lbexpenses'),['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text(null, $curso->gastos,
                        ['class' => 'form-control', 'name' => 'gastos', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('saldo', trans('form_periodo.lbbalance'),['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text(null, $curso->saldo,
                        ['class' => 'form-control', 'name' => 'saldo', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('totalsocios', trans('form_periodo.lbtotalpartners'),['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span> {!! Form::text(null, $curso->totalsocios,
                        ['class' => 'form-control', 'name' => 'totalsocios', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
            </div>
        @else
            <div class="form-group">
                {!! Form::label('ingresos', trans('form_periodo.lbincome_ast'),['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text(null, $totalIngresosPeriodo,
                        ['class' => 'form-control', 'name' => 'ingresos', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('gastos', trans('form_periodo.lbexpenses_ast'),['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text(null, $totalGastosPeriodo,
                        ['class' => 'form-control', 'name' => 'gastos', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('saldo', trans('form_periodo.lbbalance_ast'),['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text(null, $saldoPeriodo,
                        ['class' => 'form-control', 'name' => 'saldo', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('totalsocios', trans('form_periodo.lbtotalpartners_ast'),['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span> {!! Form::text(null, $totalSociosPeriodo,
                        ['class' => 'form-control', 'name' => 'totalsocios', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
            </div>
        @endif
    @endif
@endif