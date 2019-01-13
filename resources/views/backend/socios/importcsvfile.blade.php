@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
      'icono_title' => 'fa fa-users',
      'trans_msg_title' => trans('message.membersbook'),
      'items' => [
            ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
            ['href' => route('socios.list'), 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
            ['href' => '', 'icono' => 'fa fa-file-excel-o', 'texto' => trans('message.massaddmembers')],
        ],
    ])
@endcomponent

@section('content')
    <div class="bg-danger text-danger">
        <h4 class="alert-heading"><strong>{{ trans('message.important') }}</strong></h4>
        <p>{{ trans('message.importanttextuno') }}</p>
        <p>{{ trans('message.importanttextdos') }}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ trans('message.importanttextdosuno') }}</strong></p>
        <p>{{ trans('message.importanttexttres') }}</p>
        <p>{{ trans('message.importanttextcuatro') }}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ trans('message.importanttextcuatrouno') }}</strong></p>
        <p class="text-center">{{ trans('message.importanttextcuatrodos') }}</p>
    </div>
    <div class="itemdoc">
        <p><strong>{{ trans('message.importanttextcuatrotres') }}</strong></p>
        {{ Form::open(['method' => 'POST', 'url' => url('backend/socios/altamasiva'), 'enctype' => 'multipart/form-data']) }}
            {!! Form::file('csvfile', ['class' => 'center-block']) !!}
            <button id="btimportcsv" type="submit" class="btn btn-primary"><i class="fa fa-download"></i>{{ trans('message.importcsvfile') }}</button>
        {!! Form::close() !!}
    </div>
@endsection
