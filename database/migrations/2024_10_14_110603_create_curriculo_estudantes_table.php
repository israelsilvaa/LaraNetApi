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
        Schema::create('curriculos_estudantes', function (Blueprint $table) {
            $table->id();
            $table->text('curriculo_url');
            $table->foreignId('usuario_estudante_id')->constrained('usuarios_estudantes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculos_estudantes');
    }
};
