<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookSearchController;
use App\Http\Controllers\BookReviewController;
use App\Http\Controllers\ManageBooksController;
use App\Http\Middleware\EnsureIsLibrarian;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/', function () {
        return Inertia::render('Home');
    })->name('home');

    Route::get('/books/search', [BookSearchController::class, 'search'])->name('books.search');

    Route::get('/books/manage', [ManageBooksController::class, 'index'])->name('books.manage');

    Route::get('/books/new', [ManageBooksController::class, 'create'])->name('books.create')->middleware(EnsureIsLibrarian::class);

    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

    Route::get('/books/{book}/reviews', [BookReviewController::class, 'show'])->name('books.reviews');

    Route::get('/books/{book}/edit', [ManageBooksController::class, 'edit'])->name('books.edit')->middleware(EnsureIsLibrarian::class);
});

require __DIR__.'/auth.php';
