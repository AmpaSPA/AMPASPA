@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-id-card',
    'trans_msg_title' => trans('message.profile'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('profile.home', Auth::user()->id), 'icono' => 'fa fa-id-card', 'texto' => trans('message.profile')],
        ['href' => '', 'icono' => 'fa fa-address-card', 'texto' => trans('message.aboutyou')],
        ],
    ])
@endcomponent

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/assets/images/uploads/{{ $profile->id }}/avatars/{{$profile->avatar }}" class="avatar">
            <h4>{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h4>
            {{ Form::model($profile, ['method' => 'POST', 'url' => url('backend/profile/update/info', Auth::user()->id)]) }}
                @include('backend.includes.campos_form_profileinfo')
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button id="btnuevo" type="submit" class="btn btn-primary"><i class="fa fa-address-card" aria-hidden="true"></i>{{ trans('message.changeprofileinfo') }}</button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>

    @component('backend.components.ckeditor', [
        'field_id' => 'bio'
    ])
    @endcomponent

    @component('backend.components.ckeditor', [
        'field_id' => 'aficiones'
    ])
    @endcomponent
@endsection
