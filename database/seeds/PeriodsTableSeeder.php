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

        DB::table('periods')->insert(array(
        'periodo' => $periodo,
        'aniodesde' => $anioDesde,
        'aniohasta' => $anioHasta,
        'activo' => true,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
    }
}
