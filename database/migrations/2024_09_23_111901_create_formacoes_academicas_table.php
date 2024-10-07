<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formacoes_academicas', function (Blueprint $table) {
            $table->id();
            $table->enum("tipo_grau", ["Tecnólogo", "Graduação", "Pós-Graduação", "Mestrado", "Doutorado"]);
            $table->enum("status", ["Completo", "Em andamento", "Incompleto"]);
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('CASCADE');
            $table->foreignId('usuario_estudante_id')->constrained('usuarios_estudantes')->onDelete('CASCADE');
            $table->text('instituicao_nome');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formacoes_academicas');
    }
};
