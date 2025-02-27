<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\LivrosController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('alunos', AlunoController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('livros', LivrosController::class);
    /**Route::put('livros/{livro}', [LivrosController::class, 'update'])->name('livros.update');**/

});

require __DIR__.'/auth.php';

