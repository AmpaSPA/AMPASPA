<?php
/**
 * Created by PhpStorm.
 * User: papete
 * Date: 21/04/17
 * Time: 15:56
 */

namespace App\Repositories;

use App\Student;
use Illuminate\Support\Facades\DB;

class AlumnoRepository
{
    /**
   * @param $id
   * @return mixed
   */
    public function alumnos()
    {
        return Student::all();
    }

  /**
   * @param $id
   * @return mixed
   */
    public function buscaralumnoporid($id)
    {
        return Student::find($id);
    }

  /**
   * @return mixed
   */
    public function obteneralumnosenbaja()
    {
        return Student::onlyTrashed()->orderBy('anionacim')->get();
    }

  /**
   * @param $id
   * @param $request
   */
    public function updatealumno($id, $request)
    {
        $alumno = $this->buscaralumnoporid($id);

        if ($request->nombre) {
            $alumno->nombre = $request->nombre;
        }
        if ($request->anionacim) {
            $alumno->anionacim = $request->anionacim;
        }
        if ($request->course_id) {
            $alumno->course_id = $request->course_id;
        }

        $alumno->save();
        return $alumno;
    }

  /**
   * @param $id
   * @return mixed
   */
    public function borraralumno($id)
    {
        $alumno = $this->buscaralumnoporid($id);
        $alumno->delete();

        return $alumno;
    }

  /**
   * @param $id
   * @return mixed
   */
    public function restauraralumno($id)
    {
        Student::where('id', '=', $id)->restore();
        return $this->buscaralumnoporid($id);
    }

  /**
   * @param $id
   * @return mixed
   */
    public function removealumno($id)
    {
        $alumno = Student::withTrashed()->find($id);
        Student::where('id', '=', $id)->forceDelete();
        return $alumno;
    }

  /**
   * @param $id
   * @return \App\Activity[]|\Illuminate\Database\Eloquent\Collection|mixed
   */
    public function actividadesasignadasalalumno($id)
    {
        return Student::find($id)->activities;
    }

  /**
   * @param $ids
   * @return \Illuminate\Support\Collection
   */
    public function alumnosDisponiblesActividad($ids)
    {
        return DB::table('students')
        ->whereNotIn('id', $ids)
        ->get();
    }
}
