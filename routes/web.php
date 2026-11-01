<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['bookCount' => Book::count(), 'userCount' => User::count()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Middleware auth memastikan login; middleware role Spatie membatasi halaman berikut berdasarkan role.
    Route::get('/books', [BookController::class, 'index'])->name('books.index');

    Route::middleware('role:Admin|Dosen')->group(function () {
        // Spatie: role Admin atau Dosen boleh membuka form dan menyimpan/perbarui buku.
        Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    });

    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

    // Spatie: hanya role Admin yang dapat menjalankan penghapusan buku.
    Route::delete('/books/{book}', [BookController::class, 'destroy'])
        ->middleware('role:Admin')
        ->name('books.destroy');

    // Spatie: seluruh pengelolaan akun pengguna dikunci khusus untuk role Admin.
    Route::middleware('role:Admin')->resource('users', UserController::class)->except(['show']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
