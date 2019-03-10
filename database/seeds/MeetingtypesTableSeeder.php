<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MeetingtypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meetingtypes')->insert(array(
            'tiporeunion' => 'ORDINARIA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ));
        DB::table('meetingtypes')->insert(array(
        'tiporeunion' => 'EXTRAORDINARIA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('meetingtypes')->insert(array(
            'tiporeunion' => 'GENERAL ORDINARIA',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
    }
}
