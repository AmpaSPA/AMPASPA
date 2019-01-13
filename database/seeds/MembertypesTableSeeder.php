<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MembertypesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table( 'membertypes' )->insert( array(
      'tiposocio' => 'Presidente/a',
      'created_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
      'updated_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
    ));
    DB::table( 'membertypes' )->insert( array(
      'tiposocio' => 'Secretario/a',
      'created_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
      'updated_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
    ));
    DB::table( 'membertypes' )->insert( array(
      'tiposocio' => 'Socio/a',
      'created_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
      'updated_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
    ));
    DB::table( 'membertypes' )->insert( array(
      'tiposocio' => 'Tesorero/a',
      'created_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
      'updated_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
    ));
    DB::table( 'membertypes' )->insert( array(
      'tiposocio' => 'Vicepresidente/a',
      'created_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
      'updated_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
    ));
    DB::table( 'membertypes' )->insert( array(
      'tiposocio' => 'Vicesecretario/a',
      'created_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
      'updated_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
    ));
    DB::table( 'membertypes' )->insert( array(
      'tiposocio' => 'Vicetesorero/a',
      'created_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
      'updated_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
    ));
    DB::table( 'membertypes' )->insert( array(
      'tiposocio' => 'Vocal',
      'created_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
      'updated_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
    ));
  }
}
