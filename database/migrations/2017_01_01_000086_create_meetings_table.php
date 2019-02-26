<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'meetings',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('periodo', 9);
                $table->date('fechareunion');
                $table->time('horareunion');
                $table->integer('meetingtype_id')->default(1)->unsigned();
                $table->mediumText('nota')->nullable();
                $table->boolean('convocada')->default(false);
                $table->boolean('celebrada')->default(false);
                $table->timestamps();

                $table->foreign('meetingtype_id')
                    ->references('id')->on('meetingtypes');
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
        Schema::dropIfExists('meetings');
    }
}
