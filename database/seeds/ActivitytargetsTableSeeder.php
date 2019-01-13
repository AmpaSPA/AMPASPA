<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ActivitytargetsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run()
    {
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => 'ALU',
        'colectivo' => 'ALUMNOS',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => 'EI -',
        'colectivo' => 'INFANTIL',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => '1-EI -',
        'colectivo' => 'PRIMERO INFANTIL',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => '2-EI -',
        'colectivo' => 'SEGUNDO INFANTIL',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => '3-EI -',
        'colectivo' => 'TERCERO INFANTIL',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => 'EP -',
        'colectivo' => 'PRIMARIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => '1-EP -',
        'colectivo' => 'PRIMERO PRIMARIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => '2-EP -',
        'colectivo' => 'SEGUNDO PRIMARIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => '3-EP -',
        'colectivo' => 'TERCERO PRIMARIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => '4-EP -',
        'colectivo' => 'CUARTO PRIMARIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => '5-EP -',
        'colectivo' => 'QUINTO PRIMARIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => '6-EP -',
        'colectivo' => 'SEXTO PRIMARIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => 'ESO',
        'colectivo' => 'SECUNDARIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => '1-ESO-',
        'colectivo' => 'PRIMERO SECUNDARIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => '2-ESO-',
        'colectivo' => 'SEGUNDO SECUNDARIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => '3-ESO-',
        'colectivo' => 'TERCERO SECUNDARIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => '4-ESO-',
        'colectivo' => 'CUARTO SECUNDARIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytargets')->insert(array(
        'destinoactividad' => 'BAC',
        'colectivo' => 'BACHILLERATO',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
    }
}
