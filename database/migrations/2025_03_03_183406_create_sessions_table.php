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
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Chave primária (ID da session)
            $table->foreignId('user_id')->nullable()->index(); // ID do usuário (se autenticado)
            $table->string('ip_address', 45)->nullable(); // Endereço IP do usuário
            $table->text('user_agent')->nullable(); // Agente do usuário (navegador, etc)
            $table->longText('payload'); // Dados da session
            $table->integer('last_activity')->index(); // Timestamp da última atividade
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};