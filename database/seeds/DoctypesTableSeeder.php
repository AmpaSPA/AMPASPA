<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DoctypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('doctypes')->insert(array(
        'tipodoc' => 'CIF',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ));
      DB::table('doctypes')->insert(array(
        'tipodoc' => 'DNI',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ));
      DB::table('doctypes')->insert(array(
        'tipodoc' => 'NIE',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ));
      DB::table('doctypes')->insert(array(
        'tipodoc' => 'NIF',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ));
      DB::table('doctypes')->insert(array(
        'tipodoc' => 'Pasaporte',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ));
    }
}
