<p><strong>{{ trans('message.profileinformationsharedtext')}}:</strong></p><br><br><br>
<div class="tituloinfo">{{ trans('message.biography') }}</div>
{!! Form::label(null, $profile->bio, ['name' => 'bio']) !!}
<div class="tituloinfo">{{ trans('message.job') }}</div>
{!! Form::label(null, $profile->profesion, ['name' => 'profesion']) !!}
<div class="tituloinfo">{{ trans('message.hobbies') }}</div>
{!! Form::label(null, $profile->aficiones, ['name' => 'aficiones']) !!}
<div class="tituloinfo">{{ trans('message.childrenstudying') }}</div>
@if (count($hijos) > 0)
  @foreach ($hijos as $hijo)
      <strong>{{ $hijo->nombre }} ({{ $hijo->anionacim }}).</strong><br>
  @endforeach
@endif