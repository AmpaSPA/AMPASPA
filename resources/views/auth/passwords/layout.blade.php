<!DOCTYPE html>
<html lang="es">
  @include('auth.passwords.includes.head')
  <body>
    <div class="container">
      <div class="col-md-12">
        @include('auth.passwords.includes.topnavbar')
        @include('backend.includes.pageheader')
        <div class="well">
          @yield('content')
        </div>
      </div>
      <div class="col-md-12">
        <div id="c">
          <div class="container">
            @if (Auth::user())
              @include('includes.footer_comun_auxiliar')
            @else
              @include('includes.footer_comun_principal')
            @endif
          </div>
        </div>
      </div>
    </div>
  </body>
</html>