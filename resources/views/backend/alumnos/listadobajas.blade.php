@extends('backend.layouts.backend')

@component('backend.components.headerpage', [
    'icono_title' => 'fa fa-users',
    'trans_msg_title' => trans('message.membersbook'),
    'items' => [
        ['href' => '', 'icono' => 'fa fa-home', 'texto' => trans('message.home')],
        ['href' => '', 'icono' => 'fa fa-users', 'texto' => trans('message.membersbook')],
        ['href' => route('socios.listabajas') 'icono' => 'fa fa-times-rectangle', 'texto' => trans('message.unsubscribesmaintenance')],
        ['href' => '', 'icono' => 'fa fa-graduation-cap', 'texto' => trans('acciones_crud.children')],
        ],
    ])
@endcomponent

@section('content')
    <h3>{{ trans('message.childrenunscribedtext') }}</h3>
    <hr>
    @if (count($alumnosbajas) > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('cabecera_socios.id') }}</th>
                        <th>{{ trans('message.fullname') }}</th>
                        <th>{{ trans('message.birthyear') }}</th>
                        <th>{{ trans('acciones_crud.unscribeddate') }}</th>
                    </tr>
                </thead>
                @foreach ($alumnosbajas as $alumnosbaja)
                    <tbody>
                        <tr>
                            <td>{{ $alumnosbaja->id }}</td>
                            <td>{{ $alumnosbaja->nombre }}</td>
                            <td>{{ $alumnosbaja->anionacim }}</td>
                            <td>{{ $alumnosbaja->deleted_at }}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
            <p>{{ trans('message.totalchildrenunscribed') }}: {{ $alumnosbajas->count() }}</p>
        </div>
    @endif
@endsection
