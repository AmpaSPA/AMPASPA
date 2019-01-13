<?php
/**
 * Clase seeder para poblar de datos las tablas de parmisos y roles
 * 
 * PHP VERSION 7.2.5
 * 
 * @category PHP
 * @package  Ampaspa
 * @author   Luis Ponce Melero <lpmelero@gmail.com>
 * @license  http://ampaspa.local FREE
 * @link     http://ampaspa.local 
 */
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Clase PermissionsRolesTableSeeder
 * 
 * @category Seeder
 * @package  Ampaspa
 * @author   Luis Ponce Melero <lpmelero@gmail.com>
 * @license  http://ampaspa.local FREE
 * @link     http://ampaspa.local 
 */
class PermissionsRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        DB::table('permissions')->insert(
            array(
                'name' => 'Administrar roles y permisos',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Ver socios',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Editar socios',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Crear socios',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Borrar socios',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(  
            array(
                'name' => 'Ver cuentas',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Editar cuentas',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Crear cuentas',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Borrar cuentas',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Ver actas',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Editar actas',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Crear actas',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Borrar actas',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Ver alumnos',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Editar alumnos',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Crear alumnos',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Borrar alumnos',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Ver actividades',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Editar actividades',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Crear actividades',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'Borrar actividades',
                'guard_name' => 'web',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            )
        );

        // create roles and assign created permissions
        $role = Role::create(['name' => 'Administrador']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Presidente']);
        $role->givePermissionTo(
            [
                'Ver socios',
                'Editar socios',
                'Crear socios',
                'Borrar socios',
                'Ver cuentas',
                'Editar cuentas',
                'Crear cuentas',
                'Borrar cuentas',
                'Ver actas',
                'Editar actas',
                'Crear actas',
                'Borrar actas',
                'Ver alumnos',
                'Editar alumnos',
                'Crear alumnos',
                'Borrar alumnos',
                'Ver actividades',
                'Editar actividades',
                'Crear actividades',
                'Borrar actividades'    
            ]
        );

        $role = Role::create(['name' => 'Secretario']);
        $role->givePermissionTo(
            [
                'Ver socios',
                'Editar socios',
                'Crear socios',
                'Borrar socios',
                'Ver cuentas',
                'Ver actas',
                'Editar actas',
                'Crear actas',
                'Borrar actas',
                'Ver alumnos',
                'Editar alumnos',
                'Crear alumnos',
                'Borrar alumnos',
                'Ver actividades',
                'Editar actividades',
                'Crear actividades',
                'Borrar actividades'    
            ]
        );

        $role = Role::create(['name' => 'Tesorero']);
        $role->givePermissionTo(
            [
                'Ver socios',
                'Ver cuentas',
                'Editar cuentas',
                'Crear cuentas',
                'Borrar cuentas',
                'Ver actas',
                'Editar actas',
                'Ver alumnos',
                'Ver actividades'   
            ]
        );

        $role = Role::create(['name' => 'Vocal']);
        $role->givePermissionTo(
            [
                'Ver socios',
                'Ver cuentas',
                'Ver actas',
                'Ver alumnos',
                'Ver actividades' 
            ]
        );

        $role = Role::create(['name' => 'Socio']);
        $role->givePermissionTo(
            [
                'Ver alumnos',
                'Ver actividades'    
            ]
        );
    }
}
