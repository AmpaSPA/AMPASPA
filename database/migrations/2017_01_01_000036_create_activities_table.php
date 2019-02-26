<?php
/**
 * PHP VERSION 7.2.5
 *
 * @abstract Migración para la creación de la tabla actividades
 * @category PHP
 * @package  Ampaspa
 * @author   Luis Ponce Melero <lpmelero@gmail.com>
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Clase de la migración de la tabla actividades
 *
 * PHP VERSION 7.2.5
 *
 * @category PHP
 * @package  Ampaspa
 * @author   Luis Ponce Melero <lpmelero@gmail.com>
 */

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'activities',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('periodo', 9);
                $table->date('fechaactividad');
                $table->string('nombre');
                $table->longText('descripcion');
                $table->integer('activitytype_id')->unsigned();
                $table->integer('activitytarget_id')->unsigned();
                $table->integer('subvencion');
                $table->integer('precio');
                $table->boolean('publicada')->default(false);
                $table->boolean('cerrada')->default(false);
                $table->timestamps();

                $table->foreign('activitytype_id')
                    ->references('id')->on('activitytypes');

                $table->foreign('activitytarget_id')
                    ->references('id')->on('activitytargets');
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
        Schema::dropIfExists('activities');
    }
}
