<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Quem fez o download
            $table->foreignId('upload_id')->constrained()->onDelete('cascade'); // Livro baixado
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('downloads');
    }
};
