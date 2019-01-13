<section id="contact"></section>
@if (!Auth::user())
  <div id="footerwrap">
    <div class="container">
      <div class="col-lg-4">
        <h3>{{ trans('message.address') }}</h3>
        <p><i class="fa fa-map"></i>Calle Babilonia, 19, Madrid 28042 (Barajas)</p>
        <p><i class="fa fa-phone fa-lg"></i>91 305 56 05</p>
        <p><a href="https://www.google.es/maps/place/Calle+Babilonia,+19,+28042+Madrid/@40.4675299,-3.5904234,17z/data=!3m1!4b1!4m5!3m4!1s0xd422e25862aeb2b:0x67fa262ed5ccef5c!8m2!3d40.4675299!4d-3.5882347" target="_blank"><i class="fa fa-map-marker fa-lg"></i>{{ trans('message.googlemaps') }}</a></p>
      </div>
      <div class="col-lg-3">
        <h3>Redes sociales</h3>
        <p>Siguenos también en:</p>
        <a href="https://www.facebook.com/pages/Colegio-San-Pedro-Ap%C3%B3stol/111671842246280" target="_blank"><i class="fa fa-facebook fa-lg"></i></a><a href="https://twitter.com/@Ampa_SanPedro" target="_blank"><i class="fa fa-twitter fa-lg"></i></a><a href="#"><i class="fa fa-youtube fa-lg"></i></a>
      </div>
      <div class="col-lg-5">
        <h3>{{ trans('contacto.dropus') }}</h3>
        <p><a href="{{ url('contacto') }}"><i class="fa fa-envelope fa-lg"></i>ampa@senpedroapostol.es</a></p>
      </div>
    </div>
  </div>
@endif
<div id="c">
  <div class="container">
    @if (Auth::user())
      @include('includes.footer_comun_auxiliar')
    @else
      @include('includes.footer_comun_principal')
    @endif
  </div>
</div>