<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EntrytypesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('entrytypes')->insert(array(
      'tipoentrada' => 'Gasto',
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ));
    DB::table('entrytypes')->insert(array(
      'tipoentrada' => 'Ingreso',
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ));
  }
}