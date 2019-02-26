<!-- Panel 5: Gestión -->
<div class="panel panel-primary">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a data-toggle="collapse" data-parent="#acordeon" href="#bloque5">
        <span class="icono_bloque fa fa-briefcase"></span>{{ trans('message.management') }}</a>
    </h4>
  </div>
  <div id="bloque5" class="panel-collapse collapse">
    @hasrole('Administrador')
      <div class="panel-body">
        <table class="table">
          @include('backend.includes.opciones_gestion_administrador')
          @include('backend.includes.opciones_gestion_administrar_socios')
          @include('backend.includes.opciones_gestion_administrar_reuniones')
        </table>
      </div>
    @else
      @hasrole('Presidente')
        <div class="panel-body">
          <table class="table">
            @include('backend.includes.opciones_gestion_administrar_socios')
            @include('backend.includes.opciones_gestion_administrar_reuniones')
          </table>
        </div>
      @else
        @hasrole('Secretario')
          <div class="panel-body">
            <table class="table">
              @include('backend.includes.opciones_gestion_administrar_socios')
              @include('backend.includes.opciones_gestion_administrar_reuniones')
            </table>
          </div>
        @endhasrole
      @endhasrole
    @endhasrole
  </div>
</div>
