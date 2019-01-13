<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Repositories\RolRepository;
use App\Http\Controllers\Controller;
use App\Repositories\SocioRepository;
use App\Repositories\PermisoRepository;
use App\Http\Requests\CreateRoleRequest;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase del controlador para la administración de los roles de los usuarios de la aplicación
 */
class RolesController extends Controller
{
    protected $permiso;
    protected $rol;
    protected $socio;

    /**
     * __construct: Constructor de la clase. Usa los modelos: User, Permission y Role
     */
    public function __construct(PermisoRepository $permiso, RolRepository $rol, SocioRepository $socio)
    {
        //$this->middleware(['auth', 'isAdmin']);//isAdmin middleware lets only users with a
        //specific permission permission to access these resources

        $this->permiso = $permiso;
        $this->rol = $rol;
        $this->socio = $socio;
    }

    /**
     * rolesdata: Se construyen las columnas: permiso (con todos los permisos asignados al rol)
     * y action (para editar y eliminar) en la tabla de roles
     */
    public function rolesdata()
    {
        $roles = $this->rol->roles();

        return DataTables::of($roles)
        ->addColumn(
            'permiso',
            function ($rol) {
                return $rol->permissions()->pluck('name')->implode(', ');
            }
        )
        ->addColumn(
            'action',
            function ($rol) {
                $btnEditar = '<i class="text-warning fa fa-pencil"></i>'
                . '<a href="'
                . url('backend/roles/edit/'.$rol->id)
                . '">'
                . '<span class="text-warning texto-accion">'
                . trans('acciones_crud.edit')
                . '</span>'
                . '</a>';
                $btnEliminar = '<i class="text-danger fa fa-trash"></i>'
                . '<a href="'
                . url('backend/roles/borrar/'.$rol->id)
                . '">'
                . '<span class="text-danger texto-accion">'
                . trans('acciones_crud.delete')
                . '</span>'
                . '</a>';

                return $btnEditar.' '.$btnEliminar;
            }
        )
        ->make(true);
    }

    /**
     * create: Muestra el formulario para cargar nuevos roles en la BBDD.
     */
    public function create()
    {
        $permissions = $this->permiso->permisos();
        return view('backend.roles.create', compact('permissions'));
    }

    /**
     * store: Guarda el nuevo rol creado en la BBDD.
     */
    public function store(CreateRoleRequest $request)
    {
        $this->rol->crearrol($request);
        $permissions = $request->permissions;

        foreach ($permissions as $permission) {
            $p = $this->permiso->buscarpermisoporid($permission);
            $this->rol->buscarrolpornombre($request->name)->givePermissionTo($p);
        }

        flash(
            trans(
                'acciones_crud.addedrole',
                [
                    'rol' => $request->name
                ]
            )
        )->success();

        return redirect()->route('roles.list');
    }

    /**
     * edit: Muestra los datos del rol seleccionado y los permisos que éste posee.
     */
    public function edit($id)
    {
        $rol = $this->rol->buscarrolporid($id);
        $permisos_rol = $rol->permissions;
        $permisos_totales = $this->permiso->permisos();
        $permisos_marcados = [];
        $total_permisos = 0;

        foreach ($permisos_totales as $permiso_total) {
            $permisos_marcados[] = array(
            'id' => $permiso_total->id,
            'name' => $permiso_total->name,
            'marca' => '0',
            );
            ++$total_permisos;
        }

        $permisos_marcados_rol = $permisos_marcados;

        foreach ($permisos_rol as $permiso_rol) {
            for ($i = 0; $i < $total_permisos; $i++) {
                if ($permiso_rol->name === $permisos_marcados[$i]['name']) {
                    $permisos_marcados_rol[$i] = array(
                    'id' => $permisos_marcados[$i]['id'],
                    'name' => $permisos_marcados[$i]['name'],
                    'marca' => '1'
                    );
                }
            }
        }

        $permisos_marcados = [];
        foreach ($permisos_marcados_rol as $permiso_marcado_rol) {
            if ($permiso_marcado_rol['name'] === 'Administrar roles y permisos') {
                if ($rol->name === 'Administrador') {
                    $permisos_marcados[] = array(
                    'id' => $permiso_marcado_rol['id'],
                    'name' => $permiso_marcado_rol['name'],
                    'marca' => $permiso_marcado_rol['marca'],
                    );
                }
            } else {
                $permisos_marcados[] = array(
                'id' => $permiso_marcado_rol['id'],
                'name' => $permiso_marcado_rol['name'],
                'marca' => $permiso_marcado_rol['marca'],
                );
            }
        }

        return view('backend.roles.edit', compact('rol', 'permisos_marcados'));
    }

    /**
     * update: Se actualiza la información del rol seleccionado.
     */
    public function update(CreateRoleRequest $request, $id)
    {
        $this->rol->updaterol($request, $id);

        flash(
            trans(
                'acciones_crud.updatedrole',
                [
                    'rol' => $request->name
                ]
            )
        )->success();

        return redirect()->route('roles.list');
    }

    /**
     * delete: Se presenta la página para seleccionar el rol a borrar
     */
    public function delete($id)
    {
        $role = $this->rol->buscarrolporid($id);
        $usuarios = $this->socio->buscarsociosporrol($role->name);

        // No borrar el rol: Administrador
        if ($role->name === 'Administrador') {
            flash(
                trans(
                    'acciones_crud.nodeleterole',
                    [
                        'rol' => $role->name
                    ]
                )
            )->error();

            return redirect()->route('roles.list');
        }

        return view('backend.roles.usuarios', compact('role', 'usuarios'));
    }

    /**
     * detach: Se desasigna el rol seleccionado al usuario seleccionado
     */
    public function detach($id_usuario, $nombrerol)
    {
        $role = $this->rol->buscarrolpornombre($nombrerol);
        $usuario = $this->socio->buscarsocioporid($id_usuario);
        $usuario->removeRole($nombrerol);

        if ($usuario->roles()->count() > 0) {
            flash(
                trans(
                    'message.roleunassigned',
                    [
                        'rol' => $nombrerol,
                        'usuario' => $usuario->nombre
                        .' '
                        .$usuario->apellidos
                    ]
                )
            )->success();

            return redirect()->route('roles.borrar', $role->id);
        } else {
            flash(
                trans(
                    'message.roleunassigned',
                    [
                        'rol' => $nombrerol,
                        'usuario' => $usuario->nombre
                        .' '
                        . $usuario->apellidos
                    ]
                )
            )->success();

            return redirect()->route('roles.list');
        }
    }

    /**
     * destroy: Elimina de la BBDD el rol seleccionado.
     */
    public function destroy($id)
    {
        $role = $this->rol->buscarrolporid($id);
        $role->delete();

        flash(
            trans(
                'message.roledeleted',
                [
                    'rol' => $role->name
                ]
            )
        )->success();

        return redirect()->route('roles.list');
    }
}
