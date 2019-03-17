<header>
  <nav id="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        @if(Auth::user())
          <img class="img-responsive" alt="AMPA-SPAB" src="{{ asset('assets/images/logoampaweb.png') }}">
        @else
          <a class="navbar-brand" href="{{ url('/') }}"><img class="img-responsive" alt="AMPA-SPAB" src="{{ asset('assets/images/logoampaweb.png') }}"></a>
        @endif
      </div>
      <div class="collapse navbar-collapse">
        @if (Auth::user())
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="avatarbtnmenu"></span>
                <img src="/assets/images/uploads/{{ Auth::user()->profile->user_id }}/avatars/{{ Auth::user()->profile->avatar }}" class="logoavatar">{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}<span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a class="disabled textopequeño"><i class="fa fa-envelope textoazul" aria-hidden="true"></i><span class="textoazul">{{ Auth::user()->email }}</span></a></li>
                <li><hr></li>
                @if (Auth::user()->roles()->pluck( 'name' )->implode( ', ' ) <> '')
                  <li><a class="textopequeño" href="{{ URL::route('profile.home',Auth::user()->id) }}"><i class="fa fa-id-card textoazul" aria-hidden="true"></i>{{ trans('message.profile') }}: <span class="textoazul">{{ Auth::user()->roles()->pluck( 'name' )->implode( ', ' ) }}</span></a></li>
                @else
                  <li><a class="textopequeño" href="{{ URL::route('profile.home',Auth::user()->id) }}"><i class="fa fa-id-card textoazul" aria-hidden="true"></i>{{ trans('message.profile') }}: <span class="textoazul">{{ trans('message.withoutprofile') }}</span></a></li>
                @endif

                <li><a class="textopequeño" href="http://www.madrid.org/cs/Satellite?cid=1167899197736&pagename=PortalEducacion%2FPage%2FEDUC_contenidoFinal" target="_blank"><i class="fa fa-calendar textoazul" aria-hidden="true"></i>{{ trans('message.schoolcalendar') }} {{ $periodo->periodo }}</a></li>
                <li><hr></li>
                <li><a class="disabled textopequeño"><i class="fa fa-language textoazul" aria-hidden="true"></i>{{ trans('message.litlanguage') }} @if ($idioma == 'Castellano')<img src="/assets/images/flags/es.png">@else<img src="/assets/images/flags/gb.png">@endif {{ $idioma }}</a></li>
                <li><hr></li>
                <li>
                  <a class="textopequeño" href="{{ url('/logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <strong><i class="fa fa-sign-out text-danger" aria-hidden="true"></i></strong><span class="text-danger"><strong>{{ trans('message.signout') }}</strong></span>
                  </a>
                  <form class="oculto" id="logout-form" action="{{ url('/logout') }}" method="POST">
                    {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </li>
          </ul>
        @else
          <ul class="nav navbar-nav">
            <li class="active"><a href="/#inicio" class="smoothScroll"><i class="fa fa-home"></i>Inicio</a></li>
            <li><a href="/#ourampa" class="smoothScroll">Nuestra AMPA</a></li>
            <li><a href="/#miembros" class="smoothScroll">Soci@s</a></li>
            <li><a href="/#proyectos" class="smoothScroll">Proyectos</a></li>
            <li><a href="/#formularios" class="smoothScroll">Formularios</a></li>
            <li><a href="/#contact" class="smoothScroll">Contacto</a></li>
            <li><a href="https://ampasanpedroblog.wordpress.com/" target="_blank"><i class="fa fa-wordpress fa-lg"></i>Nuestro blog</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href= {{ url('/login') }}><i class="fa fa-sign-in"></i>{{ trans('message.myampa') }}</a></li>
            <li><a href="https://goo.gl/forms/QbSzlZaWznRLMX5y2" target="_blank"><i class="fa fa-pencil"></i>{{ trans('message.register') }}</a> </li>
          </ul>
        @endif
      </div>
    </div>
  </nav>
</header>