<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Rota principal acessível sem login
Route::get('/', [ProfileController::class, 'home'])->name('home');

// Rota de download (acessível apenas para autenticados)
Route::get('/download/{id}', [ProfileController::class, 'download'])
    ->name('book.download')
    ->middleware('auth');

// Rotas de autenticação (login, registro, etc.)
require __DIR__.'/auth.php';

// Rotas que exigem login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Rotas de perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rotas para compartilhar PDF
    Route::get('/share-pdf', [ProfileController::class, 'sharePdf'])->name('share.pdf');
    Route::post('/upload-pdf', [ProfileController::class, 'upload'])->name('pdf.upload');

    // Rota para mostrar perfil do usuário
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    
    // Rotas para gerenciar livros
    Route::delete('/books/{id}', [ProfileController::class, 'deleteBook'])->name('books.delete');
    Route::get('/books/{id}/edit', [ProfileController::class, 'editBook'])->name('books.edit');
    Route::post('/books/{id}', [ProfileController::class, 'updateBook'])->name('books.update');
});