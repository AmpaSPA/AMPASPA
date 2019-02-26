<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendeeMeetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'attendee_meeting',
            function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('confirmed')->default(false);
                $table->integer('attendee_id')->unsigned();

                $table->foreign('attendee_id')
                    ->references('id')->on('attendees');

                $table->integer('meeting_id')->unsigned();

                $table->foreign('meeting_id')
                    ->references('id')->on('meetings');

                $table->timestamps();
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
        Schema::dropIfExists('attendee_meeting');
    }
}
