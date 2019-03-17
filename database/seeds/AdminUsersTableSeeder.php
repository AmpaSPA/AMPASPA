<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \RuntimeException
     */
    public function run()
    {
        DB::table('users')->insert([
            'periodo' => Carbon::now()->year . '-' . Carbon::now()->addYear()->year,
            'nombre' => 'Usuario1',
            'apellidos' => 'Primer_apellido Segundo_apellido',
            'email' => 'emailusuario1@proveedor.com',
            'password' => bcrypt('11111111a'),
            'telefono' => '111111111',
            'doctype_id' => 2,
            'numdoc' => '11111111A',
            'membertype_id' => 8,
            'paymenttype_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('students')->insert(array(
            'nombre' => 'Hijo1usuario1 Primer_apellido Segundo_apellido',
            'anionacim' => 2003,
            'course_id' => 19,
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('students')->insert(array(
            'nombre' => 'Hijo2usuario1 Primer_apellido Segundo_apellido',
            'anionacim' => 2007,
            'course_id' => 14,
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('model_has_roles')->insert(array(
            'role_id' => 1,
            'model_id' => 1,
            'model_type' => 'App\User',
        ));
    }
}
