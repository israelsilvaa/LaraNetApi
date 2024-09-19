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
        Schema::create('vagas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao');
            $table->enum('tipo_estagio', ['Presencial', "Remoto", "Híbrido"]);
            $table->enum('turno', ['Matutino', "Vespertino", "Noturno"]);
            $table->decimal('valor', 15, 2)->nullable();
            $table->foreignId('usuario_empresa_id')->constrained('usuarios_empresas')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vagas');
    }
};
