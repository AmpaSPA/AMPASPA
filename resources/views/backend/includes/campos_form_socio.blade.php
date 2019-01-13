  @if($modo === 'update' || $modo === 'new')
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
      {!! Form::label('tiposocio', trans('socios.lbmembertype'), ['class' => 'col-md-4 control-label']) !!}
      <div class="col-md-6">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-tag"></i></span>
          {!! Form::select('membertype_id', $tsocios, null, ['class' => 'form-control', 'placeholder' => trans('message.entermembertype')]) !!}
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
    @if($modo === 'new')
      <div class="form-group">
        {!! Form::label('email', trans('socios.lbmail'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            {!! Form::email('email', null, ['class' => 'form-control', 'name' => 'email', 'value' => old('email'), 'placeholder' => trans('message.enteremail')]) !!}
          </div>
        </div>
      </div>
    @endif
  @else
    @if($modo === 'view')
      <div class="form-group">
        {!! Form::label('nombre', trans('socios.lbfname'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            {!! Form::label('nombre', $socio->nombre, ['class' => 'form-control', 'name' => 'nombre']) !!}
          </div>
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('apellidos', trans('socios.lblname'),['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            {!! Form::label('apellidos', $socio->apellidos, ['class' => 'form-control', 'name' => 'apellidos']) !!}
          </div>
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('email', trans('socios.lbmail'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            {!! Form::label('email', $socio->email, ['class' => 'form-control', 'name' => 'email']) !!}
          </div>
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('telefono', trans('socios.lbphone'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            {!! Form::label('telefono', $socio->telefono, ['class' => 'form-control', 'name' => 'telefono']) !!}
          </div>
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('doctype', trans('socios.lbdoctype'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
            {!! Form::label('doctype', $sociotipodoc, ['class' => 'form-control', 'name' => 'doctype']) !!}
          </div>
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('numdoc', trans('socios.lbdocnum'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
            {!! Form::label('numdoc', $socio->numdoc, ['class' => 'form-control', 'name' => 'numdoc']) !!}
          </div>
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('membertype', trans('socios.lbmembertype'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
            {!! Form::label('membertype', $sociotipo, ['class' => 'form-control', 'name' => 'membertype']) !!}
          </div>
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('paymenttype', trans('socios.lbpaymenttype'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-euro"></i></span>
            {!! Form::label('paymenttype', $pagotipo, ['class' => 'form-control', 'name' => 'paymenttype']) !!}
          </div>
        </div>
      </div>
    @endif
  @endif