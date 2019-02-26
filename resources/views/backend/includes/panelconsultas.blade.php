  <!-- Panel 3: Consultas -->
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#acordeon" href="#bloque3">
          <span class="icono_bloque fa fa-question-circle"></span>{{ trans('message.queries') }}</a>
      </h4>
    </div>
    <div id="bloque3" class="panel-collapse collapse">
      <div class="panel-body">
        @hasanyrole('Administrador|Presidente')
          <table class="table">
            @include('backend.includes.panelconsultasopcomunes')
            <tr>
              <td id="celda_bloque_icono"><span class="fa fa-euro text-primary"></span></td>
              <td id="celda_bloque_texto"><a href="#">{{ trans('message.accounts') }}</a></td>
            </tr>
            <tr>
              <td id="celda_bloque_icono"><span class="fa fa-list-alt text-primary"></span></td>
              <td id="celda_bloque_texto"><a href="#">{{ trans('message.proceedings') }}</a></td>
            </tr>
            <tr>
              <td id="celda_bloque_icono"><span class="fa fa-users text-primary"></span></td>
              <td id="celda_bloque_texto"><a href="#">{{ trans('message.members') }}</a></td>
            </tr>
          </table>
        @else
          @hasrole('Tesorero')
           <table class="table">
              @include('backend.includes.panelconsultasopcomunes')
              <tr>
                <td><span class="fa fa-euro text-primary"></span></td>
                <td><a href="#">{{ trans('message.accounts') }}</a></td>
              </tr>
              <tr>
                <td><span class="fa fa-users text-primary"></span></td>
                <td><a href="#">{{ trans('message.members') }}</a></td>
              </tr>
            </table>
          @else
            @hasrole('Secretario')
              <table class="table">
                @include('backend.includes.panelconsultasopcomunes')
                <tr>
                  <td><span class="fa fa-list-alt text-primary"></span></td>
                  <td><a href="#">{{ trans('message.proceedings') }}</a></td>
                </tr>
                <tr>
                  <td><span class="fa fa-users text-primary"></span></td>
                  <td><a href="#">{{ trans('message.members') }}</a></td>
                </tr>
              </table>
            @else
              @hasanyrole('Vocal|Socio')
                <table class="table">
                  @include('backend.includes.panelconsultasopcomunes')
                </table>
              @endhasrole
            @endhasrole
          @endhasrole
        @endhasrole
      </div>
    </div>
  </div>