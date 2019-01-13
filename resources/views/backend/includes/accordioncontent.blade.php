<!-- Estructura del menú lateral -->

<div class="panel-group" id="acordeon">
    <!-- Opción: Contenido web -->
  @hasrole('Administrador')
    @include('backend.includes.panelcontenidoweb')
  @endhasrole

  <!-- Opción: Año académico -->
  @hasanyrole('Administrador|Secretario|Tesorero')
    @include('backend.includes.panelanioacademico')
    @include('backend.includes.panellibros')
  @endhasrole
  <!-- Opción: Consultas -->
  @include('backend.includes.panelconsultas')
    <!-- Opción: Foro -->
  @include('backend.includes.panelforo')
  <!-- Opción: Gestión -->
  @hasrole('Administrador')
    @include('backend.includes.panelgestion')
  @else
    @can('Administrar socios')
      @include('backend.includes.panelgestion')
    @endcan
  @endhasrole
</div>
