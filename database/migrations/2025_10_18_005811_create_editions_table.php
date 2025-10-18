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
        Schema::create('editions', function (Blueprint $table) {
            $table->id();
            $table->string('title');           // Ej: "Edición Octubre 2025"
            $table->date('publication_date'); // Fecha de publicación de la edición
            $table->string('cover_image')->nullable(); // Imagen de portada
            $table->text('description')->nullable(); // Descripción o resumen de la edición
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editions');
    }
};
