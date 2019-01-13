<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('periodo', 9);
            $table->date('fecha')->default(Carbon::now()->format('Y-m-d'));
            $table->string('emisor');
            $table->string('destinatario');
            $table->enum('tipo', ['Gasto', 'Ingreso'])->default('Ingreso');
            $table->string('concepto');
            $table->text('descripcion');
            $table->string('codigofactura');
            $table->decimal('importe');
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
        Schema::dropIfExists('entries');
    }
}
