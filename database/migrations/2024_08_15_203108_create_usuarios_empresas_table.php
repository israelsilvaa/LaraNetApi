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
        Schema::create('usuarios_empresas', function (Blueprint $table) {
            $table->id();
           
            $table->string('nome');
            $table->string('razao_social')->unique();
            $table->text('image_logo_url');
            $table->enum('porte', ['MEI','ME','EPP','MEDIA_EMPRESA', 'GRANDE_EMPRESA']);
            $table->text('descricao');
            $table->string('cnpj', 18)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios_empresas');
    }
};
