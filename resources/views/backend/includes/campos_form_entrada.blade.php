@if($modo === 'update' || $modo === 'new')
    <div class="form-group">
        {!! Form::label('fecha', trans('form_entrada.lbentrydate'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group" id="fecha">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> {!! Form::text('fecha', null,
                ['readonly' => 'readonly', 'class' => 'form-control datepicker', 'name' => 'fecha', 'value' => old('fecha'),
                'placeholder' => trans('form_entrada.enterentrydate')]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('tipo', trans('form_entrada.lbentrytype'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-refresh"></i></span> {!! Form::select('tipo', ['Ingreso', 'Gasto'],
                null, ['class' => 'form-control', 'placeholder' => trans('form_entrada.enterentrytype')]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('descripcion', trans('form_entrada.lbdescription'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> {!! Form::textarea('descripcion', null, ['class'
                => 'form-control', 'rows' => '4', 'name' => 'descripcion', 'value' => old('descripcion'),'autofocus' => 'autofocus',
                'placeholder' => trans('form_entrada.enterdescription')]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('factura', trans('form_entrada.lbinvoice'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-barcode"></i></span> {!! Form::select('id', $facturas,
            null, ['class' => 'form-control', 'name' => 'factura', 'autofocus' => 'autofocus', 'placeholder'
                => trans('form_entrada.enterinvoice')]) !!}
          </div>
        </div>
      </div>
@else
    @if($modo === 'view')
        <div class="form-group">
            {!! Form::label('fecha', trans('form_entrada.lbentrydate') ,['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> {!! Form::text(null, $item->fecha,
                    ['class' => 'form-control', 'name' => 'fecha', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('tipo', trans('form_entrada.lbentrytype'), ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-refresh"></i></span> {!! Form::text(null, $item->tipo,
                    ['class' => 'form-control', 'name' => 'tipo', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('descripcion', trans('form_entrada.lbdescription'), ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> {!! Form::textarea(null, $item->descripcion,
                    ['class' => 'form-control', 'name' => 'descripcion', 'rows' => '4', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
    @endif
@endif