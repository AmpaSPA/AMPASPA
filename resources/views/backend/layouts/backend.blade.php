<!DOCTYPE html>
	<html lang="{{ app()->getLocale() }}">
		<!-- Layout para todas las páginas del backend y la pantalla de login de la aplicación -->
		<!-- ================================================================================= -->
		@include('includes.htmlhead')
		<body>
			<div class="container">
				<div class="row">
					<!-- Estructura de las páginas del backend -->
					@if(Auth::user())
						<!-- Menú superior -->
						@include('includes.topnavbar')
						<!-- Menú lateral -->
						<div class="col-md-3">
							@include('backend.includes.accordioncontent')
						</div>
						<!-- Contenido de la página -->
						<div class="col-md-9">
							<div id="app">
								<!-- Cabecera de página -->
								@include('backend.includes.pageheader')
								<!-- Cuerpo de página -->
								<div class="well">
									<p><h4 class="text-center textoazul">{{ trans('message.course') }} {{ $periodo->periodo }}</h4></p>
									<hr class="hrazul">
									@include('includes.errores')
									@yield('content')
								</div>
								<!-- Pie de página -->
								@include('includes.footerwrap')
							</div>
						</div>
					<!-- Página en blanco sin estructura para la pantalla de login -->
					@else
						@yield('content')
					@endif
				</div>
			</div>
			<script src="{{ asset('assets/js/backend/app.js') }}"></script>
			<script src="{{ asset('assets/js/backend/ampaspa.js') }}"></script>
			@stack('datepicker')
			@stack('timepicker')
			@stack('ckeditor')
			@stack('scripts')
			@yield('js')
		</body>
	</html>