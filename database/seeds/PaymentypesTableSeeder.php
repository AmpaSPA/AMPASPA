<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PaymentypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paymenttypes')->insert(array(
        'tipopago' => 'Transferencia a la cuenta de la AMPA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('paymenttypes')->insert(array(
        'tipopago' => 'Entrega en metálico',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('paymenttypes')->insert(array(
        'tipopago' => 'Ingreso en la cuenta de la AMPA',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
        DB::table('paymenttypes')->insert(array(
        'tipopago' => 'Domiciliación a mi cuenta',
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ));
    }
}
