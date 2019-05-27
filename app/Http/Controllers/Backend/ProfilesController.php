<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use App\Repositories\SocioRepository;
use DataTables;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

/**
 * Clase del controlador para la administración de Perfiles de usuario
 */
class ProfilesController extends Controller
{
    protected $socios;

    /**
     * __construct: Constructor de la clase. Usa los modelos: User
     *
     * @param  mixed $socios
     *
     * @return void
     */
    public function __construct(SocioRepository $socios)
    {
        $this->socios = $socios;
    }

    /**
     * profile: Se presenta la página principal para la gestión del perfil del usuario
     * logueado
     */
    public function profile($id)
    {
        $profile = $this->socios->profilesocio($id);

        return view('backend.profiles.avatar', compact('id', 'profile'));
    }

    /**
     * updateAvatar: Se procesa el formulario para cambiar la imagen de avatar del socio
     * logueado
     */
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar   = $request->file('avatar');
            $filename = $avatar->getClientOriginalName();
            $ruta     = public_path('assets/images/uploads/') . $request->user_id . '/avatars/';

            $ficheros = scandir($ruta, 0);
            foreach ($ficheros as $fichero) {
                if (is_file($ruta . $fichero)) {
                    unlink($ruta . $fichero);
                }
            }
            Image::make($avatar)->resize(128, 128)->save($ruta . $filename);
            $this->socios->changeavatar($filename, $request);
        }

        return redirect()->back();
    }
    /**
     * leerInfo: Se construye y presenta la página de información de los datos del perfil
     * de usuario
     */
    public function leerInfo($id)
    {
        $profile = $this->socios->profilesocio($id);
        return view('backend.profiles.info', compact('id', 'profile'));
    }

    /**
     * updateInfo: Se proceden a actualizar los cambios que se hayan pdido hacer a los datos
     * del perfil del usuario logueado
     */
    public function updateInfo(Request $request)
    {
        $this->socios->changeprofileinfo($request);

        flash(trans('message.infoprofilechanged'))->success();
        return redirect()->route('profile.home', $request->user_id);
    }

    /**
     * inactivosdata: Se construyen las columnas: avatar, nombre y acción de la tabla de
     * usuarios que aún no tienen el estado activo
     */
    public function inactivosdata()
    {
        $inactivos = $this->socios->verificarDocumentos();

        return DataTables::of($inactivos)
            ->addColumn(
                'avatar',
                function ($inactivo) {
                    return '/assets/images/uploads/'
                    . $inactivo->profile->user_id
                    . '/avatars/'
                    . $inactivo->profile->avatar;
                }
            )
            ->addColumn(
                'nombre',
                function ($inactivo) {
                    return $inactivo->nombre
                    . ' '
                    . $inactivo->apellidos;
                }
            )
            ->addColumn(
                'action',
                function ($inactivo) {
                    $btnFirma  = null;
                    $btnRecibo = null;
                    $btnDomiciliacion = null;

                    if (!$inactivo->firmacorrecta && $inactivo->firmaimportada) {
                        $btnFirma = '<i class="text-warning fa fa-search"></i>'
                        . '<a id="btver" href="'
                        . route('socios.validarfirma', $inactivo->id)
                        . '">'
                        . '<span class="text-warning texto-accion">'
                        . trans('message.verifysignature')
                            . '</span>'
                            . '</a>';
                    }

                    if (!$inactivo->corrientepago && $inactivo->reciboimportado) {
                        if ($inactivo->paymenttype->tipopago === 'Domiciliación a mi cuenta') {
                            $btnDomiciliacion = '<i class="text-success fa fa-check"></i>'
                            . '<a id="btver" href="'
                            . route('socios.confirmarrecibo', $inactivo->id)
                            . '">'
                            . '<span class="text-success texto-accion">'
                            . trans('acciones_crud.validatebank')
                                . '</span>'
                                . '</a>';
                        } else {
                            $btnRecibo = '<i class="text-success fa fa-search"></i>'
                            . '<a id="btver" href="'
                            . route('socios.validarrecibo', $inactivo->id)
                            . '">'
                            . '<span class="text-success texto-accion">'
                            . trans('message.verifyreceipt')
                                . '</span>'
                                . '</a>';
                        }
                    }

                    return $btnFirma . ' ' . $btnRecibo . ' ' . $btnDomiciliacion;
                }
            )
            ->make(true);
    }

    /**
     * tusHijos: Se construye la pantalla para la visualización de los hijos del socio logueado
     */
    public function tusHijos($id)
    {
        $socio = $this->socios->buscarsocioporid($id);
        $hijos = $socio->students;
        return view('backend.profiles.tushijos', compact('socio', 'hijos'));
    }
}
