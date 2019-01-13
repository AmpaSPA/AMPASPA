<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert(array(
        'curso' => '1-EI -A',
        'edad' => 3,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '1-EI -B',
        'edad' => 3,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '2-EI -A',
        'edad' => 4,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '2-EI -B',
        'edad' => 4,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '3-EI -A',
        'edad' => 5,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '3-EI -B',
        'edad' => 5,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '1-EP -A',
        'edad' => 6,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '1-EP -B',
        'edad' => 6,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('courses')->insert(array(
        'curso' => '2-EP -A',
        'edad' => 7,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '2-EP -B',
        'edad' => 7,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '3-EP -A',
        'edad' => 8,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '3-EP -B',
        'edad' => 8,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '4-EP -A',
        'edad' => 9,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '5-EP -A',
        'edad' => 10,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '6-EP -A',
        'edad' => 11,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '1-ESO-A',
        'edad' => 12,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '2-ESO-A',
        'edad' => 13,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '3-ESO-A',
        'edad' => 14,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));

        DB::table('courses')->insert(array(
        'curso' => '4-ESO-A',
        'edad' => 15,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
    }
}
