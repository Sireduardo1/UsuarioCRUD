<?php
// database/migrations/xxxx_xx_xx_create_usuarios_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre', 100);
            $table->string('email', 100)->unique();
            $table->string('contrasena', 255);
            $table->string('google2fa_secret', 255)->nullable();
            $table->string('codigoRec', 45)->nullable();
            $table->timestamps();
            $table->enum('tipo_usuario', ['admin', 'usuario']);

            $table->index('email');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
