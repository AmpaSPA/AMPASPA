<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ImportCsvFileRequest;
use App\Http\Requests\UpdateDataSocioRequest;
use App\Http\Requests\UpdateFirmaRequest;
use App\Http\Requests\UpdateJpagoRequest;
use App\Mail\BienvenidaMail;
use App\Repositories\AvisosRepository;
use App\Repositories\PeriodoRepository;
use App\Repositories\RecibosRepository;
use App\Repositories\SocioRepository;
use Auth;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use DataTables;
use Excel;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Mail;

class SociosController extends Controller
{
    protected $socios;
    protected $avisos;
    protected $periodo;
    protected $recibos;

    /**
     * __construct: Constructor de la clase. Usa los modelos: User, Warnings y Periods
     */
    public function __construct(
        SocioRepository $socios,
        AvisosRepository $avisos,
        PeriodoRepository $periodo,
        RecibosRepository $recibos
    ) {
        $this->socios  = $socios;
        $this->avisos  = $avisos;
        $this->periodo = $periodo;
        $this->recibos = $recibos;
    }

    /**
     * index: Muestra la pantalla principal para el mantenimiento del modelo User (Socios)
     */
    public function index()
    {
        $sociosbaja = $this->socios->obtenersociosenbaja();
        return view('backend.socios.index', compact('sociosbaja'));
    }

    /**
     * create: Se visualiza la vista para crear un nuevo socio
     */
    public function create()
    {
        $modo    = 'new';
        $tdocs   = $this->socios->tiposdoc();
        $tsocios = $this->socios->tipossocio();
        $tpagos  = $this->socios->tipospago();

        return view('backend.socios.nuevo', compact('modo', 'tdocs', 'tsocios', 'tpagos'));
    }

    /**
     * edit: uestra la información del socio seleccionado
     */
    public function edit($id)
    {
        $modo    = 'update';
        $socio   = $this->socios->buscarsocioporid($id);
        $tdocs   = $this->socios->tiposdoc();
        $tsocios = $this->socios->tipossocio();
        $tpagos  = $this->socios->tipospago();

        return view(
            'backend.socios.editar',
            compact(
                'socio',
                'modo',
                'tdocs',
                'tsocios',
                'tpagos'
            )
        );
    }

    /**
     * update: Se actualiza la información del socio seleccionado
     */
    public function update($id, CreateUserRequest $request)
    {
        $socio = $this->socios->updatesocio($id, $request);

        flash(
            trans(
                'acciones_crud.updatemember',
                [
                    'socio' => $socio->nombre
                    . ' '
                    . $socio->apellidos,
                ]
            )
        )->success();

        return redirect(route('socios.list'));
    }

    /**
     * showchangepassword: Se muestra el formulario para el cambio de contraseña
     */
    public function showchangepassword()
    {
        $socio = $this->socios->socioAutenticado();
        return view('auth.passwords.changepassword', compact('socio'));
    }

    /**
     * changepassword: Se cambia la contraseña en la BBDD con la contraseña introducida por el
     * usuario y se desactiva el aviso de cambio de contraseña que aparece en el primer acceso
     * y sucesivos mientras la contraseña no se cambie.
     */
    public function changepassword(ChangePasswordRequest $request)
    {
        $this->socios->updateclavesocio($request);
        if (!$this->avisos->avisoCerrado(Auth::user()->id, 'WCHGPASS')) {
            $this->avisos->desactivarAviso(Auth::user()->id, 'WCHGPASS');
        }

        flash(
            trans(
                'message.passwordchanged',
                [
                    'socio' => Auth::user()->nombre
                    . ' '
                    . Auth::user()->apellidos,
                ]
            )
        )->success();

        return redirect('home');
    }

    /**
     * verdata: Se muestran los datos del socio almacenados en la BBDD
     */
    public function verdata($id)
    {
        $socio  = $this->socios->socioAutenticado();
        $tdocs  = $this->socios->tiposdoc();
        $tpagos = $this->socios->tipospago();

        return view('backend.socios.verdata', compact('socio', 'tdocs', 'tpagos'));
    }

    /**
     * changedata: Se actualizan los datos del socio una vez validados guardando las
     * actualizaciones en la BBDD
     */
    public function changedata($id, UpdateDataSocioRequest $request)
    {
        $socio = $this->socios->updatesocio($id, $request);

        flash(
            trans(
                'acciones_crud.updatemember',
                [
                    'socio' => $socio->nombre
                    . ' '
                    . $socio->apellidos,
                ]
            )
        )->success();

        return redirect(route('profile.home', $id));
    }

    /**
     * sociosdata: Muestra el contenido de la tabla de socios mediante su repositorio
     */
    public function sociosdata()
    {
        $users = $this->socios->socios();

        return DataTables::of($users)
            ->addColumn(
                'nombre',
                function ($user) {
                    return $user->nombre
                    . ' '
                    . $user->apellidos;
                }
            )
            ->addColumn(
                'action',
                function ($user) {
                    $btnVer = '<i class="text-success fa fa-eye"></i>'
                    . '<a href = "'
                    . url('backend/socios/ver/' . $user->id)
                    . '">'
                    . '<span class="text-success texto-accion">'
                    . trans('acciones_crud.view')
                        . '</span>'
                        . '</a>';
                    $btnEditar = '<i class="text-warning fa fa-pencil"></i>'
                    . '<a href="'
                    . url('backend/socios/edit/' . $user->id)
                    . '">'
                    . '<span class="text-warning texto-accion">'
                    . trans('acciones_crud.edit')
                        . '</span>'
                        . '</a>';
                    $btnEliminar = '<i class="text-danger fa fa-trash"></i>'
                    . '<a href="'
                    . url('backend/socios/borrar/' . $user->id)
                    . '">'
                    . '<span class="text-danger texto-accion">'
                    . trans('acciones_crud.delete')
                        . '</span>'
                        . '</a>';
                    $btnAlumnos = '<i class="text-info fa fa-graduation-cap"></i>'
                    . '<a href="'
                    . url('/backend/alumnos/create/socio/' . $user->id)
                    . '">'
                    . '<span class="text-info texto-accion">'
                    . trans('acciones_crud.students')
                        . '</span>'
                        . '</a>';

                    return $btnVer . ' ' . $btnEditar . ' ' . $btnEliminar . ' ' . $btnAlumnos;
                }
            )
            ->make(true);
    }

    /**
     * view: Se muestran los datos del socio seleccionado para su consulta
     */
    public function view($id)
    {
        $modo         = 'view';
        $socio        = $this->socios->buscarsocioporid($id);
        $sociotipodoc = $this->socios->buscartipodocumento($id);
        $sociotipo    = $this->socios->buscartiposocio($id);
        $pagotipo     = $this->socios->buscartipopago($id);

        return view('backend.socios.ver', compact('socio', 'modo', 'sociotipodoc', 'sociotipo', 'pagotipo'));
    }

    /**
     * viewsignature: Se muestra la firma del socio seleccionado
     */
    public function viewsignature($id)
    {
        $socio = $this->socios->buscarsocioporid($id);
        $pdf   = public_path('assets/docs/') . $id . '/adhesion/' . $socio->numdoc . '.pdf';

        header('Content-type: application/pdf');
        readfile($pdf);
    }

    /**
     * viewrecibo: Se muestra el recibo del socio seleccionado
     */
    public function viewrecibo($id)
    {
        $periodo = $this->periodo->buscarPeriodoActivo();
        $socio   = $this->socios->buscarsocioporid($id);

        $pdf = public_path('assets/docs/') . $id
        . '/recibos/'
        . $periodo->aniodesde
        . $periodo->aniohasta
        . $socio->numdoc
            . '.pdf';

        header('Content-type: application/pdf');
        readfile($pdf);
    }

    /**
     * viewprofile: Se muestran los datos del perfil del socio seleccionado
     */
    public function viewprofile($id)
    {
        $socio   = $this->socios->buscarsocioporid($id);
        $hijos   = $this->socios->alumnosporsocio($id);
        $profile = $this->socios->profilesocio($id);

        return view('backend.socios.infocompleta', compact('socio', 'hijos', 'profile'));
    }

    /**
     * store: Se guardan en la BBDD los datos del socio, se construye el documento de firma y
     * se envia un correo de bienvenida
     */
    public function store(CreateUserRequest $request)
    {
        $data   = $this->socios->crearsocio($request);
        $recibo = $this->recibos->crearReciboUsuario($data->id);

        $tdocumento = $data->doctype->tipodoc;
        $tpago      = $data->paymenttype->tipopago;
        $pdf        = public_path('assets/docs/' . $data->id . '/adhesion/') . $data->numdoc . '.pdf';

        PDF::loadView(
            'backend.socios.adhesion',
            compact(
                'data',
                'tdocumento',
                'tpago'
            )
        )->save($pdf);

        Mail::to($data->email)->send(new BienvenidaMail($data));

        flash(
            trans(
                'acciones_crud.addedmember',
                [
                    'socio' => $data->nombre
                    . ' '
                    . $data->apellidos,
                ]
            )
        )->success();

        return redirect('backend/alumnos/create/socio/' . $data->id);
    }

    /**
     * delete: Se da de baja temporal al socio seleccionado, más tarde se confirmará la baja
     * o se restaurará la información del socio
     */
    public function delete($id)
    {
        $socio = $this->socios->buscarsocioporid($id);

        if (Auth::user()->id != $id) {
            $this->socios->borrarsocio($id);
            flash(
                trans(
                    'acciones_crud.deletemember',
                    [
                        'socio' => $socio->nombre
                        . ' '
                        . $socio->apellidos,
                    ]
                )
            )->success();

            return redirect()->back();
        }

        flash(
            trans(
                'acciones_crud.nodeletemember',
                [
                    'socio' => $socio->nombre
                    . ' '
                    . $socio->apellidos,
                ]
            )
        )->error();

        return redirect('backend/socios');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listabajas()
    {
        $bajas = $this->socios->obtenersociosenbaja();

        return view('backend.socios.listadobajas', compact('bajas'));
    }

    /**
     * restaurar: Se retrocede la baja temporal del socio devolviéndole a su estado
     * anterior a la baja
     */
    public function restaurar($id)
    {
        $this->socios->restaurarsocio($id);
        $socio = $this->socios->buscarsocioporid($id);

        flash(
            trans(
                'acciones_crud.restoremember',
                [
                    'socio' => $socio->nombre
                    . ' '
                    . $socio->apellidos,
                ]
            )
        )->success();

        return redirect('backend/socios');
    }

    /**
     * bajadefinitiva: Se elimina el socio seleccionado de la BBDD
     */
    public function bajadefinitiva($id)
    {
        $periodo = $this->periodo->buscarPeriodoActivo();

        $this->recibos->borrarRecibosSocio($id);
        $nombre_socio = $this->socios->removesocio($id, $periodo);

        $carpeta = public_path('assets/docs/') . $id;

        $this->borrarCarpetaDocumentos($carpeta);

        flash(
            trans(
                'acciones_crud.removemember',
                [
                    'socio' => $nombre_socio,
                ]
            )
        )->success();

        return redirect('backend/socios');
    }

    /**
     * gestiondocumentos: Se presenta la lista de todos los socios con documentación
     * pendiente de importar
     */
    public function gestiondocumentos()
    {
        $pendientes_gestion = $this->socios->obtenerDocsPendientesImportar();
        return view('backend.socios.listainactivos', compact('pendientes_gestion'));
    }

    /**
     * inactivosdata: Se añaden las columnas de nombre, tipo de documento pendiente y
     * el botón de importar el documento que se encuentre pendiente de guardar en la BBDD
     */
    public function inactivosdata()
    {
        $inactivos = $this->socios->obtenerDocsPendientesImportar();

        return DataTables::of($inactivos)
            ->addColumn(
                'nombre',
                function ($inactivo) {
                    return $inactivo->nombre
                    . ' '
                    . $inactivo->apellidos;
                }
            )
            ->addColumn(
                'firma',
                function ($inactivo) {
                    if (!$inactivo->firmaimportada) {
                        return trans(
                            'message.yes'
                        );
                    } else {
                        return trans(
                            'message.not'
                        );
                    }
                }
            )
            ->addColumn(
                'recibo',
                function ($inactivo) {
                    if (!$inactivo->reciboimportado) {
                        return trans(
                            'message.yes'
                        );
                    } else {
                        return trans(
                            'message.not'
                        );
                    }
                }
            )
            ->addColumn(
                'action',
                function ($inactivo) {
                    $btnFirma  = null;
                    $btnRecibo = null;

                    if (!$inactivo->firmaimportada) {
                        $btnFirma = '<i class="text-warning fa fa-upload"></i>'
                        . '<a id="btver" href="'
                        . route('socios.importarfirma', $inactivo->id)
                        . '">'
                        . '<span class="text-warning texto-accion">'
                        . trans('message.importsignature')
                            . '</span>'
                            . '</a>';
                    }
                    if (!$inactivo->reciboimportado) {
                        $btnRecibo = '<i class="text-success fa fa-upload"></i>'
                        . '<a id="btver" href="'
                        . route('socios.importarrecibo', $inactivo->id)
                        . '">'
                        . '<span class="text-success texto-accion">'
                        . trans('message.importreceipt')
                            . '</span>'
                            . '</a>';
                    }

                    return $btnFirma . ' ' . $btnRecibo;
                }
            )
            ->make(true);
    }

    /**
     * importarRecibo: Se muestra la página para importar el recibo del socio seleccionado
     */
    public function importarRecibo($id)
    {
        $url_profile = false;
        $url         = $this->obtenerUrl();

        if (stripos($url, 'profile')) {
            $url_profile = true;
        }

        $socio = $this->socios->buscarsocioporid($id);

        return view('backend.socios.recibo', compact('socio', 'url_profile'));
    }

    /**
     * gestionarjustpago: Se guarda el recibo importado y se informa su ruta en la BBDD. También
     * se marca como importado y se devuelve el control según haya sido la llamada a este
     * método
     */
    public function gestionarjustpago(UpdateJpagoRequest $request, $id)
    {
        $periodo = $this->periodo->buscarPeriodoActivo();

        $ruta     = public_path('assets/docs/') . $id . '/recibos/';
        $filename = $periodo->aniodesde . $periodo->aniohasta . $request->numdoc . '.pdf';

        $request->file('jpago')->move($ruta, $filename);

        $this->socios->changerecibo($ruta . $filename, $id);

        $this->socios->reciboImportado($id);
        $this->recibos->actualizarReciboUsuario($id, $ruta, $filename);

        $url_profile = false;
        $url         = $this->obtenerUrl();

        if (stripos($url, 'profile')) {
            flash(
                trans(
                    'acciones_crud.addedreceipt',
                    [
                        'socio' => $request->nombre
                        . ' '
                        . $request->apellidos,
                    ]
                )
            )->success();
            return redirect(route('profile.home', $id));
        } elseif ($this->socios->activarSocio($id)->activo) {
            $this->recibos->activarReciboUsuario($id);
            flash(
                trans(
                    'acciones_crud.addedreceipt',
                    [
                        'socio' => $request->nombre
                        . ' '
                        . $request->apellidos,
                    ]
                )
            )->success();

            return redirect(route('home'));
        } elseif ($this->socios->buscarsocioporid($id)->firmaimportada) {
            flash(
                trans(
                    'acciones_crud.addedreceipt',
                    [
                        'socio' => $request->nombre
                        . ' '
                        . $request->apellidos,
                    ]
                )
            )->success();

            return redirect(route('home'));
        } else {
            flash(
                trans(
                    'acciones_crud.addedreceipt',
                    [
                        'socio' => $request->nombre
                        . ' '
                        . $request->apellidos,
                    ]
                )
            )->success();

            return redirect(route('socios.gestionardocs'));
        }
    }

    /**
     * validarRecibo: Se visualiza la vista validarrecibo con el fin de procesar
     * el recibo consultado según corresponda
     */
    public function validarRecibo($id)
    {
        $socio = $this->socios->buscarsocioporid($id);

        return view('backend.socios.validarrecibo', compact('socio'));
    }

    /**
     * confirmarRecibo: Se actualizan las marcas de justificante de pago y de corriente de
     * pago, además si la firma también está validada se marca al usuario como activo y
     * también se activa su registro de perfil
     */
    public function confirmarRecibo($id)
    {
        $socio = $this->socios->buscarsocioporid($id);

        if ($this->socios->corrientePago($id)) {
            $this->socios->activarSocio($id);
            $this->recibos->activarReciboUsuario($id);
            if (!$this->avisos->avisoCerrado($id, 'WIMPRECI')) {
                $this->avisos->desactivarAviso($id, 'WIMPRECI');
            }

            if ($socio->firmaimportada && !$socio->firmacorrecta) {
                flash(
                    trans(
                        'message.receiptvalidated',
                        [
                            'socio' => $socio->nombre
                            . ' '
                            . $socio->apellidos,
                        ]
                    )
                )->success();

                return redirect(route('profile.validardocs', $id));
            } else {
                flash(
                    trans(
                        'message.receiptvalidated',
                        [
                            'socio' => $socio->nombre
                            . ' '
                            . $socio->apellidos,
                        ]
                    )
                )->success();

                return redirect(route('home'));
            }
        };
    }

    /**
     * rechazarRecibo: Devolver al socio a su estado inicial respecto a la importación
     * de su recibo
     */
    public function rechazarRecibo($id)
    {
        $documento = 'Recibo';
        $socio     = $this->socios->marcasDocumentoEstadoInicial($id, $documento);

        $carpeta_recibos = public_path('assets/docs/') . $id . '/recibos';
        $this->borrarCarpetaDocumentos($carpeta_recibos);

        if ($socio->firmaimportada && !$socio->firmacorrecta) {
            flash(
                trans(
                    'message.receiptrejected',
                    [
                        'socio' => $socio->nombre
                        . ' '
                        . $socio->apellidos,
                    ]
                )
            )->success();

            return redirect(route('profile.validardocs', $id));
        } else {
            flash(
                trans(
                    'message.receiptrejected',
                    [
                        'socio' => $socio->nombre
                        . ' '
                        . $socio->apellidos,
                    ]
                )
            )->success();

            return redirect(route('home'));
        }
    }

    /**
     * importarFirma: Se muestra la página para la importación de la firma del socio
     * seleccionado
     */
    public function importarFirma($id)
    {
        $url_profile = false;
        $url         = $this->obtenerUrl();

        if (stripos($url, 'profile')) {
            $url_profile = true;
        }

        $socio = $this->socios->buscarsocioporid($id);

        return view('backend.socios.firma', compact('socio', 'url_profile'));
    }

    /**
     * gestionaradhesion: Inicio del proceso para gestionar la firma del socio seleccionado
     */
    public function gestionaradhesion(UpdateFirmaRequest $request, $id)
    {
        $ruta     = public_path('assets/docs/') . $id . '/adhesion/';
        $filename = $request->numdoc . '.pdf';

        $request->file('firma')->move($ruta, $filename);

        $this->socios->changefirma($ruta . $filename, $id);

        $this->socios->firmaImportada($id);

        $url_profile = false;
        $url         = $this->obtenerUrl();

        if (stripos($url, 'profile')) {
            flash(
                trans(
                    'acciones_crud.addedsignature',
                    [
                        'socio' => $request->nombre
                        . ' '
                        . $request->apellidos,
                    ]
                )
            )->success();

            return redirect(route('profile.home', $id));
        } elseif ($this->socios->activarSocio($id)->activo) {
            $this->recibos->activarReciboUsuario($id);
            flash(
                trans(
                    'acciones_crud.addedsignature',
                    [
                        'socio' => $request->nombre
                        . ' '
                        . $request->apellidos,
                    ]
                )
            )->success();

            return redirect(route('home'));
        } elseif ($this->socios->buscarsocioporid($id)->reciboimportado) {
            flash(
                trans(
                    'acciones_crud.addedsignature',
                    [
                        'socio' => $request->nombre
                        . ' '
                        . $request->apellidos,
                    ]
                )
            )->success();

            return redirect(route('home'));
        } else {
            flash(
                trans(
                    'acciones_crud.addedsignature',
                    [
                        'socio' => $request->nombre
                        . ' '
                        . $request->apellidos,
                    ]
                )
            )->success();

            return redirect(route('socios.gestionardocs'));
        }
    }

    /**
     * validarFirma: Se visualiza la página para procesar la firma consultada según
     * corresponda
     */
    public function validarFirma($id)
    {
        $socio = $this->socios->buscarsocioporid($id);

        return view('backend.socios.validarfirma', compact('socio'));
    }

    /**
     * confirmarFirma: Se marca al socio como activo si su recibo está correctamente importado.
     * También se cierra el aviso de firma pendiente y se devuelve el control a la página
     * anterior, según corresponda
     */
    public function confirmarFirma($id)
    {
        $socio = $this->socios->buscarsocioporid($id);

        if ($this->socios->firmaCorrecta($id)) {
            $this->socios->activarSocio($id);
            $this->recibos->activarReciboUsuario($id);
            if (!$this->avisos->avisoCerrado($id, 'WIMPDADH')) {
                $this->avisos->desactivarAviso($id, 'WIMPDADH');
            }

            if ($socio->reciboimportado && !$socio->corrientepago) {
                flash(
                    trans(
                        'message.signaturevalidated',
                        [
                            'socio' => $socio->nombre
                            . ' '
                            . $socio->apellidos,
                        ]
                    )
                )->success();

                return redirect(route('profile.validardocs', $id));
            } else {
                flash(
                    trans(
                        'message.signaturevalidated',
                        [
                            'socio' => $socio->nombre
                            . ' '
                            . $socio->apellidos,
                        ]
                    )
                )->success();

                return redirect(route('home'));
            }
        };
    }

    /**
     * rechazarFirma: Devolver al socio a su estado inicial respecto a la importación de su
     * firma
     */
    public function rechazarFirma($id)
    {
        $documento = 'Firma';
        $socio     = $this->socios->marcasDocumentoEstadoInicial($id, $documento);

        $carpeta_firma = public_path('assets/docs/') . $id . '/adhesion';
        $this->borrarCarpetaDocumentos($carpeta_firma);

        $this->avisos->activarAviso($id, 'WIMPDADH');

        if ($socio->reciboimportado && !$socio->corrientepago) {
            flash(
                trans(
                    'message.signaturerejected',
                    [
                        'socio' => $socio->nombre
                        . ' '
                        . $socio->apellidos,
                    ]
                )
            )->success();

            return redirect(route('profile.validardocs', $id));
        } else {
            flash(
                trans(
                    'message.signaturerejected',
                    [
                        'socio' => $socio->nombre
                        . ' '
                        . $socio->apellidos,
                    ]
                )
            )->success();

            return redirect(route('home'));
        }
    }

    /**
     * altamasiva: Proceso para cargar los socios contenidos en un fichero CSV que proviene
     * de la hoja e cálculo asociada al formulario google de alta
     */
    public function altamasiva(ImportCsvFileRequest $request)
    {
        $ruta     = public_path('assets/docs/');
        $filename = 'alta masiva.csv';

        $request->file('csvfile')->move($ruta, $filename);

        Excel::filter(
            'chunk'
        )
            ->load(
                $ruta . $filename
            )
            ->chunk(
                100,
                function ($result) {
                    foreach ($result as $fila) {
                        if ($fila->nombre !== null && $fila->apellidos !== null) {
                            if ($this->socios->buscarsocioporemail($fila->email) === 0) {
                                $socio  = $this->socios->altamasivasocio($fila);
                                $recibo = $this->recibos->crearReciboUsuario($socio->id);
                            }
                        }
                    }
                }
            );

        flash(
            trans(
                'acciones_crud.massregistrationmember'
            )
        )->success();

        return redirect('backend/socios');
    }

    /**
     * obtenerUrl: Se guarda la url de la página desde la que se hace la petición
     */
    public function obtenerUrl()
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
    }

    /**
     * borrarCarpetaDocumentos: Se borra la carpeta de documentos del socio que se da de baja
     * de forma definitiva
     */
    public function borrarCarpetaDocumentos($carpeta)
    {
        $result = false;

        if ($handle = opendir("$carpeta")) {
            $result = true;

            while ((($file = readdir($handle)) !== false) && ($result)) {
                if ($file != '.' && $file != '..') {
                    if (is_dir("$carpeta/$file")) {
                        $result = $this->borrarCarpetaDocumentos("$carpeta/$file");
                    } else {
                        $result = unlink("$carpeta/$file");
                    }
                }
            }

            closedir($handle);

            if ($result) {
                $result = rmdir($carpeta);
            }
        }
        return $result;
    }
}
