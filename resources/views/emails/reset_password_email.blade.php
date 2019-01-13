@component('mail::layout')

  {{-- Header --}}
  @slot('header')
    @component('mail::header', ['url' => config('app.url')])
      {{ config('app.name') }}
    @endcomponent
  @endslot

  {{-- Greeting --}}
  @if (! empty($greeting))
    # {{ $greeting }}
  @else
    @if ($level === 'error')
    # Whoops!
    @else
    # Hola!
    @endif
  @endif

  {{-- Intro Lines --}}
  @foreach ($introLines as $line)
    {{ $line }}
  @endforeach

  {{-- Action Button --}}
  @component('mail::button', ['url' => $actionUrl, 'color' => 'blue'])
    {{ $actionText }}
  @endcomponent

  {{-- Outro Lines --}}
  @foreach ($outroLines as $line)
    {{ $line }}
  @endforeach

  {{-- Salutation --}}
  @if (! empty($salutation))
    {{ $salutation }}
  @else
    Saludos,<br>{{ config('app.name') }}
  @endif

  {{-- Subcopy --}}
  @isset($actionText)
    @slot('subcopy')
      @component('mail::subcopy')
        Si tienes algún problema tras hacer click en el botón "{{ $actionText }}", copia y pega la siguiente URL en tu navegador: [{{ $actionUrl }}]({{ $actionUrl }})
      @endcomponent
    @endslot
  @endisset

  {{-- Footer --}}
  @slot('footer')
    @component('mail::footer')
      © {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
    @endcomponent
  @endslot

@endcomponent



