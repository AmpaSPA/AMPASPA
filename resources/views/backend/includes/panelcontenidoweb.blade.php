  <!-- Panel 0: Contenido web -->
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#acordeon" href="#bloque0">
          <span class="icono_bloque fa fa-globe"></span>{{ trans('message.web') }}</a>
      </h4>
    </div>
    <div id="bloque0" class="panel-collapse collapse ">
      <div class="panel-body">
        <table class="table">
          <tr>
            <td id="celda_bloque_icono"><span class="fa fa-image text-primary"></span></td>
            <td id="celda_bloque_texto"><a href="#">{{ trans('message.images') }}</a></td>
          </tr>
          <tr>
            <td id="celda_bloque_icono"><span class="fa fa-cubes text-primary"></span></td>
            <td id="celda_bloque_texto"><a href="#">{{ trans('message.contentourampa') }}</a></td>
          </tr>
          <tr>
            <td id="celda_bloque_icono"><span class="fa fa-briefcase text-primary"></span></td>
            <td id="celda_bloque_texto"><a href="#">{{ trans('message.contentprojects') }}</a></td>
          </tr>
          <tr>
            <td id="celda_bloque_icono"><span class="fa fa-group text-primary"></span></td>
            <td id="celda_bloque_texto"><a href="#">{{ trans('message.contentmembers') }}</a></td>
          </tr>
        </table>
      </div>
    </div>
  </div>