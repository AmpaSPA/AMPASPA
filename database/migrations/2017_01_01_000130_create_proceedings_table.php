<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProceedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'proceedings',
            function (Blueprint $table) {
                $table->increments('id');
                $table->date('fecha_acta');
                $table->integer('period_id')->unsigned();
                $table->integer('meeting_id')->unsigned();
                $table->string('autoria');
                $table->string('documento');
                $table->timestamps();

                $table->foreign('period_id')
                    ->references('id')->on('periods');

                $table->foreign('meeting_id')
                    ->references('id')->on('meetings');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proceedings');
    }
}
