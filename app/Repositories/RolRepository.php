<?php
/**
 * Created by PhpStorm.
 * User: papete
 * Date: 4/12/17
 * Time: 12:27
 */

namespace App\Repositories;


use Spatie\Permission\Models\Role;

class RolRepository
{
  protected $permiso;

  /**
   * RolRepository constructor.
   * @param PermisoRepository $permiso
   */
  public function __construct(PermisoRepository $permiso)
  {
    $this->permiso = $permiso;
  }

  /**
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function roles()
  {
    return Role::all();
  }

  /**
   * @param $id
   * @return mixed
   */
  public function buscarrolporid($id)
  {
    return Role::where('id', '=', $id)->firstOrFail();
  }

  /**
   * @param $nombre
   * @return mixed
   */
  public function buscarrolpornombre($nombre)
  {
    return Role::where('name', '=', $nombre)->first();
  }

  /**
   * @param $request
   * @return bool
   */
  public function crearrol($request)
  {
    $role = new Role();
    $role->name = $request->name;
    return $role->save();
  }

  public function updaterol($request, $id)
  {
    $role = $this->buscarrolporid($id);

    $input = $request->except(['permisos']);
    $permissions = $request['permisos'];

    $role->fill($input)->save();

    $p_all = $this->permiso->permisos();

    foreach ($p_all as $p) {
      $role->revokePermissionTo($p); //Remove all permissions associated with role
    }

    if ($permissions !== null) {
      foreach ($permissions as $permission) {
        $p = $this->permiso->buscarpermisoporid( $permission );
        $role->givePermissionTo( $p );
      }
    }
  }
}