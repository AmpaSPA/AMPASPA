<?php
/**
 * Created by PhpStorm.
 * User: papete
 * Date: 24/06/17
 * Time: 20:21
 */

namespace App\Repositories;

use App\Period;

class PeriodoRepository
{
  /**
   * @return mixed
   */
    public function buscarPeriodoActivo()
    {
        return Period::where('activo', true)->first();
    }
}
