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
        $anioDesde = null;
        $anioHasta = null;

        if (Carbon::now()->month >= 1 && Carbon::now()->month <= 6) {
            $anioDesde = Carbon::now()->subYear()->year;
            $anioHasta = Carbon::now()->year;
        } else {
            $anioDesde = Carbon::now()->year;
            $anioHasta = Carbon::now()->addYear()->year;
        }

        $periodo = $anioDesde.'-'.$anioHasta;

        DB::table('users')->insert([
            'nombre' => 'Usuario1',
            'apellidos' => 'Primer_apellido Segundo_apellido',
            'email' => 'emailUsuario1@proveedorCorreo.com',
            'password' => bcrypt('11111111a'),
            'telefono' => '111111111',
            'doctype_id' => 2,
            'numdoc' => '11111111A',
            'membertype_id' => 8,
            'paymenttype_id' => 4,
            'reciboimportado' => true,
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
        DB::table('receipts')->insert(array(
            'user_id' => 1,
            'periodo' => $periodo,
            'importe' => 25,
            'domiciliacion' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
    }
}
