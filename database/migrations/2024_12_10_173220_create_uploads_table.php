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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Relacionamento com a tabela users
            $table->string('file_path'); // Caminho do arquivo PDF enviado pelo usuário
            $table->string('title'); // Título do PDF
            $table->string('author'); // Autor do PDF
            $table->string('description'); // Descrição do PDF
            $table->string('image_path'); // Caminho da imagem de capa (se houver)
            $table->string('category'); // Nova coluna para a categoria
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};