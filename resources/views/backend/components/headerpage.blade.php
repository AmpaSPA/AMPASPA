@section('titleheader')
    <i class="{{ $icono_title }}"></i> {{ $trans_msg_title }}
@endsection

@component('backend.components.breadcrumb')
    @slot('li')
        @foreach ($items as $item)
            @if ($loop->iteration == count($items) - 1)
                <li><i class="{{ $item['icono'] }}"></i><a href="{{ $item['href'] }}">{{ $item['texto'] }}</a></li>
            @else
                <li><i class="{{ $item['icono'] }}"></i>{{ $item['texto'] }}</li>
            @endif
        @endforeach
    @endslot
@endcomponent
