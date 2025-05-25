<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'home'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Rota para compartilhar PDF (apenas para usuários autenticados)
    Route::get('/share-pdf', [ProfileController::class, 'sharePdf'])->name('share.pdf');
    Route::post('/upload-pdf', [ProfileController::class, 'upload'])->name('pdf.upload');
    Route::get('/', [ProfileController::class, 'home'])->name('home');
    // Rota para editar livro
    Route::get('/edit-book/{id}', [ProfileController::class, 'editBook'])->name('book.edit');
    Route::put('/update-book/{id}', [ProfileController::class, 'updateBook'])->name('book.update');
    // Adicione esta rota para processamento AJAX
    // Adicione esta rota para processamento AJAX
    Route::post('/book-update-ajax/{id}', [ProfileController::class, 'updateBookAjax'])->name('book.update.ajax');

});

require __DIR__.'/auth.php';
