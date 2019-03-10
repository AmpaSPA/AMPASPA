<div class="form-group">
        {!! Form::hidden('topic_id', $tema->id) !!}
        {!! Form::hidden('reunion_id', $reunion_id) !!}
</div>
@if ($modo === 'new')
    <div class="form-group">
        <div class="col-md-12">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-thumbs-o-up"></i></span> {!! Form::textarea('acuerdo', null, ['class'
            => 'form-control', 'rows' => '4', 'name' => 'acuerdo', 'required' => 'required','autofocus' => 'autofocus',
            'placeholder' => trans('form_acuerdos.enteragreement')]) !!}
          </div>
        </div>
    </div>
@else
    @if ($modo === 'update')
        <div class="form-group">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-thumbs-o-up"></i></span> {!! Form::textarea('acuerdo', null, ['class'
                    => 'form-control', 'rows' => '4', 'name' => 'acuerdo', 'value' => old('acuerdo'),'autofocus' => 'autofocus',
                    'placeholder' => trans('form_acuerdos.enteragreement')]) !!}
                </div>
            </div>
        </div>
    @endif
@endif
