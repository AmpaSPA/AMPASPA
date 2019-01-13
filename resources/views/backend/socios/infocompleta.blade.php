@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
      'icono_title' => 'fa fa-users',
      'trans_msg_title' => trans('message.membersbook'),
      'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
        ['href' => route('socios.ver', $socio->id), 'icono' => 'fa fa-eye', 'texto' => trans('acciones_crud.view')],
        ['href' => '', 'icono' => 'fa fa-user', 'texto' => trans('message.profile')],
        ],
    ])
@endcomponent

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/assets/images/uploads/{{ $profile->id }}/avatars/{{ $profile->avatar }}" class="avatar">
            <h4>{{ $socio->nombre }} {{ $socio->apellidos }}</h4>
            {{ Form::model($profile, ['method' => 'POST', 'url' => url('backend/profile/update/info', $socio->id)]) }}
                @include('backend.includes.campos_form_infocompleta')
            {{ Form::close() }}
        </div>
    </div>
@endsection
