<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'activity_student', function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('authorized')->default(false);
                $table->integer('activity_id')->unsigned();
                $table->foreign('activity_id')
                    ->references('id')->on('activities');
                $table->integer('student_id')->unsigned();
                $table->foreign('student_id')
                    ->references('id')->on('students');
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
      Schema::dropIfExists('activity_student');
    }
}
