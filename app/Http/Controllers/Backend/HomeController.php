<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ActivityRepository;
use App\Repositories\AlumnoRepository;
use App\Repositories\AvisosRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Clase del controlador para la administración del home del backend
 */
class HomeController extends Controller
{
    protected $alumnos;
    protected $actividades;
    protected $avisos;

    /**
     * __construct: Constructor de la clase. Usa los modelos: Student, Activity y Warning
     */
    public function __construct(AlumnoRepository $alumnos, ActivityRepository $actividades, AvisosRepository $avisos)
    {
        $this->middleware('auth');

        $this->alumnos = $alumnos;
        $this->actividades = $actividades;
        $this->avisos = $avisos;
    }

    /**
     * Index: Se visualiza el panel de control correspondiente al socio logueado
     *
     * @return Vista Página principal de la parte backend de la aplicación
     */
    public function index()
    {
        $cerrarActividades = $this->actividades->cerrarActividades();
        $avisos = $this->cargarAvisos();
        $autorizaciones = $this->cargarAutorizaciones();

        $anio = Carbon::now()->year;
        $mes = Carbon::now()->month;
        return view('backend.home', compact('anio', 'mes', 'autorizaciones', 'avisos'));
    }

    /**
     * Panelavisos: Se visualiza la vista de avisos emitidos al usuario logueado
     *
     * @return Vista Página que muestra los avisos producidos para el usuario logged in
     */
    public function panelAvisos()
    {
        $avisos_abiertos = $this->avisos->avisosAbiertos();

        return view('backend.home.avisos', compact('avisos_abiertos'));
    }

    /**
     *  cargarAvisos: Se deben colocar en este método todas las validaciones que deban
     * ser objeto de creación de un aviso a mostrar al usuario tras su login.
     * Como resultado se obtiene el total de avisos pendientes de cierre por parte del socio.
     */

    public function cargarAvisos()
    {
        $this->avisoCambiarPassword('secret');
        $this->avisoSubirRecibo();
        $this->avisoSubirAcuerdoDeAdhesion();

        return $this->avisos->avisosAbiertos()->count();
    }

    /**
     * panelAutorizacione: Se visualiza la vista de autorizaciones de las actividades
     * asignadas al hij@ del usuario logueado.
     */
    public function panelAutorizaciones()
    {
        $alumnos = Auth::user()->students;
        $autorizaciones_pendientes = [];
        $total_aut_pendientes = 0;

        foreach ($alumnos as $alumno) {
            $tot_aut_pend = 0;
            foreach ($alumno->activities as $actividad) {
                if (!$actividad->pivot->authorized && !$actividad->cerrada) {
                    ++$tot_aut_pend;
                };
            }

            if ($tot_aut_pend > 0) {
                $total_aut_pendientes = $total_aut_pendientes + $tot_aut_pend;
                $autorizaciones_pendientes[] = array(
                    'id' => $alumno->id,
                    'nombre' => $alumno->nombre,
                    'tot_aut_pend' => $tot_aut_pend,
                );
            }
        }

        return view('backend.home.autorizaciones', compact('autorizaciones_pendientes', 'total_aut_pendientes'));
    }

    /**
     * Cargarautorizaciones: Se obtiene el total de autorizaciones pendientes para el socio logueado
     *
     * @return Integer $total_act_pendientes Total de autorizaciones pendientes de autorizar
     */
    public function cargarAutorizaciones()
    {
        $alumnos = Auth::user()->students;
        $total_aut_pendientes = 0;

        foreach ($alumnos as $alumno) {
            $tot_aut_pend = 0;
            foreach ($alumno->activities as $actividad) {
                if (!$actividad->pivot->authorized && !$actividad->cerrada) {
                    ++$tot_aut_pend;
                };
            }

            if ($tot_aut_pend > 0) {
                $total_aut_pendientes = $total_aut_pendientes + $tot_aut_pend;
            }
        }

        return $total_aut_pendientes;
    }

    /**
     * autorizarSeleccion: Se informa la página de autorizaciones con aquellas actividades
     * a autorizar, las ya autorizadas y las desistidas.
     */
    public function autorizarSeleccion($id_alumno)
    {
        $alumno = $this->alumnos->buscaralumnoporid($id_alumno);
        $url_alumno = false;
        $url = $this->obtenerUrl();

        if (stripos($url, 'alumno')) {
            $url_alumno = true;
        }

        $act_pend_aut = [];
        $act_ya_aut = [];
        $act_desistida = [];

        foreach ($alumno->activities as $actividad) {
            if (!$actividad->pivot->authorized && !$actividad->cerrada) {
                $act_pend = $this->actividades->buscaractividadporid($actividad->id);
                $act_pend_aut[] = array(
                    'id' => $act_pend->id,
                    'fecha' => $act_pend->fechaactividad,
                    'nombre' => $act_pend->nombre,
                    'descripcion' => $act_pend->descripcion,
                    'tipo' => $act_pend->activitytype->tipoactividad,
                    'precio' => $act_pend->precio,
                    'subvencion' => $act_pend->subvencion,
                );
            } elseif ($actividad->cerrada && !$actividad->pivot->authorized) {
                $act_des = $this->actividades->buscaractividadporid($actividad->id);
                $act_desistida[] = array(
                    'id' => $act_des->id,
                    'fecha' => $act_des->fechaactividad,
                    'nombre' => $act_des->nombre,
                    'descripcion' => $act_des->descripcion,
                );
            } elseif ($actividad->pivot->authorized) {
                $act_ya = $this->actividades->buscaractividadporid($actividad->id);
                $act_ya_aut[] = array(
                    'id' => $act_ya->id,
                    'fecha' => $act_ya->fechaactividad,
                    'nombre' => $act_ya->nombre,
                    'descripcion' => $act_ya->descripcion,
                );
            };

            return view(
                'backend.home.autorizar',
                compact(
                    'alumno',
                    'url_alumno',
                    'act_pend_aut',
                    'act_ya_aut',
                    'act_desistida'
                )
            );
        };
    }

    /**
     * autorizarActividad: Se marca como autorizada la actividad al alumno deleccionado
     * por el socio en la vista autorizar
     */
    public function autorizarActividad($id_alumno, $id_actividad)
    {
        $actividad = $this->actividades->buscaractividadporid($id_actividad);
        $alumno = $this->alumnos->buscaralumnoporid($id_alumno);

        if ($actividad->fechaactividad >= Carbon::now()->format('Y-m-d')) {
            $this->actividades->autorizarActividadPivot($id_alumno, $id_actividad);

            flash(
                trans(
                    'acciones_crud.authorizeactivity',
                    ['actividad' => $actividad->nombre, 'alumno' => $alumno->nombre]
                )
            )->success();
        } else {
            flash(
                trans(
                    'acciones_crud.notauthorizeactivity',
                    ['actividad' => $actividad->nombre, 'alumno' => $alumno->nombre]
                )
            )->error();
        }

        $actividades_pendientes = false;
        foreach ($alumno->activities as $actividad) {
            if (!$actividad->pivot->authorized) {
                $actividades_pendientes = true;
            }
        }

        if ($actividades_pendientes) {
            return redirect(route('home.autorizaralumno', $id_alumno));
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * avisoCambiarPassword: Se procesa el aviso WCHGPASS. Si la contraseña del usuario
     * que hace login es la misma que se define por defecto (secret), se definen el código
     * y el texto del aviso de cambio de password de defecto a ser notificado al uasuario
     * tras su login
     */
    public function avisoCambiarPassword($secret)
    {
        if (Hash::check($secret, Auth::user()->password)) {
            $fecha = Carbon::now()->format('Y-m-d');
            $codigo = 'WCHGPASS';
            $aviso = 'Por motivos de seguridad debería Ud. cambiar su contraseña ya que la actual es una
            contraseña genérica. En caso de mantener su contraseña actual, terceras personas podrían
             acceder a su cuenta';
            $solucion = 'Abra el desplegable con su nombre en la parte superior de la página y acceda
            a su perfil donde, una vez haya importado su justificante de pago y éste haya
            sido validado por la Asociación, encontrará activa la opción correspondiente.';

            $user_id = Auth::user()->id;

            return $this->avisos->crearAviso($codigo, $fecha, $aviso, $solucion, $user_id);
        }
    }

    /**
     * avisoSubirAcuerdoDeAdhesion: Si el socio tiene pendiente la entrega de su firma a
     * la AMPA (propiedad firmacorrecta del modelo User) se visualiza el aviso correspondiente
     */
    public function avisoSubirAcuerdoDeAdhesion()
    {
        if (!Auth::user()->firmacorrecta) {
            $fecha = Carbon::now()->format('Y-m-d');
            $codigo = 'WIMPDADH';
            $aviso = 'Por favor, Ud. debe hacernos llegar el documento de acuerdo de adhesión que en
            su día le fue remitido por esta AMPA. Dicho documento deberá estar firmado por Ud.';
            $solucion = 'Realice una de las siguientes acciones: a) Imprímalo, fírmelo y escanéelo
             en formato pdf y súbalo a esta aplicación. Si desea optar por esta solución abra el
             desplegable con su nombre en la parte superior de la página y acceda a su perfil donde
             encontrará la opción correspondiente. b) imprímalo, fírmelo y deposítelo en nuestro
             buzón. c) imprímalo, fírmelo y entréguelo personalmente en nuestro despacho sito en la
             planta superior sobre la secretaría del colegio. d) Acuda a nuestro despacho y firme la
             copia de su documento que obra en nuestro poder.';
            $user_id = Auth::user()->id;

            return $this->avisos->crearAviso($codigo, $fecha, $aviso, $solucion, $user_id);
        }
    }

    /**
     * avisoSubirRecibo: Si el socio tiene pendiente la entrega de su recibo a la AMPA
     * (propiedad corrientepago del modelo User) se visualiza el aviso correspondiente
     */
    public function avisoSubirRecibo()
    {
        if (!Auth::user()->corrientepago) {
            $fecha = Carbon::now()->format('Y-m-d');
            $codigo = 'WIMPRECI';
            $aviso = 'Por favor, Ud. debe hacernos llegar el recibo o justificante del pago de
             su cuota de socio.';
            $solucion = 'Realice una de las siguientes acciones: a) Escanéelo en formato pdf y
            súbalo a esta aplicación. Si desea optar por esta solución abra el desplegable con su
            nombre en la parte superior de la página y acceda a su perfil donde encontrará la opción
            correspondiente. b) deposítelo en nuestro buzón. c) entréguelo personalmente en nuestro
            despacho sito en la planta superior sobre la secretaría del colegio.';
            $user_id = Auth::user()->id;

            return $this->avisos->crearAviso($codigo, $fecha, $aviso, $solucion, $user_id);
        }
    }

    /**
     * obtenerUr: Se obtiene la url de origen para decidir la vuelta a la página anterior
     * entre otros datos de las vistas
     */
    public function obtenerUrl()
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
    }
}
