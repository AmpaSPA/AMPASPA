<?php
/**
 * Created by PhpStorm.
 * User: papete
 * Date: 3/12/17
 * Time: 18:35
 */

namespace App\Repositories;


use Spatie\Permission\Models\Permission;

class PermisoRepository
{
  /**
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function permisos()
  {
    return Permission::all();
  }

  /**
   * @param $id
   * @return mixed
   */
  public function buscarpermisoporid($id)
  {
    return Permission::findOrFail($id);
  }

  /**
   * @param $nombre
   * @return mixed
   */
  public function buscarpermisopornombre($nombre)
  {
    return Permission::where('name', '=', $nombre)->first();
  }

  /**
   * @param $request
   */
  public function crearpermiso($request)
  {
    $permission = new Permission();
    $permission->name = $request->name;
    $permission->save();

    return $permission;
  }

  /**
   * @param $request
   * @param $id
   * @return mixed
   */
  public function updatepermiso($request, $id)
  {
    $permission = $this->buscarpermisoporid($id);
    $input = $request->all();
    $permission->fill($input)->save();
    return $permission;
  }
}