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
    
    // Rotas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rotas para compartilhar PDF
    Route::get('/share-pdf', [ProfileController::class, 'sharePdf'])->name('share.pdf');
    Route::post('/upload-pdf', [ProfileController::class, 'upload'])->name('pdf.upload');

    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');



    
});