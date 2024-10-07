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
        Schema::create('idiomas_estudantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idioma_id')->constrained('idiomas')->onDelete('CASCADE');
            $table->foreignId('usuario_estudante_id')->constrained('usuarios_estudantes')->onDelete('CASCADE');
            $table->enum('nivel', ['Básico', 'Intermediário', 'Avançado']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idioma_estudantes');
    }
};
