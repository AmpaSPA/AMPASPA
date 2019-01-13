<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\RolRepository;
use Illuminate\Http\Request;
use App\Repositories\SocioRepository;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserAccountsController extends Controller
{
    protected $socios;
    protected $rol;

    /**
     * __construct: Constructor de la clase. Usa los modelos: User y Role
     */
    public function __construct(SocioRepository $socios, RolRepository $rol)
    {
        $this->socios = $socios;
        $this->rol = $rol;
    }

    /**
     * usersdata: Se muestra la lista de socios para asignarle y/o desasignarle roles
     */
    public function usersdata()
    {
        $users = $this->socios->socios();

        return DataTables::of($users)
        ->addColumn(
            'fecha_alta',
            function ($user) {
                return $user->created_at->format('d/m/Y');
            }
        )
        ->addColumn(
            'rol',
            function ($user) {
                return $user->roles()->pluck('name')->implode(', ');
            }
        )
        ->addColumn(
            'action',
            function ($user) {
                $btnAsignarRol = '<i class="text-success fa fa-link"></i>'
                . '<a href="'
                . url('backend/useraccounts/asignarrol/usuario/'.$user->id)
                . '">'
                . '<span class="text-success texto-accion">'
                . trans('acciones_crud.addrol')
                . '</span>'
                . '</a>';
                $btnDesasignarRol = '';
                if ($user->hasAnyRole($this->rol->roles())) {
                    $btnDesasignarRol = '<i class="text-danger fa fa-unlink"></i>'
                    . '<a href="'
                    . url('backend/useraccounts/desasignarrol/usuario/'.$user->id)
                    . '">'
                    . '<span class="text-danger texto-accion">'
                    . trans('acciones_crud.unassignrol')
                    . '</span>'
                    . '</a>';
                }

                return $btnAsignarRol.' '.$btnDesasignarRol;
            }
        )
        ->make(true);
    }

    /**
     * asignarrolausuario: Proceso que se desencadena cuando se pulsa el botón para aisgnar
     * un rol al usuario deleccionado
     */
    public function asignarrolausuario($id)
    {
        $accion = 'asignar';
        $account = $this->socios->buscarsocioporid($id);

        if (!$account->hasRole('Administrador')) {
            $roles = $this->rol->roles();
            $roles_disponibles = [];

            foreach ($roles as $role) {
                if (!$account->hasRole($role->name)) {
                    $algun_administrador = false;
                    if ($role->name === 'Administrador') {
                        $algun_administrador = $this->buscarRolAdministrador();
                    }

                    if (!$algun_administrador) {
                        $roles_disponibles[] = array(
                        'id' => $role->id,
                        'name' => $role->name,
                        'permisos' => $role->permissions->pluck('name')->implode(', ')
                        );
                    }
                }
            }
            if (\count($roles_disponibles) > 0) {
                return view(
                    'backend.useraccounts.roles',
                    compact(
                        'accion',
                        'account',
                        'roles_disponibles'
                    )
                );
            } else {
                flash(
                    trans(
                        'message.norolesavailable',
                        [
                            'usuario' => $account->nombre
                            .' '
                            .$account->apellidos
                        ]
                    )
                )->error();
                
                return redirect()->route('accounts.index');
            }
        } else {
            flash(
                trans(
                    'message.roleadmin',
                    [
                        'usuario' => $account->nombre
                        .' '
                        .$account->apellidos
                    ]
                )
            )->error();

            return redirect()->route('accounts.index');
        }
    }

    /**
     * attach: Se asigna el rol seleccionado al usuario seleccionado
     */
    public function attach($id_usuario, $nombrerol)
    {
        $role = $this->rol->buscarrolpornombre($nombrerol);
        $usuario = $this->socios->buscarsocioporid($id_usuario);

        if ($nombrerol === 'Administrador') {
            $roles = $this->rol->roles();
            foreach ($roles as $role) {
                $usuario->removeRole($role->name);
            }
        }

        $usuario->assignRole($nombrerol);

        $roles = $this->rol->roles();

        /* Se comprueba que el usuario tenga más roles disponibles excepto el rol de
         * administrador que sólo debe pertenecer a un usuario en cuyo caso se presenta
         * la lista de roles disponibles que se le pueden seguir asignando en caso contrario
         * como no quedan roles disponibles que asignarle, se presenta la lista de cuentas
         * de usuarios. En ambos casos se informa de la acción realizada.
         */

        if ($usuario->roles->count() - 1 > 0) {
            flash(
                trans(
                    'message.roleassigned',
                    [
                        'rol' => $nombrerol,
                        'usuario' => $usuario->nombre
                        .' '
                        .$usuario->apellidos
                    ]
                )
            )->success();

            return redirect()->route('accounts.asignarroles', $id_usuario);
        } else {
            flash(
                trans(
                    'message.roleassigned',
                    [
                        'rol' => $nombrerol,
                        'usuario' => $usuario->nombre
                        .' '
                        .$usuario->apellidos
                    ]
                )
            )->success();

            return redirect()->route('accounts.index');
        }
    }

    /**
     * desasignarrolausuario: Se selecciona el rol a desasignar al usuario seleccionado
     */
    public function desasignarrolausuario($id)
    {
        $accion = 'desasignar';
        $account = $this->socios->buscarsocioporid($id);
        $roles = $account->roles;
        $roles_disponibles = [];
        $rol_disponible = 0;

        foreach ($roles as $role) {
            $roles_disponibles[] = array(
            'id' => $role->id,
            'name' => $role->name,
            'permisos' => $role->permissions->pluck('name')->implode(', ')
            );
            ++$rol_disponible;
        }

        if ($rol_disponible > 0) {
            return view('backend.useraccounts.roles', compact('accion', 'account', 'roles_disponibles'));
        } else {
            flash(
                trans(
                    'message.norolesassignated',
                    [
                        'usuario' => $account->nombre
                        .' '
                        .$account->apellidos
                    ]
                )
            )->error();

            return redirect()->route('accounts.index');
        }
    }

    /**
     * detach: Se desasigna el rol seleccionado al usuario seleccionado
     */
    public function detach($id_usuario, $nombrerol)
    {
        $role = $this->rol->buscarrolpornombre($nombrerol);
        $usuario = $this->socios->buscarsocioporid($id_usuario);
        $usuario->removeRole($nombrerol);

        if ($usuario->roles->count() !== 0) {
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

            return redirect()->route('accounts.desasignarroles', $id_usuario);
        } else {
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

            return redirect()->route('accounts.index');
        }
    }

    /**
     * buscarRolAdministrador: Se comprueba si el rol administrador está disponible o no
     */
    public function buscarRolAdministrador()
    {
        $usuarios = $this->socios->socios();
        $administrador = 0;

        foreach ($usuarios as $usuario) {
            if ($usuario->hasRole('Administrador')) {
                ++$administrador;
            }
        }

        if ($administrador > 0) {
            return true;
        } else {
            return false;
        }
    }
}
