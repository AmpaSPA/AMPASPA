{!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'url' => route('asistentes.nuevo'), 'novalidate' => 'novalidate']) !!}
    @include('backend.includes.campos_form_asistente')
    <div class="form-group">
        <div class="col-md-12">
            <div class="pull-right">
                <button id="btnuevo" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-user-plus"></i>{{ trans('form_asistentes.addattendee') }}</button>
            </div>
        </div>
    </div>
{!! Form::close() !!}