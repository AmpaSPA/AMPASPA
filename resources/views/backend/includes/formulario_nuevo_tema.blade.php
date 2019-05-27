{!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => route('temas.nuevo'), 'novalidate' => 'novalidate']) !!}
    @include('backend.includes.campos_form_tema')
    <div class="form-group">
        <div class="col-md-12">
            <div class="pull-right">
                <button id="btnuevo" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-hashtag"></i>{{ trans('form_temas.addtopic') }}</button>
            </div>
        </div>
    </div>
{!! Form::close() !!}

@component('backend.components.ckeditor', [
    'field_id' => 'tema'
])
@endcomponent