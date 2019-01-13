<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PeriodsTableSeeder::class);
        $this->call(DoctypesTableSeeder::class);
        $this->call(PaymentypesTableSeeder::class);
        $this->call(MembertypesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(PermissionsRolesTableSeeder::class);
        $this->call(AdminUsersTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(ActivitytypesTableSeeder::class);
        $this->call(ActivitytargetsTableSeeder::class);
        $this->call(ChatterTableSeeder::class);
    }
}
