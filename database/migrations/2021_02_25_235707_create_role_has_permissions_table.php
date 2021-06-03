<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleHasPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->integer('id_menu')->comment('id del menu');
            $table->integer('parent')->comment('id padre del menu');
            $table->bigInteger('role_id')->comment('id del rol');
            $table->tinyInteger('new')->comment('permiso para crear');
            $table->tinyInteger('edit')->comment('permiso para editar');
            $table->tinyInteger('delet')->comment('permiso para eliminar');
            $table->timestamps();

            $table->foreign('id_menu')->references('id')->on('menus');
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
        Schema::dropIfExists('role_has_permissions');
    }
}
