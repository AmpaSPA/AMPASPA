@if($modo === 'update' || $modo === 'new')
    <div class="form-group">
        {!! Form::label('fecha', trans('form_factura.lbinvoicedate'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group" id="fecha">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> {!! Form::text('fecha', null,
                ['readonly' => 'readonly', 'class' => 'form-control datepicker', 'name' => 'fecha', 'value' => old('fecha'),
                'placeholder' => trans('form_factura.enterinvoicedate')]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('emisor', trans('form_factura.lbfrom'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-o"></i></span> {!! Form::text('emisor', null, ['class' => 'form-control',
                'name' => 'emisor', 'value' => old('emisor'),'autofocus' => 'autofocus', 'placeholder' => trans('form_factura.enterfrom')])
                !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('destinatario', trans('form_factura.lbto'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> {!! Form::text('destinatario', null, ['class' => 'form-control',
                'name' => 'destinatario', 'value' => old('destinatario'),'autofocus' => 'autofocus', 'placeholder' => trans('form_factura.enterto')])
                !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('concepto', trans('form_factura.lbitem'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tags"></i></span> {!! Form::text('concepto', null, ['class' => 'form-control',
                'name' => 'concepto', 'value' => old('concepto'),'autofocus' => 'autofocus', 'placeholder' => trans('form_factura.enteritem')])
                !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('importe', trans('form_factura.lbamount'), ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text('importe', null, ['class' =>
                'form-control', 'name' => 'importe', 'value' => old('importe'),'autofocus' => 'autofocus', 'placeholder' => trans('form_factura.enteramount')])
                !!}
            </div>
        </div>
    </div>
@else
    @if($modo === 'view')
        <div class="form-group">
            {!! Form::label('fecha', trans('form_factura.lbinvoicedate') ,['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> {!! Form::text(null, $item->fecha,
                    ['class' => 'form-control', 'name' => 'fecha', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('emisor', trans('form_factura.lbfrom'), ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user-o"></i></span> {!! Form::text(null, $item->emisor,
                    ['class' => 'form-control', 'name' => 'emisor', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('destinatario', trans('form_factura.lbto'), ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> {!! Form::text(null, $item->destinatario,
                    ['class' => 'form-control', 'name' => 'destinatario', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('concepto', trans('form_factura.lbitem'), ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tags"></i></span> {!! Form::text(null, $item->concepto,
                        ['class' => 'form-control', 'name' => 'concepto', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('importe', trans('form_factura.lbamount'), ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-euro"></i></span> {!! Form::text(null, $item->importe,
                    ['class' => 'form-control', 'name' => 'importe', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
    @endif
@endif