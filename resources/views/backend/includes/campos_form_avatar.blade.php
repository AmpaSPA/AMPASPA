<div class="form-group">
    {!! Form::hidden('user_id', $profile->user_id) !!}
</div>
<div class="form-group">
    {!! Form::label(null, trans('socios.lbmail')) !!}
	{!! Form::label(null, Auth::user()->email, ['class' => 'control-label text-info']) !!},  
	{!! Form::label(null, trans('socios.lbdocnum')) !!}
	{!! Form::label(null, Auth::user()->numdoc, ['class' => 'control-label text-info']) !!}
</div>
<div class="form-group">
	{!! Form::label(null, trans('socios.lbphone')) !!}
	{!! Form::label(null, Auth::user()->telefono, ['class' => 'control-label text-info']) !!},
	{!! Form::label(null, trans('socios.lbpaymenttype')) !!}
	{!! Form::label(null, Auth::user()->paymenttype->tipopago, ['class' => 'control-label text-info']) !!}
</div>
<br>
<div class="form-group">
	{!! Form::label(null, trans('message.imageprofile'), ['class' => 'control-label']) !!}
</div>
<div class="form-group">
	{!! Form::file('avatar') !!}
</div>
