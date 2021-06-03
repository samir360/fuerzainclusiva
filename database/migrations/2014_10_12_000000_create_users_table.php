<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 150)->unique();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('firstname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->unsignedBigInteger('rol_id')->nullable()->comment('Ej: {USUARIOS=3,OPERADOR=2,ADMINISTRATOR=1}.');
            $table->string('photo', 100)->nullable();
            $table->string('user_status')->comment('activo, inactivo');
            $table->timestamps();

            $table->foreign('rol_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
