<div class="form-group">
    {!! Form::hidden('id_acta', $acta->id) !!}
</div>
<div class="form-group">
    {!! Form::label(null, trans('form_reunion.lbmeetingdate')) !!}
    {!! Form::label(null, $acta->meeting->fechareunion, ['class' => 'control-label text-info']) !!}
</div>
<div class="form-group">
    {!! Form::label(null, trans('form_reunion.lbmeetingtype')) !!}
    {!! Form::label(null, $acta->meeting->meetingtype->tiporeunion, ['class' => 'control-label text-info']) !!}
</div>
<br><br>
<div class="form-group">
    {!! Form::file('documento_acta') !!}
</div>
