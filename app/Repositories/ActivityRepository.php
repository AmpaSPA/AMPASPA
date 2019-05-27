<?php

/**
 * Created by PhpStorm.
 * User: papete
 * Date: 22/06/17
 * Time: 0:47
 */

namespace App\Repositories;

use App\Activity;
use App\Activitytarget;
use App\Activitytype;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ActivityRepository
{
    protected $periodos;
    protected $tiposActividad;
    protected $facturas;

    /**
     * ActivityRepository constructor.
     * @param PeriodoRepository $periodos
     */
    public function __construct(
        PeriodoRepository $periodos,
        ActivitytypeRepository $tiposActividad,
        FacturaRepository $facturas
    ) {
        $this->periodos       = $periodos;
        $this->tiposActividad = $tiposActividad;
        $this->facturas       = $facturas;
    }

    /**
     * buscaractividadporid
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function buscaractividadporid($id)
    {
        return Activity::find($id);
    }

    /**
     * buscaractividadsinalumno
     *
     * @return void
     */
    public function buscaractividadsinalumno()
    {
        return Activity::doesntHave('students')->get();
    }

    /**
     * actividades
     *
     * @return void
     */
    public function actividades()
    {
        return Activity::wherePeriodo($this->periodos->buscarPeriodoActivo()->periodo)->get();
    }

    /**
     * tiposactividad
     *
     * @return void
     */
    public function tiposactividad()
    {
        return Activitytype::all()->pluck('tipoactividad', 'id');
    }

    /**
     * colectivosactividad
     *
     * @return void
     */
    public function colectivosactividad()
    {
        return Activitytarget::all()->pluck('colectivo', 'id');
    }

    /**
     * crearactividad
     *
     * @param  mixed $request
     *
     * @return void
     */
    public function crearactividad($request)
    {
        $periodo = $this->periodos->buscarPeriodoActivo();

        $data                    = new Activity();
        $data->periodo           = $periodo->periodo;
        $data->fechaactividad    = $request->fechaactividad;
        $data->nombre            = strtoupper($request->nombre);
        $data->descripcion       = $request->descripcion;
        $data->activitytype_id   = $request->activitytype_id;
        $data->activitytarget_id = $request->activitytarget_id;

        switch ($this->tiposActividad->buscarTipoActividadPorId($request->activitytype_id)) {
            case 'COLEGIO':
                if ($request->subvencion >= 0) {
                    $data->subvencion = $request->subvencion;
                    $data->precio     = $request->subvencion;
                }
                break;
            case 'AMPA':
                $data->subvencion = 0;
                if ($request->precio >= 0) {
                    $data->precio = $request->precio;
                }
                break;
            default:
                $data->subvencion = 0;
                $data->precio     = 0;
                break;
        }

        $data->save();

        return $data;
    }

    /**
     * updateactividad
     *
     * @param  mixed $id
     * @param  mixed $request
     *
     * @return void
     */
    public function updateactividad($id, $request)
    {
        $actividad = $this->buscaractividadporid($id);

        if ($request->fechaactividad) {
            $actividad->fechaactividad = $request->fechaactividad;
        }
        if ($request->nombre) {
            $actividad->nombre = strtoupper($request->nombre);
        }
        if ($request->descripcion) {
            $actividad->descripcion = $request->descripcion;
        }
        if ($request->activitytype_id) {
            $actividad->activitytype_id = $request->activitytype_id;
        }
        if ($request->activitytarget_id) {
            $actividad->activitytarget_id = $request->activitytarget_id;
        }

        switch ($this->tiposActividad->buscarTipoActividadPorId($request->activitytype_id)) {
            case 'COLEGIO':
                if ($request->subvencion >= 0) {
                    $actividad->subvencion = $request->subvencion;
                    $actividad->precio     = $request->subvencion;
                }
                break;
            case 'AMPA':
                $actividad->subvencion = 0;
                if ($request->precio >= 0) {
                    $actividad->precio = $request->precio;
                }
                break;
            default:
                $actividad->subvencion = 0;
                $actividad->precio     = 0;
                break;
        }

        $actividad->save();

        return $actividad;
    }

    /**
     * removeactividad
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function removeactividad($id)
    {
        return Activity::where('id', '=', $id)->forceDelete();
    }

    /**
     * actividadesdisponiblesalumno
     *
     * @param  mixed $ids
     *
     * @return void
     */
    public function actividadesdisponiblesalumno($ids)
    {
        return DB::table('activities')
            ->whereNotIn('id', $ids)
            ->get();
    }

    /**
     * autorizarActividadPivot
     *
     * @param  mixed $id_alumno
     * @param  mixed $id_actividad
     *
     * @return void
     */
    public function autorizarActividadPivot($id_alumno, $id_actividad)
    {
        return DB::table('activity_student')
            ->where('student_id', '=', $id_alumno)
            ->where('activity_id', '=', $id_actividad)
            ->update(array('authorized' => true));
    }

    /**
     * desautorizarActividadPivot
     *
     * @param  mixed $id_alumno
     * @param  mixed $id_actividad
     *
     * @return void
     */
    public function desautorizarActividadPivot($id_alumno, $id_actividad)
    {
        return DB::table('activity_student')
            ->where('student_id', '=', $id_alumno)
            ->where('activity_id', '=', $id_actividad)
            ->update(array('authorized' => false));
    }

    /**
     * alumnoActividad
     *
     * @param  mixed $id_alumno
     * @param  mixed $id_actividad
     *
     * @return void
     */
    public function alumnoActividad($id_alumno, $id_actividad)
    {
        return DB::table('activity_student')
            ->where('student_id', '=', $id_alumno)
            ->where('activity_id', '=', $id_actividad)
            ->get();
    }

    /**
     * totalAutorizaciones
     *
     * @param  mixed $id_actividad
     *
     * @return void
     */
    public function totalAutorizaciones($id_actividad)
    {
        return DB::table('activity_student')
            ->where('activity_id', '=', $id_actividad)
            ->where('authorized', '=', true)
            ->count();
    }

    /**
     * obtenerActividadesPublicadas
     *
     * @return void
     */
    public function obtenerActividadesPublicadas()
    {
        return Activity::All()->where('publicada', true)->where('cerrada', false);
    }

    /**
     * obtenerActividadesNoPublicadas
     *
     * @return void
     */
    public function obtenerActividadesNoPublicadas()
    {
        return Activity::All()->where('publicada', false)->where('cerrada', false);
    }

    /**
     * marcarActividad
     *
     * @param  mixed $actividad
     * @param  mixed $marca
     *
     * @return void
     */
    public function marcarActividad($actividad, $marca)
    {
        $actividad->publicada = $marca;
        return $actividad->save();
    }

    /**
     * alumnosAsignadosActividad
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function alumnosAsignadosActividad($id)
    {
        return Activity::find($id)->students;
    }

    /**
     * cerrarActividades: Se marcan como cerradas todas las actividades cuya fecha es menor a la actual. En caso de
     * tratarse de una actividad subvencionada se crea una factura para registrar el importe de dicha subvención. En
     * caso de tratarse de una actividad para socios no gratuita organizada por la AMPA, también se crea una factura
     * que regsitre el total que se recaude.
     *
     * @return void
     */
    public function cerrarActividades()
    {
        if ($this->actividades()->count() > 0) {
            foreach ($this->actividades() as $actividad) {
                if ($actividad->fechaactividad < Carbon::now()->format('Y-m-d')) {
                    if ($actividad->students()->count() > 0) {
                        $datosFactura = [
                            'periodo'      => $actividad->periodo,
                            'fecha'        => $actividad->fechaactividad,
                            'emisor'       => null,
                            'destinatario' => null,
                            'concepto'     => null,
                            'factura'      => null,
                            'importe'      => $actividad->students()->count() * $actividad->precio,
                            'importada'    => false,
                        ];
                        switch ($actividad->activitytype->tipoactividad) {
                            case 'COLEGIO':
                                $datosFactura['emisor']       = 'AMPASPAB';
                                $datosFactura['destinatario'] = 'COLEGIO';
                                $datosFactura['concepto']     = 'Pago de la subvención de la actividad: '
                                . $actividad->nombre;
                                $factura = $this->facturas->crearFacturaAutomatica($datosFactura);
                                break;
                            case 'AMPA':
                                if ($datosFactura['importe'] != 0) {
                                    $datosFactura['emisor']       = 'RECAUDACIÓN DE LA ACTIVIDAD: ' . $actividad->nombre;
                                    $datosFactura['destinatario'] = 'COLEGIO';
                                    $datosFactura['concepto']     = 'Pago de la subvención de la actividad '
                                    . $actividad->nombre;
                                    $factura = $this->facturas->crearFacturaAutomatica($datosFactura);
                                }
                                break;
                        }
                    }

                    $actividad->cerrada = true;
                    return $actividad->save();
                }
            }
        } else {
            return;
        }
    }
}
