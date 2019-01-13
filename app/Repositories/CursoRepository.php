<?php
/**
 * Created by PhpStorm.
 * User: papete
 * Date: 21/04/17
 * Time: 15:56
 */

namespace App\Repositories;

use App\Course;

class CursoRepository
{
  /**
   * @param $edad
   */
  public function buscarcursoporedad($edad)
  {
    return Course::where( 'edad', '=', $edad )->first();
  }

  /**
   * @return \Illuminate\Support\Collection
   */
  public function listacursos()
  {
    return Course::all()->pluck('curso', 'id');
  }

  /**
   * @param $id
   */
  public function buscarcursoporid($id)
  {
    return Course::find($id);
  }

  /**
   * @param $id
   */
  public function buscarCursosPorColectivo($colectivo) 
  {
        return Course::where('curso', 'LIKE', $colectivo)->get();
  }

}