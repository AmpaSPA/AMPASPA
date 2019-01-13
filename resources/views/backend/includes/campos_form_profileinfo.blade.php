<div class="form-group">
  {!! Form::hidden('user_id', $profile->user_id) !!}
</div>
<p><strong>{{ trans('message.enterinformationtext')}}:</strong></p><br><br><br>
<div class="form-group">
  {!! Form::label('bio', trans('socios.lbbiography'), ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-book"></i></span>
      {!! Form::textarea('bio', $profile->bio, ['class' => 'form-control', 'name' => 'bio', 'autofocus' => 'autofocus']) !!}
    </div>
  </div>
</div>
<div class="form-group">
{!! Form::label('profesion', trans('socios.lbjob'),['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
      {!! Form::text('profesion', $profile->profesion, ['class' => 'form-control', 'name' => 'profesion']) !!}
    </div>
  </div>
</div>
<div class="form-group">
{!! Form::label('aficiones', trans('socios.lbhobbies'), ['class' => 'col-md-2 control-label']) !!}
  <div class="col-md-10">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-heart"></i></span>
      {!! Form::textarea('aficiones', $profile->aficiones, ['class' => 'form-control', 'name' => 'aficiones']) !!}
    </div>
  </div>
</div>