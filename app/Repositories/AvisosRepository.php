<?php

/**
 * Created by PhpStorm.
 * User: papete
 * Date: 22/06/17
 * Time: 0:47
 */

namespace App\Repositories;

use App\Warning;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AvisosRepository
{
    protected $socios;

    /**
     * SociosController constructor.
     * @param SocioRepository $socios
     */
    public function __construct(SocioRepository $socios)
    {
        $this->socios = $socios;
    }
    /**
     * Se localiza el aviso según un código y para un usuario concreto. En caso de encontrarse se devuelven las
     * propiedades del modelo aviso, si no se encuentra, se crea la fila correspondiente e la tabla asociada al
     * modelo aviso en la BBDD
     * @param $aviso
     * @return Warning
     */
    public function crearAviso($codigo, $fecha, $aviso, $solucion, $user_id)
    {
        $aviso = Warning::firstOrCreate([
            'codigo' => strtoupper($codigo),
            'user_id' => $user_id,

        ], [
            'fecha' => $fecha,
            'aviso' => $aviso,
            'solucion' => $solucion,
        ]);

        return;
    }

    /**
     * Si el aviso está cerrado se devuelve verdadero en caso contrario se devuelve falso
     * @param  $id Integer
     * @param  $codigo String
     * @return Boolean
     */
    public function avisoCerrado($id, $codigo)
    {
        if ($id !== Auth::user()->id) {
            switch ($codigo) {
                case 'WIMPDADH':
                    $fecha = Carbon::now()->format('Y-m-d');
                    $aviso = 'Por favor, Ud. debe hacernos llegar el documento de acuerdo de adhesión que en su día le fue remitido por esta AMPA. Dicho documento deberá estar firmado por Ud.';
                    $solucion = 'Realice una de las siguientes acciones: a) Imprímalo, fírmelo y escanéelo en formato pdf y súbalo a esta aplicación. Si desea optar por esta solución abra el desplegable con su nombre en la parte superior de la página y acceda a su perfil donde encontrará la opción correspondiente. b) imprímalo, fírmelo y deposítelo en nuestro buzón. c) imprímalo, fírmelo y entréguelo personalmente en nuestro despacho sito en la planta superior sobre la secretaría del colegio. d) Acuda a nuestro despacho y firme la copia de su documento que obra en nuestro poder.';
                    $user_id = $id;

                    $this->crearAviso($codigo, $fecha, $aviso, $solucion, $user_id);
                    break;
                case 'WIMPRECI':
                    $fecha = Carbon::now()->format('Y-m-d');
                    $aviso = 'Por favor, Ud. debe hacernos llegar el recibo o justificante del pago de su cuota de socio.';
                    $solucion = 'Realice una de las siguientes acciones: a) Escanéelo en formato pdf y súbalo a esta aplicación. Si desea optar por esta solución abra el desplegable con su nombre en la parte superior de la página y acceda a su perfil donde encontrará la opción correspondiente. b) deposítelo en nuestro buzón. c) entréguelo personalmente en nuestro despacho sito en la planta superior sobre la secretaría del colegio.';
                    $user_id = $id;

                    $this->crearAviso($codigo, $fecha, $aviso, $solucion, $user_id);
                    break;
            }
        }

        $socio = $this->socios->buscarsocioporid($id);
        $aviso = $socio->warnings->where('codigo', $codigo)->where('user_id', $id)->first();
        if (!$aviso) {
            return;
        } else {
            return $aviso->cerrado;
        }
    }

    /**
     * Se obtienen los avisos que no estén cerrados
     * @return Integer count(warnings)
     */
    public function avisosAbiertos()
    {
        return Auth::user()->warnings->where('cerrado', false);
    }

    /**
     * Se actualiza la marca de cerrado del aviso a true
     * @param  Integer $id
     * @return
     */
    public function desactivarAviso($id, $codigo)
    {
        $socio = $this->socios->buscarsocioporid($id);
        $aviso = $socio->warnings->where('codigo', $codigo)->where('user_id', $id)->first();

        if ($aviso) {
            $aviso->cerrado = true;
            $aviso->save();
        }

        return $aviso;
    }

    /**
     * Se actualiza la marca de cerrado del aviso a false
     * @param  Integer $id
     * @return
     */
    public function activarAviso($user_id, $codigo)
    {
        $aviso = Auth::user()->warnings->where('codigo', $codigo)->where('user_id', $user_id)->first();

        if ($aviso) {
            $aviso->fecha = Carbon::now()->format('Y-m-d');
            $aviso->cerrado = false;
            $aviso->save();
        }

        return $aviso;
    }
}
