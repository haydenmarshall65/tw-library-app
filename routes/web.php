<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookSearchController;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/', function () {
        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    })->name('home');

    Route::get('/books/search', [BookSearchController::class, 'search'])->name('books.search');

    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
});

require __DIR__.'/auth.php';
