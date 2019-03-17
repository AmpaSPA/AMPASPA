<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periods')->insert(array(
        'periodo' => Carbon::now()->year . '-' . Carbon::now()->addYear()->year,
        'aniodesde' => Carbon::now()->year,
        'aniohasta' => Carbon::now()->addYear()->year,
        'activo' => true,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
    }
}
