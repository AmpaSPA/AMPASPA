<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('periodo', 9);
            $table->integer('aniodesde')->default(Carbon::now()->year - 1);
            $table->integer('aniohasta')->default(Carbon::now()->year);
            $table->decimal('cuota')->default(25);
            $table->decimal('ingresos')->default(0);
            $table->decimal('gastos')->default(0);
            $table->decimal('saldo')->default(0);
            $table->integer('totalsocios')->default(0);
            $table->boolean('activo')->default(true);
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
        Schema::dropIfExists('periods');
    }
}
