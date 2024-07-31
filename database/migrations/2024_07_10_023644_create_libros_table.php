<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); // título del libro
            $table->foreignId('autor_id')->constrained('autores', 'id')->onDelete('cascade');
            $table->foreignId('editorial_id')->constrained('editoriales', 'id')->onDelete('cascade'); // clave foránea a editoriales
            $table->date('ano_publicacion'); // año de publicación
            $table->bigInteger('isbn');
            $table->integer('cantidad'); // cantidad de libros
            $table->foreignId('categoria_id')->constrained('categorias', 'id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
