  <!-- Panel 1: Año académico -->
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#acordeon" href="#bloque1">
          <span class="icono_bloque fa fa-calendar"></span>{{ trans('message.academicyear') }}</a>
      </h4>
    </div>
    <div id="bloque1" class="panel-collapse collapse ">
      <div class="panel-body">
        <table class="table">
          @if ($mes >= 9 & $mes <= 11)
            <tr>
              <td id="celda_bloque_icono"><span class="fa fa-calendar-plus-o text-primary"></span></td>
              <td id="celda_bloque_texto"><a href="#">{{ trans('message.open') }} curso {{ $anio }}-{{ $anio + 1 }}</a></td>
            </tr>
            <tr>
              <td id="celda_bloque_icono"><span class="fa fa-calendar-minus-o text-primary"></span></td>
              <td id="celda_bloque_texto"><a href="#">{{ trans('message.close') }} curso {{ $anio - 1 }}-{{ $anio }}</a></td>
            </tr>
          @else
            <tr>
              <td id="celda_bloque_icono"><span class="fa fa-calendar-plus-o text-primary"></span></td>
              <td id="celda_bloque_texto"><a class="disabled">{{ trans('message.open') }} curso {{ $anio }}-{{ $anio + 1 }}</a></td>
            </tr>
            <tr>
              <td id="celda_bloque_icono"><span class="fa fa-calendar-minus-o text-primary"></span></td>
              <td id="celda_bloque_texto"><a class="disabled">{{ trans('message.close') }} curso {{ $anio - 1 }}-{{ $anio }}</a></td>
            </tr>
          @endif
        </table>
      </div>
    </div>
  </div>