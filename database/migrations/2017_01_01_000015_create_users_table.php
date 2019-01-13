<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   * @return void
   * @throws \RuntimeException
   */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->string('password')->default(bcrypt('secret'));
            $table->string('telefono');
            $table->integer('doctype_id')->unsigned()->default(2);
            $table->string('numdoc');
            $table->integer('membertype_id')->unsigned()->default(3);
            $table->integer('paymenttype_id')->unsigned()->default(1);
            $table->boolean('corrientepago')->default(false);
            $table->boolean('reciboimportado')->default(false);
            $table->boolean('firmacorrecta')->default(false);
            $table->boolean('firmaimportada')->default(false);
            $table->boolean('activo')->default(false);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('doctype_id')
              ->references('id')->on('doctypes');

            $table->foreign('membertype_id')
              ->references('id')->on('membertypes');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
