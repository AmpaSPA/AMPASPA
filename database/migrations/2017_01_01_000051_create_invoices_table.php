<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('periodo', 9)->default(null);
            $table->string('codigo', 12)->default(null);
            $table->date('fecha')->default(null);
            $table->string('emisor')->default(null);
            $table->string('destinatario')->default(null);
            $table->string('concepto')->default(null);
            $table->string('factura', 100)->nullable()->default(null);
            $table->decimal('importe')->default(null);
            $table->boolean('importada')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
