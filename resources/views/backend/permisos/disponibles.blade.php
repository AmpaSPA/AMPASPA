@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-key',
    'trans_msg_title' => trans('message.userspermissions'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => route('permisos.accounts'), 'icono' => 'fa fa-key', 'texto' => trans('message.userspermissions')],
        ['href' => '', 'icono' => 'fa fa-link', 'texto' => trans('acciones_crud.givepermission')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ $account->email }} <span class="textopequeño">@if(count($account->roles) > 0)({{ ($account->roles()->pluck( 'name' )->implode( ', ' )) }})@endif</span></h3>
    @if(count($account->roles) > 0)
        <div class="bg-primary">
            @foreach($permisos_rol as $permiso_rol)
                <p><strong>{{ trans('message.likerolyoucan', ['rol' => $permiso_rol['rol']]) }}</strong> {{ $permiso_rol['permisos'] }}.</p>
            @endforeach
            @if($permisos_usuario !== '')
                <p><strong>{{ trans('message.likeuseryoucan') }}:</strong> {{ $permisos_usuario }}.</p>
            @endif
        </div>
        <h6>{{ trans('message.availablepermissionstextuno') }} <strong>{{ trans('message.availablepermissionstextdos') }}</strong> {{ trans('message.availablepermissionstexttres') }} <strong>{{ $account->nombre }} {{ $account->apellidos }}</strong></h6>
    @else
        @if($permisos_usuario !== '')
            <div class="alert alert-info" role="alert">
                <p><strong>{{ trans('message.likeuseryoucan') }}:</strong> {{ $permisos_usuario }}.</p>
            </div>
            <h6>{{ trans('message.availablepermissionstextuno') }} <strong>{{ trans('message.availablepermissionstextuno') }}{{ trans('message.availablepermissionstextdos') }}</strong> {{ trans('message.availablepermissionstexttres') }} <strong>{{ $account->nombre }} {{ $account->apellidos }}</strong></h6>
        @else
            <h6><strong>{{ trans('message.permissions') }}</strong> {{ trans('message.availablepermissionstexttres') }} <strong>{{ $account->nombre }} {{ $account->apellidos }}</strong></h6>
        @endif
    @endif
    <hr class="hrazul">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ trans('cabecera_permisos.id') }}</th>
                    <th>{{ trans('cabecera_permisos.permission') }}</th>
                    <th>{{ trans('cabecera_permisos.actions') }}</th>
                </tr>
            </thead>
            @foreach ($permisos_disponibles as $permiso)
                <tbody>
                    <td>{{ $permiso['id'] }}</td>
                    <td>{{ $permiso['name'] }}</td>
                    <td>
                        <i class="text-success fa fa-check"></i><a href="{{ url('backend/permisos/'.$account->id.'/attach', $permiso['id']) }}"><span class="text-success texto-accion">{{  trans('acciones_crud.select') }}</span></a>
                    </td>
                </tbody>
            @endforeach
            <tfoot>
                <tr>
                    <th>{{ trans('cabecera_permisos.id') }}</th>
                    <th>{{ trans('cabecera_permisos.permission') }}</th>
                    <th>{{ trans('cabecera_permisos.actions') }}</th>
                </tr>
            </tfoot>
        </table>
        <p>{{ trans('message.totalpermissions') }}: {{ count($permisos_disponibles) }}</p>
    </div>
@endsection
