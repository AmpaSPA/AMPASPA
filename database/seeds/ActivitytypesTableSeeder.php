<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ActivitytypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activitytypes')->insert(array(
            'tipoactividad' => 'AMPA',
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytypes')->insert(array(
            'tipoactividad' => 'COLEGIO',
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('activitytypes')->insert(array(
            'tipoactividad' => 'ACUERDO AMPA CON UN TERCERO',
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
        ));

    }
}
