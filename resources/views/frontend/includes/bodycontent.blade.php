<!-- Carrusel fotográfico -->
<section id="inicio">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicadores: tantos como fotos -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Fotos: clase item, tantos como indicadores -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <a href="http://www.sanpedroapostol.es" target="_blank"><img src="assets/images/uploads/slider/imagen_portada_web.jpg" alt="AMPA SPAB"></a>
        <div class="carousel-caption">
          <h3>Más que un centro educativo, un verdadero lugar de encuentro entre lo cultural y lo participativo, donde familias, profesaorado y alumnos trabajan juntos para lograrlo</h3>
          <a href="http://www.sanpedroapostol.es" target="_blank"><strong>Entra y verás...</strong></a>
        </div>
      </div>

      <div class="item">
        <a href="#" target="_blank"><img src="assets/images/uploads/slider/consejoescolar.jpeg" alt="AMPA SPAB"></a>
        <div class="carousel-caption">
          <h3>Nuestro Consejo escolar, en estrecha colaboración con el Colegio, una herramienta eficiente y eficaz</h3>
          <a href="#" target="_blank"><strong>Entra e infórmate...</strong></a>
        </div>
      </div>
    </div>

    <!-- Flechas para desplazamiento -->
    <!-- Flecha a la izquierda -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="fa fa-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <!-- Flecha a la derecha -->
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="fa fa-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</section>
<!-- Sección de bienvenida -->
<section id="saludo">
  <div id="cajasaludo" class="container text-center">
    <h2>Bienvenid@ a la AMPA del colegio diocesano San Pedro Apóstol</h2>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default">
          <div class="panel-body text-justify">
            {{ trans('message.wellcometext') }}
            <a href="https://goo.gl/forms/QbSzlZaWznRLMX5y2" target="_blank"><img class="img-responsive center-block registrate" src="assets/images/registrate.png" alt="REGISTRATE"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Sección de contenido -->
<section id="desc">
  <div class="container text-center">
    <!-- Caja Nuestro AMPA -->
    <div id="ourampa">
      <h3>Nuestra AMPA</h3><br>
      <div class="row">
        <div class="col-sm-3">
          <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
            <div id="estatutos" class="panel panel-warning">
              <div class="panel-heading" role="tab" id="headingOne"><a role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><img class="img-responsive center-block" src="/assets/images/estatutos.png" alt="ESTATUTOS" data-toggle="tooltip" data-placement="top" title="Haz click para desplegar"></a><h4 class="panel-title"><b>Estatutos</b></h4></div>
              <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                </div>
              </div>
              <div class="panel-footer">
                <p class="text-center">Échales un vistazo <a href="#"><b>aquí</b></a>.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
            <div id="junta" class="panel panel-warning">
              <div class="panel-heading" role="tab" id="headingTwo"><a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><img class="img-responsive center-block" src="/assets/images/junta_directiva.png" alt="J DIRECTIVA" data-toggle="tooltip" data-placement="top" title="Haz click para desplegar"></a><h4 class="panel-title"><b>Junta directiva</b></h4></div>
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                  <P class="text-left">La Junta Directiva de nuestro AMPA está formada por un gran equipo humano que con toda la ilusión del mundo prestan parte de su tiempo para ponerse al servicio de la Comunidad Educativa colaborando con el colegio en la formación integral de nuestros hijos.</P>
                </div>
              </div>
              <div class="panel-footer">
                <p>Pincha <a href="#"><b>aquí</b> </a>para conocerles.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="panel-group" id="accordion3" role="tablist" aria-multiselectable="true">
            <div id="participa" class="panel panel-warning">
              <div class="panel-heading" role="tab" id="headingThree"><a role="button" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree"><img class="img-responsive center-block" src="/assets/images/participa.png" alt="PARTICIPA" data-toggle="tooltip" data-placement="top" title="Haz click para desplegar"></a><h4 class="panel-title"><b>¡¡ Participa !!</b></h4></div>
              <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                </div>
              </div>
              <div class="panel-footer">
                <p class="text-center">Elige una de nuestras <a href="#"><b>comisiones</b></a>.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="panel-group" id="accordion4" role="tablist" aria-multiselectable="true">
            <div id="actividades" class="panel panel-warning">
              <div class="panel-heading" role="tab" id="headingFour"><a role="button" data-toggle="collapse" data-parent="#accordion4" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour"><img class="img-responsive center-block" src="/assets/images/actividades.png" alt="ACTIVIDADES" data-toggle="tooltip" data-placement="top" title="Haz click para desplegar"></a><h4 class="panel-title"><b>Actividades</b></h4></div>
              <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                  <P class="text-justify">
                    Estas son algunas de nuestras propuestas:
                  </P>
                </div>
              </div>
              <div class="panel-footer">
                <p class="text-center">Te las mostramos en detalle <a href="#"><b>aquí</b></a>.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Caja Socios -->
    <div id="miembros">
      <h3>Soci@s</h3><br>
      <div class="row">
        <div class="col-sm-6">
          <div id="nuevosocio" class="panel panel-default">
            <div class="panel-heading"><img id="imgpanelsocio" class="img-responsive center-block" src="assets/images/nuevosocio.png" alt="REGISTRATE"></div>
            <div class="panel-body text-left">
              <p>Si quieres formar parte del AMPA te lo ponemos fácil ya que puedes elegir entre:</p>
              <ul>
                <li><p><a href="#">Descargar</a> y rellenar el formulario de inscripción y hacernoslo llegar dejándolo en la Secretaría del cole a nuestra atención.</p></li>
                <li><p>Decidirte ahora y hacer click sobre este enlace de <a href="#">registro</a>.</p></li>
                <li><p>O puedes dejarlo para luego y registrarte eligiendo la opción situada en el menú principal o incluso haciendo click en la imagen de la bienvenida en la sección <a class="smoothScroll" href="#inicio">Inicio</a>.</p></li>
              </ul>
              <p class="text-center">¡¡ Tú eliges la opción que te resulte más cómoda !!</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div id="ventajassocio" class="panel panel-default">
            <div class="panel-heading"><h4 class="panel-title">Ventajas de ser soci@</h4></div>
            <div class="panel-body text-left">
              <p>Hacerte socio es una buena forma de apoyar iniciativas que repercuten directamente en tus hijos y sólo cuesta 25€ anuales por familia.</p>
              <p>Además, ser socio del AMPA conlleva estas ventajas:</p>
              <ul>
                <li><p>Hay <b>actividades</b> que son <b>exclusivas para socios</b> tales como Salidas, Cabalgata de Reyes, y otras actividades realizadas en días no lectivos.</p></li>
                <li><p>Tienen <b>prioridad</b> a la hora de participar en cualquier <b>actividad con aforo limitado</b> que organice el AMPA, como por ejemplo Actividades Extraescolares, Cursos, Talleres, etc...</p></li>
                <li><p>Las posibles <b>Actividades Extraescolares</b> ofrecidas por el AMPA son <b>más baratas</b> al mes para socios, y éstos tienen prioridad para apuntarse.</p></li>
                <li><p>Tienen <b>descuentos y subvenciones totales o parciales</b> en actividades organizadas por el AMPA, Salidas, Talleres, Disfraces, etc...</p></li>
                <li><p>Disponen de <b>Ofertas y Descuentos en tiendas locales</b>. (Necesario mostrar el carnet de Socio)</p></li>
                <li><p>Podrán <b>recibir regalos del AMPA</b>. Por ejemplo en el día del libro se regala un libro a cada niño asociado.</p></li>
              </ul>
              <br>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Caja Nuestros proyectos -->
    <div id="proyectos">
      <h3>Nuestros proyectos</h3><br>
      <div class="row">
        <div class="col-sm-4">
          <img src="https://placehold.it/150x80?text=IMAGEN" class="img-responsive" style="width:100%" alt="Imagen">
          <p>Proyecto actual</p>
        </div>
        <div class="col-sm-4">
          <img src="https://placehold.it/150x80?text=IMAGEN" class="img-responsive" style="width:100%" alt="Imagen">
          <p>Próximos proyectos</p>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Nuestra última hoja colegial...</p>
          </div>
          <div class="well">
            <p>Próximos eventos en nuestro colegio...</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>