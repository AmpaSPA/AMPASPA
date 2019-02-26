<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'agrees',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('topic_id')->unsigned();
                $table->longText('acuerdo');
                $table->timestamps();

                $table->foreign('topic_id')
                    ->references('id')->on('topics');
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
        Schema::dropIfExists('agrees');
    }
}
