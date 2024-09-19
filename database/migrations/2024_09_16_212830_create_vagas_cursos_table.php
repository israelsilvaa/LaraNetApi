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
        Schema::create('vagas_cursos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vaga_id')->constrained('vagas')->onDelete('CASCADE');
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vagas_cursos');
    }
};
