<!-- Panel 5: Gestión -->
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#acordeon" href="#bloque4">
        <span class="icono_bloque fa fa-briefcase"></span>{{ trans('message.management') }}</a>
        </h4>
    </div>
    <div id="bloque4" class="panel-collapse collapse">
        @hasrole('Administrador')
            <div class="panel-body">
                <table class="table">
                    @include('backend.includes.opciones_gestion_administrador')
                    @include('backend.includes.opciones_gestion_administrar_socios')
                    @include('backend.includes.opciones_gestion_administrar_reuniones')
                    @include('backend.includes.opciones_gestion_administrar_cursos')
                </table>
            </div>
        @else
            @hasanyrole('Presidente|Secretario')
                <div class="panel-body">
                    <table class="table">
                        @include('backend.includes.opciones_gestion_administrar_socios')
                        @include('backend.includes.opciones_gestion_administrar_reuniones')
                    </table>
                </div>
            @else
                @hasrole('Tesorero')
                    <div class="panel-body">
                        <table class="table">
                            @include('backend.includes.opciones_gestion_administrar_cursos')
                        </table>
                    </div>
                @else
                    @can('Administrar socios')
                        @include('backend.includes.opciones_gestion_administrar_socios')
                    @endcan
                @endhasrole
            @endhasrole
        @endhasrole
    </div>
</div>