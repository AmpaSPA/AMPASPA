<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'topics',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('titulo', 100);
                $table->longText('tema');
                $table->string('propietario');
                $table->string('responsable');
                $table->integer('meeting_id')->unsigned();
                $table->boolean('acordado')->nullable()->default(false);
                $table->timestamps();

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
        Schema::dropIfExists('topics');
    }
}
