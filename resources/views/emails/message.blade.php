@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
AMPA Colegio San Pedro apóstol
@endcomponent
@endslot

![AMPASPAB][logo]

{{-- Body --}}
{{ $slot }}

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
@endcomponent
@endslot

[logo]: https://ampasanpedroblog.files.wordpress.com/2017/01/logoampa.png?w=676
@endcomponent
