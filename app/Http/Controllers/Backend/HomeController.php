<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ActivityRepository;
use App\Repositories\AlumnoRepository;
use App\Repositories\AttendeeRepository;
use App\Repositories\AvisosRepository;
use App\Repositories\EntradaRepository;
use App\Repositories\EntrytypeRepository;
use App\Repositories\FacturaRepository;
use App\Repositories\MeetingRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\PeriodoRepository;
use App\Repositories\RecibosRepository;
use App\Repositories\SocioRepository;
use App\Repositories\TiposnotificacionRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

/**
 * Clase del controlador para la administración del home del backend
 */
class HomeController extends Controller
{
    protected $alumnos;
    protected $actividades;
    protected $reuniones;
    protected $asistentes;
    protected $avisos;
    protected $notificaciones;
    protected $tiposnotificacion;
    protected $periodos;
    protected $socios;
    protected $entradas;
    protected $recibos;
    protected $facturas;
    protected $tipoEntrada;

    /**
     * __construct: Constructor de la clase. Usa los modelos: Student, Activity y Warning
     */
    public function __construct(
        AlumnoRepository $alumnos,
        ActivityRepository $actividades,
        AvisosRepository $avisos,
        MeetingRepository $reuniones,
        AttendeeRepository $asistentes,
        NotificationRepository $notificaciones,
        TiposnotificacionRepository $tiposnotificacion,
        PeriodoRepository $periodos,
        SocioRepository $socios,
        EntradaRepository $entradas,
        RecibosRepository $recibos,
        FacturaRepository $facturas,
        EntrytypeRepository $tipoEntrada
    ) {
        $this->middleware('auth');

        $this->alumnos           = $alumnos;
        $this->actividades       = $actividades;
        $this->reuniones         = $reuniones;
        $this->asistentes        = $asistentes;
        $this->avisos            = $avisos;
        $this->notificaciones    = $notificaciones;
        $this->tiposnotificacion = $tiposnotificacion;
        $this->periodos          = $periodos;
        $this->socios            = $socios;
        $this->entradas          = $entradas;
        $this->recibos           = $recibos;
        $this->facturas          = $facturas;
        $this->tipoEntrada       = $tipoEntrada;
    }

    /**
     * Index: Se visualiza el panel de control correspondiente al socio logueado
     *
     * @return Vista Página principal de la parte backend de la aplicación
     */
    public function index()
    {
        $cerrarActividades = $this->actividades->cerrarActividades();
        $cerrarReuniones   = $this->reuniones->cerrarReuniones();
        $avisos            = $this->cargarAvisos();
        $autorizaciones    = $this->cargarAutorizaciones();
        $notificaciones    = $this->cargarNotificaciones();

        $this->periodos->actualizarSocios($this->socios->totalsocios());
        $this->cargarRecibosEnEntradas($this->periodos->buscarPeriodoActivo()->periodo);

        $anio = Carbon::now()->year;
        $mes  = Carbon::now()->month;

        return view('backend.home', compact('anio', 'mes', 'autorizaciones', 'avisos', 'notificaciones'));
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
     *  cargarNotificaciones: Se deben colocar en este método todas las validaciones que deban
     * ser objeto de creación de un aviso a mostrar al usuario tras su login.
     * Como resultado se obtiene el total de avisos pendientes de cierre por parte del socio.
     */

    public function cargarNotificaciones()
    {
        return Auth::user()->unreadNotifications()->count();
    }

    /**
     * notificacionesData: Se visualiza la vista de notificaciones emitidas al usuario logueado
     *
     * @return Vista Página que muestra las notificaciones producidas para el usuario logged in
     */
    public function tipoNotificacionesData()
    {
        $notifications = $this->notificaciones->tipoNotificacionesPendientesPorUserid(Auth::user()->id);

        return DataTables::of($notifications)
            ->addColumn(
                'icono',
                function ($notification) {
                    return $this->tiposnotificacion->textoNotificacionPorTipo($notification->type)->icono;
                }
            )
            ->addColumn(
                'tipo',
                function ($notification) {
                    return $this->tiposnotificacion->textoNotificacionPorTipo($notification->type)->notificacion;
                }
            )
            ->addColumn(
                'action',
                function ($notification) {
                    $btnSeleccionar = '<i class="text-success fa fa-check"></i>'
                    . '<a href="'
                    . route('home.notificacionestipo', $notification->type)
                    . '">'
                    . '<span class="text-success texto-accion">'
                    . trans('acciones_crud.select')
                        . '</span>'
                        . '</a>';
                    return $btnSeleccionar;
                }
            )
            ->make(true);
    }

    /**
     * notificacionesTipo
     */
    public function notificacionesTipo($tiponotificacion)
    {
        $tipo           = $this->tiposnotificacion->textoNotificacionPorTipo($tiponotificacion)->notificacion;
        $notificaciones = $this->notificaciones->notificacionesPorTipoyUserid($tiponotificacion, Auth::user()->id);

        return view('backend.home.notificacionestipo', compact('tipo', 'notificaciones'));
    }

    /**
     * notificacionesTipoLeer
     */
    public function notificacionesTipoLeer($id)
    {
        $notificacion = $this->notificaciones->notificacionesPorIdyUserid($id, Auth::user()->id);
        $tipo         = $this->tiposnotificacion->textoNotificacionPorTipo($notificacion->type)->notificacion;

        return view('backend.home.notificacionestipoleer', compact('notificacion', 'tipo'));
    }

    /**
     * notificacionesTipoMarcarLeida
     */
    public function notificacionesTipoMarcarLeida($id)
    {
        $notificacion = $this->notificaciones->notificacionesPorIdyUserid($id, Auth::user()->id);

        $tipo = $notificacion->type;

        $notificacion->markAsRead();

        $this->reuniones->confirmarReunionPivot($notificacion->data['reunion']['id'], Auth::user()->id);

        if ($this->notificaciones->notificacionesPorTipoyUserid($tipo, Auth::user()->id)->count() > 0) {
            return redirect(route('home.notificacionestipo', $tipo));
        } else {
            if (Auth::user()->unreadNotifications()->count() > 0) {
                return redirect(route('home.notificaciones'));
            } else {
                return redirect(route('home'));
            }
        }
    }

    /**
     * notificacionesVencida
     */
    public function notificacionesVencida($id)
    {
        $notificacion = $this->notificaciones->notificacionesPorIdyUserid($id, Auth::user()->id);
        $tipo         = $notificacion->type;

        $notificacion->markAsRead();

        if ($this->notificaciones->notificacionesPorTipoyUserid($tipo, Auth::user()->id)->count() > 0) {
            return redirect(route('home.notificacionestipo', $tipo));
        } else {
            if (Auth::user()->unreadNotifications()->count() > 0) {
                return redirect(route('home.notificaciones'));
            } else {
                return redirect(route('home'));
            }
        }
    }

    /**
     * panelAutorizacione: Se visualiza la vista de autorizaciones de las actividades
     * asignadas al hij@ del usuario logueado.
     */
    public function panelAutorizaciones()
    {
        $alumnos                   = Auth::user()->students;
        $autorizaciones_pendientes = [];
        $total_aut_pendientes      = 0;

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
                    'id'           => $alumno->id,
                    'nombre'       => $alumno->nombre,
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
        $alumnos              = Auth::user()->students;
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
        $alumno     = $this->alumnos->buscaralumnoporid($id_alumno);
        $url_alumno = false;
        $url        = $this->obtenerUrl();

        if (stripos($url, 'alumno')) {
            $url_alumno = true;
        }

        $act_pend_aut  = [];
        $act_ya_aut    = [];
        $act_desistida = [];

        foreach ($alumno->activities as $actividad) {
            if (!$actividad->pivot->authorized && !$actividad->cerrada) {
                $act_pend       = $this->actividades->buscaractividadporid($actividad->id);
                $act_pend_aut[] = array(
                    'id'          => $act_pend->id,
                    'fecha'       => $act_pend->fechaactividad,
                    'nombre'      => $act_pend->nombre,
                    'descripcion' => $act_pend->descripcion,
                    'tipo'        => $act_pend->activitytype->tipoactividad,
                    'precio'      => $act_pend->precio,
                    'subvencion'  => $act_pend->subvencion,
                );
            } elseif ($actividad->cerrada && !$actividad->pivot->authorized) {
                $act_des         = $this->actividades->buscaractividadporid($actividad->id);
                $act_desistida[] = array(
                    'id'          => $act_des->id,
                    'fecha'       => $act_des->fechaactividad,
                    'nombre'      => $act_des->nombre,
                    'descripcion' => $act_des->descripcion,
                );
            } elseif ($actividad->pivot->authorized) {
                $act_ya       = $this->actividades->buscaractividadporid($actividad->id);
                $act_ya_aut[] = array(
                    'id'          => $act_ya->id,
                    'fecha'       => $act_ya->fechaactividad,
                    'nombre'      => $act_ya->nombre,
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
        $alumno    = $this->alumnos->buscaralumnoporid($id_alumno);

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
            $fecha  = Carbon::now()->format('Y-m-d');
            $codigo = 'WCHGPASS';
            $aviso  = 'Por motivos de seguridad debería Ud. cambiar su contraseña ya que la actual es una
             contraseña genérica. En caso de mantener su contraseña actual, terceras personas podrían
             acceder a su cuenta.';
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
            $fecha  = Carbon::now()->format('Y-m-d');
            $codigo = 'WIMPDADH';
            $aviso  = 'Por favor, Ud. debe hacernos llegar el documento de acuerdo de adhesión que en
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
            $fecha  = Carbon::now()->format('Y-m-d');
            $codigo = 'WIMPRECI';
            $aviso  = 'Por favor, Ud. debe hacernos llegar el recibo o justificante del pago de
             su cuota de socio.';
            $solucion = 'Escanéelo en formato pdf y realice una de las siguientes acciones: a)
             Súbalo a esta aplicación. Si desea optar por esta solución abra el desplegable con su
             nombre en la parte superior de la página y acceda a su perfil donde encontrará la opción
             correspondiente. b) Deposítelo en nuestro buzón. c) Entréguelo personalmente en nuestro
             despacho sito en la planta superior sobre la secretaría del colegio. Le recomendamos que
             domicilie el pago de su cuota, así se evitará recibir este aviso en sucesivas ocasiones.';
            $user_id = Auth::user()->id;

            return $this->avisos->crearAviso($codigo, $fecha, $aviso, $solucion, $user_id);
        }
    }

    /**
     * cargarRecibosEnEntradas
     */
    public function cargarRecibosEnEntradas($periodo)
    {
        $datosFactura = [
            'periodo'      => $periodo,
            'fecha'        => null,
            'emisor'       => null,
            'destinatario' => 'AMPASPAB',
            'concepto'     => null,
            'factura'      => null,
            'importe'      => null,
            'importada'    => true,
        ];

        $datosEntrada = [
            'periodo'      => $periodo,
            'invoice_id'   => null,
            'emisor'       => null,
            'entrytype_id' => null,
            'descripcion'  => null,
            'importe'      => null,
        ];

        $totalIngresosRecibos = 0;

        $recibos = $this->recibos->buscarRecibosActivosPorPeriodo($periodo);

        foreach ($recibos as $recibo) {
            $socio = $this->socios->buscarsocioporid($recibo->user_id);

            $datosFactura['fecha']    = Carbon::parse($recibo->created_at)->format('Y-m-d');
            $datosFactura['factura']  = $recibo->ruta . $recibo->fichero;
            $datosFactura['importe']  = $recibo->importe;
            $datosFactura['emisor']   = $socio->nombre . ' ' . $socio->apellidos;
            $datosFactura['concepto'] = 'Cuota de '
            . $socio->nombre
            . ' '
            . $socio->apellidos
            . ' ('
            . $socio->numdoc
                . ')';

            $factura = $this->facturas->crearFacturaReciboSocio($datosFactura);

            if ($factura) {
                $datosEntrada['invoice_id']   = $factura->id;
                $datosEntrada['entrytype_id'] = $this->tipoEntrada->buscarIdPorTipoEntrada('Ingreso')->id;
                $datosEntrada['descripcion']  = $factura->concepto;
                $datosEntrada['importe']      = $factura->importe;

                $entrada = $this->entradas->crearEntradaReciboSocio($datosEntrada);

                $totalIngresosRecibos = $totalIngresosRecibos + $entrada->importe;
            }

            $this->periodos->consolidarRecibosActivosPeriodo($totalIngresosRecibos);
        }
    }

    /**
     * obtenerUrl: Se obtiene la url de origen para decidir la vuelta a la página anterior
     */
    public function obtenerUrl()
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
    }
}
