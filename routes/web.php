<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['bookCount' => \App\Models\Book::count(), 'userCount' => \App\Models\User::count()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Catatan: Semuanya wajib login; Admin/Dosen dapat mengelola, Mahasiswa hanya melihat.
    Route::get('/books', [BookController::class, 'index'])->name('books.index');

    Route::middleware('role:Admin|Dosen')->group(function () {
        Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    });

    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

    Route::delete('/books/{book}', [BookController::class, 'destroy'])
        ->middleware('role:Admin')
        ->name('books.destroy');

    Route::middleware('role:Admin')->resource('users', UserController::class)->except(['show']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
