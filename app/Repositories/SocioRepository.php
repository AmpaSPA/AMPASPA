<?php
/**
 * Repositorio para acceder a los datos de los socios: Tabla User
 * Se accederá también a todas las tablas relacionadas para obtener los valores correspondientes a las
 * claves foráneas que contiene.
 */

namespace App\Repositories;

use App\Doctype;
use App\Membertype;
use App\Paymenttype;
use App\Profile;
use App\Repositories\CursoRepository;
use App\Student;
use App\User;
use Auth;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class SocioRepository
{
    protected $cursos;
    protected $profile;
    protected $periodos;

    /**
     * SocioRepository constructor.
     * @param \App\Repositories\CursoRepository $cursos
     * @param ProfileRepository $profile
     */
    public function __construct(CursoRepository $cursos, ProfileRepository $profile, PeriodoRepository $periodos)
    {
        $this->cursos = $cursos;
        $this->profile = $profile;
        $this->periodos = $periodos;
    }

    /**
     * @return int
     */
    public function totalsocios(): int
    {
        return User::where('corrientepago', true)->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function socioAutenticado()
    {
        return Auth::user();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function socios()
    {
        return User::where('corrientepago', true)->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function buscarsocioporid($id)
    {
        return User::find($id);
    }

    /**
     * @param $email
     * @return int
     */
    public function buscarsocioporemail($email)
    {
        return User::where('email', '=', $email)->count();
    }

    /**
     * @param $id
     * @param $request
     * @return SocioRepository|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static[]
     */
    public function updatesocio($id, $request)
    {
        $socio = $this->buscarsocioporid($id);
        if ($request->nombre) {
            $socio->nombre = $request->nombre;
        }
        if ($request->apellidos) {
            $socio->apellidos = $request->apellidos;
        }
        if ($request->doctype_id) {
            $socio->doctype_id = $request->doctype_id;
        }
        if ($request->numdoc) {
            $socio->numdoc = $request->numdoc;
        }
        if ($request->telefono) {
            $socio->telefono = $request->telefono;
        }
        if ($request->membertype_id) {
            $socio->membertype_id = $request->membertype_id;
        }
        if ($request->paymenttype_id) {
            $socio->paymenttype_id = $request->paymenttype_id;
        }
        if ($request->corrientepago) {
            $socio->corrientepago = $request->corrientepago;
        }
        if ($request->reciboimportado) {
            $socio->reciboimportado = $request->reciboimportado;
        }
        if ($request->firmacorrecta) {
            $socio->firmacorrecta = $request->firmacorrecta;
        }
        if ($request->firmaimportada) {
            $socio->firmaimportada = $request->firmaimportada;
        }
        if ($request->activo) {
            $socio->activo = $request->activo;
        }

        $socio->save();
        return $socio;
    }

    /**
     * @param $request
     */
    public function updateclavesocio($request)
    {
        User::where('email', '=', Auth::user()->email)->update(['password' => bcrypt($request->password)]);
    }

    /**
     * @param $request
     * @return User
     */
    public function crearsocio($request): \App\User
    {
        $periodo = $this->periodos->buscarPeriodoActivo()->periodo;

        // Se crea el usuario
        $data = new User();
        $data->periodo = $periodo;
        $data->nombre = $request->nombre;
        $data->apellidos = $request->apellidos;
        $data->email = $request->email;
        $data->telefono = $request->telefono;
        $data->doctype_id = $request->doctype_id;
        $data->numdoc = $request->numdoc;
        $data->membertype_id = $request->membertype_id;
        $data->paymenttype_id = $request->paymenttype_id;
        $data->save();

        // Se crea el registro del perfil del usuario
        $this->profile->crearprofile($data->id);

        $avatar = public_path('assets/images/avatar_default.png');
        $ruta = public_path('assets/images/uploads/') . $data->id . '/avatars/';
        @mkdir($ruta, 0777, true);
        @copy($avatar, $ruta . 'avatar_default.png');

        // Se asigna el rol "Socio" al nuevo usuario

        $data->assignRole('Socio');

        return $data;
    }

    /**
     * @param $item
     * @return mixed
     */
    public function altamasivasocio($item)
    {
        $hijo = [];
        $anionacim = [];
        $numhijos = (int) $item->numhijos;

        switch ($numhijos) {
            case 1:
                list($hijo[1],
                    $anionacim[1]
                ) = explode(':', $item->hijos);
                break;
            case 2:
                list($hijo[1],
                    $anionacim[1],
                    $hijo[2],
                    $anionacim[2]
                ) = explode(':', $item->hijos);
                break;
            case 3:
                list(
                    $hijo[1],
                    $anionacim[1],
                    $hijo[2],
                    $anionacim[2],
                    $hijo[3],
                    $anionacim[3]
                ) = explode(':', $item->hijos);
                break;
            case 4:
                list($hijo[1],
                    $anionacim[1],
                    $hijo[2],
                    $anionacim[2],
                    $hijo[3],
                    $anionacim[3],
                    $hijo[4],
                    $anionacim[4]
                ) = explode(':', $item->hijos);
                break;
            case 5:
                list($hijo[1],
                    $anionacim[1],
                    $hijo[2],
                    $anionacim[2],
                    $hijo[3],
                    $anionacim[3],
                    $hijo[4],
                    $anionacim[4],
                    $hijo[5],
                    $anionacim[5]
                ) = explode(':', $item->hijos);
                break;
        }

        // Alta del socio
        $periodo = $this->periodos->buscarPeriodoActivo()->periodo;
        $data = new User();
        $data->periodo = $periodo;
        $data->nombre = $item->nombre;
        $data->apellidos = $item->apellidos;
        $data->email = $item->email;
        $data->telefono = substr($item->telefono, 0, 9);
        $data->numdoc = $item->numdoc;
        $data->save();

        // Se asigna al usuario el rol "Socio"
        $data->assignRole('Socio');

        // Alta de su perfil
        $this->profile->crearprofile($data->id);

        // Se guarda el avatar por defecto apuntado en el perfil
        $avatar = public_path('assets/images/avatar_default.png');
        $ruta = public_path('assets/images/uploads/') . $data->id . '/avatars/';
        @mkdir($ruta, 0777, true);
        @copy($avatar, $ruta . 'avatar_default.png');

        // Alta de los hijos del socio
        for ($i = 1; $i <= $numhijos; $i++) {
            $alumno = new Student();
            $alumno->nombre = $hijo[$i];
            $alumno->anionacim = $anionacim[$i];

            $edad = Carbon::now()->year - $anionacim[$i];
            $curso = $this->cursos->buscarcursoporedad($edad);

            if ($edad > 15) {
                $alumno->course_id = 19;
            } elseif ($edad < 3) {
                $alumno->course_id = 1;
            } else {
                $alumno->course_id = $curso->id;
            }

            $alumno->user_id = $data->id;
            $socio = $this->buscarsocioporid($data->id);

            $socio->students()->save($alumno);
        }

        return $item;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     * @throws \Exception
     */
    public function borrarsocio($id)
    {
        Student::where('user_id', '=', $id)->delete();
        Profile::where('user_id', '=', $id)->delete();
        $socio = $this->buscarsocioporid($id);
        $socio->delete();
        return $socio;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function restaurarsocio($id)
    {
        Student::where('user_id', '=', $id)->restore();
        Profile::where('user_id', '=', $id)->restore();
        $socio = User::where('id', '=', $id);
        $socio->restore();
        return $socio;
    }

    /**
     * @param $id
     * @return string
     */
    public function removesocio($id)
    {
        // Se toman todos los datos del socio a borrar
        $socio = User::withTrashed()->find($id);

        // Se borra el documento de adhesión
        $ruta_docadhesion = public_path('assets/docs/');
        unlink($ruta_docadhesion . $socio->numdoc . '.pdf');

        // Se borra el avatar
        $ruta_avatar = public_path('assets/images/uploads/') . $id . '/avatars/';
        $files = scandir($ruta_avatar, SCANDIR_SORT_ASCENDING);
        foreach ($files as $file) {
            if (!is_dir($file)) {
                unlink($ruta_avatar . $file);
            }
        }
        rmdir($ruta_avatar);
        rmdir(public_path('assets/images/uploads/') . $id);

        $nombre_socio = $socio->nombre . ' ' . $socio->apellidos;

        // Se borran hijos, perfil y por último el propio socio
        Student::where('user_id', '=', $id)->forceDelete();
        Profile::where('user_id', '=', $id)->forceDelete();
        User::where('id', '=', $id)->forceDelete();

        return $nombre_socio;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function alumnosporsocio($id)
    {
        return $this->buscarsocioporid($id)->students()->orderBy('anionacim')->get();
    }

    /**
     * @param $id
     * @return int
     */
    public function numhijossocio($id)
    {
        return $this->buscarsocioporid($id)->students->count();
    }

    /**
     * @param $request
     * @return Student
     */
    public function crearalumnoporsocio($request)
    {
        $edad = Carbon::now()->year - $request->anionacim;
        $curso = $this->cursos->buscarcursoporedad($edad);

        $data = new Student();
        $data->nombre = $request->nombre;
        $data->anionacim = $request->anionacim;

        if ($edad > 15) {
            $data->course_id = 19;
        } else {
            $data->course_id = $curso->id;
        }

        $data->user_id = $request->user_id;

        $socio = $this->buscarsocioporid($request->user_id);

        $socio->students()->save($data);

        return $data;
    }

    /**
     * @param $id
     * @return \App\Profile|mixed
     */
    public function profilesocio($id)
    {
        return $this->buscarsocioporid($id)->profile;
    }

    /**
     * @param $filename
     * @param $request
     */
    public function changeavatar($filename, $request)
    {
        $profile = $this->profilesocio($request->user_id);
        $profile->avatar = $filename;
        $profile->save();
    }

    /**
     * @param $filename
     * @param $id
     */
    public function changefirma($filename, $id)
    {
        $profile = $this->profilesocio($id);
        $profile->firma = $filename;
        $profile->save();
    }

    /**
     * @param $filename
     * @param $id
     */
    public function changerecibo($filename, $id)
    {
        $profile = $this->profilesocio($id);
        $profile->recibo = $filename;
        $profile->save();
    }

    /**
     * @param $request
     */
    public function changeprofileinfo($request)
    {
        $profile = $this->profilesocio($request->user_id);
        $profile->bio = $request->bio;
        $profile->aficiones = $request->aficiones;
        $profile->profesion = $request->profesion;
        $profile->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function buscartipodocumento($id)
    {
        return $this->buscarsocioporid($id)->doctype->tipodoc;
    }

    /**
     * @param $id
     * @return mixed|string
     */
    public function buscartipopago($id)
    {
        return $this->buscarsocioporid($id)->paymenttype->tipopago;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function buscartiposocio($id)
    {
        return $this->buscarsocioporid($id)->membertype->tiposocio;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function listaNombreSocio()
    {
        return User::all()->pluck('fullname', 'id');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function tiposdoc()
    {
        return Doctype::all()->pluck('tipodoc', 'id');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function tipospago()
    {
        return Paymenttype::all()->pluck('tipopago', 'id');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function tipossocio()
    {
        return Membertype::all()->pluck('tiposocio', 'id');
    }

    /**
     * @return mixed
     */
    public function obtenersociosenbaja()
    {
        return User::onlyTrashed()->get();
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function firmaCorrecta($id)
    {
        $socio = $this->buscarsocioporid($id);

        $socio->firmacorrecta = true;
        return $socio->save();
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function corrientePago($id)
    {
        $socio = $this->buscarsocioporid($id);

        $socio->corrientepago = true;
        return $socio->save();
    }

    /**
     * [justificantePago description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function reciboImportado($id)
    {
        $socio = $this->buscarsocioporid($id);

        $socio->reciboimportado = true;
        $socio->save();

        return $socio;
    }

    /**
     * [justificantePago description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function firmaImportada($id)
    {
        $socio = $this->buscarsocioporid($id);

        $socio->firmaimportada = true;
        $socio->save();

        return $socio;
    }

    /**
     * Se marca al socio como activo si tiene todos sus documetos subidos a la aplicación y validados por la AMPA
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function activarSocio($id)
    {
        $socio = $this->buscarsocioporid($id);

        if ($socio->corrientepago && $socio->firmacorrecta) {
            $socio->activo = true;
            $socio->save();

            $this->profile->activarprofile($id);
        }

        return $socio;
    }

    /**
     * @param $rol
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function buscarsociosporrol($rol)
    {
        return User::role($rol)->get();
    }

    /**
     * Se obtienen los socios que han subido su recibo o su firma o ambos documentos
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function obtenerDocsImportados()
    {
        return User::where('reciboimportado', true)->orWhere('firmaimportada', true)->get();
    }

    /**
     * Se obtienen los socios que han subido su recibo o su firma o ambos documentos
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function verificarDocumentos()
    {
        return User::where(
            [
                [
                    'reciboimportado', true,
                ], [
                    'corrientepago', false,
                ],
            ]
        )->orWhere([['firmaimportada', true], ['firmacorrecta', false]])->get();
    }

    /**
     * Se obtienen los socios que tienen alguno de sus documentos sin subir a la aplicación
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function obtenerDocsPendientesImportar()
    {
        return User::where('reciboimportado', false)->orWhere('firmaimportada', false)->get();
    }

    public function marcasDocumentoEstadoInicial($id, $documento)
    {
        $socio = $this->buscarsocioporid($id);

        if ($documento == 'Recibo') {
            $socio->reciboimportado = false;
            $socio->corrientepago = false;
        } elseif ($documento == 'Firma') {
            $socio->firmaimportada = false;
            $socio->firmacorrecta = false;
        }

        $socio->save();

        return $socio;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function noseleccionarunid($id)
    {
        return User::where('id', '<>', $id)->where('reciboimportado', '=', true)->get();
    }

    public function totalSociosPeriodo($periodo)
    {
        return User::wherePeriodo($periodo)->count();
    }
}
