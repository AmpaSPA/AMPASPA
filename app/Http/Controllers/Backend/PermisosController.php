<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CreatePermissionRequest;
use App\Repositories\PermisoRepository;
use App\Repositories\RolRepository;
use App\Repositories\SocioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase del controlador para la administración de los permisos de acceso a las diferentes
 * partes de la aplicación
 */
class PermisosController extends Controller
{
    protected $socios;
    protected $permiso;
    protected $rol;

    /**
     * PermisosController: Constructor de la clase usa los modelos: User, Permission y Role
     */
    public function __construct(SocioRepository $socios, PermisoRepository $permiso, RolRepository $rol)
    {
        $this->socios = $socios;
        $this->permiso = $permiso;
        $this->rol = $rol;
    }

    /**
     * permisosdata: Se construye la columna action de la tabla de permisos por medio de
     * JavaScript Datatables
     */
    public function permisosdata()
    {
        $permisos = $this->permiso->permisos();

        return DataTables::of($permisos)
        ->addColumn(
            'action',
            function ($permiso) {
                $btnEditar = '<i class="text-warning fa fa-pencil"></i>'
                . '<a href="'
                . url('backend/permisos/edit/'.$permiso->id)
                . '">'
                . '<span class="text-warning texto-accion">'
                .trans('acciones_crud.edit')
                . '</span>'
                . '</a>';
                $btnEliminar = '<i class="text-danger fa fa-trash"></i>'
                . '<a href="'
                .url('backend/permisos/borrar/'.$permiso->id)
                . '">'
                . '<span class="text-danger texto-accion">'
                .trans('acciones_crud.delete')
                . '</span>'
                .'</a>';

                return $btnEditar.' '.$btnEliminar;
            }
        )
        ->make(true);
    }

    /**
     * store: Se crea un nuevo permiso en la BBDD.
     */
    public function store(CreatePermissionRequest $request)
    {
        $permission = $this->permiso->crearpermiso($request);

        flash(trans('acciones_crud.addedpermission', ['permiso' => $permission->name]))->success();
        return redirect()->route('permisos.list');
    }

    /**
     * edit: Se muestran los datos del permiso seleccionado para poder ser actualizado.
     */
    public function edit($id)
    {
        $permiso = $this->permiso->buscarpermisoporid($id);
        return view('backend.permisos.edit', compact('permiso'));
    }

    /**
     * update: Se procede a actualizar los datos del permiso seleccionado
     */
    public function update(CreatePermissionRequest $request, $id)
    {
        $permiso = $this->permiso->updatepermiso($request, $id);

        flash(trans('acciones_crud.updatedpermission', ['permiso' => $permiso->name]))->success();
        return redirect()->route('permisos.list');
    }

    /**
     * delete: Se selecciona el permiso de una lista a ser eliminado de la BBDD
     */
    public function delete($id)
    {
        $permiso = $this->permiso->buscarpermisoporid($id);
        // No borrar el permiso: Administrar roles y permisos
        if ($permiso->name === 'Administrar roles y permisos') {
            flash(trans('acciones_crud.nodeletepermission', ['permiso' => $permiso->name]))->error();
            return redirect()->route('permisos.list');
        }
        return view('backend.permisos.delete', compact('permiso'));
    }

    /**
     * destroy: Se borra el permiso seleccionado de la BBDD
     */
    public function destroy($id)
    {
        $permiso = $this->permiso->buscarpermisoporid($id);
        $permiso->delete();

        flash(trans('acciones_crud.deletedpermission', ['permiso' => $permiso->name]))->success();
        return redirect()->route('permisos.list');
    }

    /**
     * detach: Se desasigna el permmiso seleccionado del rol también seleccionado
     */
    public function detach($id_rol, $id_permiso)
    {
        $role = $this->rol->buscarrolporid($id_rol);
        $p = $this->permiso->buscarpermisoporid($id_permiso);

        $role->revokePermissionTo($p);

        if ($p->roles->count() > 0) {
            flash(
                trans(
                    'acciones_crud.unassignatedpermission',
                    ['permiso' => $p->name, 'rol' => $role->name]
                )
            )->success();
            return redirect(route('permisos.delete', $id_permiso));
        } else {
            flash(
                trans(
                    'acciones_crud.unassignatedpermission',
                    ['permiso' => $p->name, 'rol' => $role->name]
                )
            )->success();
            return redirect(route('permisos.list'));
        }
    }

    /**
     * userpermissionsdata: Se construyen las columnas permiso y action en la lista de roles
     * para dar o quitar permisos a un rol seleccionado
     */
    public function userspermissionsdata()
    {
        $accounts = $this->socios->socios();
        $id_administrador = $this->buscarIdAdministrador($accounts);
        $users = $this->socios->noseleccionarunid($id_administrador);

        return DataTables::of($users)
        ->addColumn(
            'permiso',
            function ($user) {
                return $user->permissions()->pluck('name')->implode(', ');
            }
        )
        ->addColumn(
            'action',
            function ($user) {
                $btnOtorgarPermiso = '';
                $total_permisos_roles_usuario = 0;
                $sin_roles = true;

                $roles = $user->roles;

                foreach ($roles as $role) {
                    $sin_roles = false;
                    $total_permisos_roles_usuario += $role->permissions->count();
                }

                if ($user->permissions->count() + $total_permisos_roles_usuario + 1 <
                 $this->permiso->permisos()->count() || ($sin_roles && $user->permissions
                 ->count() === 0)) {
                    $btnOtorgarPermiso = '<i class="text-success fa fa-link"></i>'
                    . '<a href="'
                    . url('backend/permisos/asignarpermiso/usuario/'.$user->id)
                    . '">'
                    . '<span class="text-success texto-accion">'
                    . trans('acciones_crud.givepermission')
                    . '</span>'
                    . '</a>';
                }

                $btnRevocarPermiso = '';
                if ($user->permissions->count() > 0) {
                    $btnRevocarPermiso = '<i class="text-danger fa fa-unlink"></i>'
                    . '<a href="'
                    . url('backend/permisos/desasignarpermiso/usuario/'.$user->id)
                    . '">'
                    . '<span class="text-danger texto-accion">'
                    . trans('acciones_crud.revoquepermission')
                    . '</span>'
                    . '</a>';
                }

                return $btnOtorgarPermiso . ' ' . $btnRevocarPermiso;
            }
        )
        ->make(true);
    }

    /**
    * asignarpermisoausuario: Se construye la página con los permisos disponibles para un
    * usuario seleccionado
    */
    public function asignarpermisoausuario($id)
    {
        $accion = 'otorgar';

        $account = $this->socios->buscarsocioporid($id);
        $permisos = $this->permiso->permisos();

        $permisos_usuario = $account->permissions()->pluck('name')->implode(', ');

        $roles = $account->roles;
        $permisos_rol = [];

        foreach ($roles as $role) {
            $permisos_rol[] = array
            (
            'rol' => $role->name,
            'permisos' => $role->permissions()->pluck('name')->implode(', ')
            );
        }

        $permisos_disponibles = [];
        $permiso_disponible = 0;

        foreach ($permisos as $permiso) {
            if (!$account->hasPermissionTo($permiso->name)) {
                $algun_administrador = false;
                if ($permiso->name === 'Administrar roles y permisos') {
                    $algun_administrador = $this->buscarPermisoAdministrador();
                }

                if (!$algun_administrador) {
                    ++$permiso_disponible;
                    $permisos_disponibles[] = array
                    (
                    'id' => $permiso->id,
                    'name' => $permiso->name
                    );
                }
            }
        }
        if ($permiso_disponible > 0) {
            return view(
                'backend.permisos.disponibles',
                compact(
                    'accion',
                    'account',
                    'permisos_usuario',
                    'permisos_rol',
                    'permisos_disponibles'
                )
            );
        } else {
            flash(
                trans(
                    'message.nopermissionsavailable',
                    ['usuario' => $account->nombre . ' ' . $account->apellidos]
                )
            )->success();
            return redirect()->route('permisos.accounts');
        }
    }

    /**
     * otorgarpermiso: Se otorga un permiso seleccionado a un usuario seleccionado
     */
    public function otorgarpermiso($id_usuario, $id_permiso)
    {
        $permiso = $this->permiso->buscarpermisoporid($id_permiso);
        $usuario = $this->socios->buscarsocioporid($id_usuario);

        $usuario->givePermissionTo($permiso->name);

        $total_permisos_roles_usuario = 0;
        $roles = $usuario->roles;

        foreach ($roles as $role) {
            $total_permisos_roles_usuario += $role->permissions->count();
        }

        if ($usuario->permissions->count() + $total_permisos_roles_usuario + 1 <
        $this->permiso->permisos()->count()) {
            flash(
                trans(
                    'message.permissiongiven',
                    [
                        'permiso' => $permiso->name,
                        'usuario' => $usuario->nombre . ' ' . $usuario->apellidos
                    ]
                )
            )->success();
            return redirect()->route('permisos.asignarpermisos', $id_usuario);
        } else {
            flash(
                trans(
                    'message.permissiongiven',
                    [
                        'permiso' => $permiso->name,
                        'usuario' => $usuario->nombre . ' ' . $usuario->apellidos
                    ]
                )
            )->success();

            return redirect()->route('permisos.accounts');
        }
    }

    /**
     * desasignarpermisoaunusuario: Se construye la página con los permisos que tiene un
     * usuario seleccionado
     */
    public function desasignarpermisoausuario($id)
    {
        $account = $this->socios->buscarsocioporid($id);
        $permisos = $account->permissions;

        if ($permisos->count() > 0) {
            return view('backend.permisos.asignados', compact('account', 'permisos'));
        } else {
            flash(
                trans(
                    'message.nopermissionsavailable',
                    [
                        'usuario' => $account->nombre . ' ' . $account->apellidos
                    ]
                )
            )->success();

            return redirect()->route('permisos.accounts');
        }
    }

    /**
     * revocarpermiso: Se desasigna el permiso seleccionado al usuario seleccionado
     */
    public function revocarPermiso($id_usuario, $id_permiso)
    {
        $permiso = $this->permiso->buscarpermisoporid($id_permiso);
        $usuario = $this->socios->buscarsocioporid($id_usuario);

        $usuario->revokePermissionTo($permiso->name);

        if ($usuario->permissions->count() > 0) {
            flash(
                trans(
                    'message.permissionrevoked',
                    [
                        'permiso' => $permiso->name,
                        'usuario' => $usuario->nombre . ' ' . $usuario->apellidos
                    ]
                )
            )->success();

            return redirect()->route('permisos.desasignarpermisos', $id_usuario);
        } else {
            flash(
                trans(
                    'message.permissionrevoked',
                    [
                         'permiso' => $permiso->name,
                         'usuario' => $usuario->nombre . ' ' . $usuario->apellidos
                    ]
                )
            )->success();
            return redirect()->route('permisos.accounts');
        }
    }

    /**
     * buscarPermisoAdministrador: Se comprueba si el permiso administrador ha sido asignado
     * ya. Sólo puede haber un usuario administrador
     */
    public function buscarPermisoAdministrador()
    {
        $usuarios = $this->socios->socios();
        $permiso_administrador = 0;

        foreach ($usuarios as $usuario) {
            if ($usuario->hasPermissionTo('Administrar roles y permisos')) {
                ++$permiso_administrador;
            }
        }

        if ($permiso_administrador > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * BuscarIdAdministrador: Se localiza el idenbtificador del usuario con el rol
     * administrador
     */
    public function buscarIdAdministrador($accounts)
    {
        $id_administrador = 0;

        foreach ($accounts as $account) {
            if ($account->hasRole('Administrador')) {
                $id_administrador = $account->id;
                break;
            }
        }
        return $id_administrador;
    }
}
