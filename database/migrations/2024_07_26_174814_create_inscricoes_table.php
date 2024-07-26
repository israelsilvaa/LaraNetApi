<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela `inscricoes`.
     */
    public function up(): void
    {
        Schema::create('inscricoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudante_id')->constrained('estudantes')->onDelete('cascade');
            $table->foreignId('vaga_id')->constrained('vagas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Remove a tabela `inscricoes`.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricoes');
    }
};
