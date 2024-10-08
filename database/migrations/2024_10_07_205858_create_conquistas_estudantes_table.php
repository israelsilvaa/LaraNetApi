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
        Schema::create('conquistas_estudantes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['Certificado', 'Curso', 'Reconhecimento', 'Trabalho Voluntário']);
            $table->string('titulo');
            $table->text('descricao');
            $table->foreignId('usuario_estudante_id')->references('id')->on('usuarios_estudantes')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conquistas_estudantes');
    }
};
