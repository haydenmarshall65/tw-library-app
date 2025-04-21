<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CheckOutBookController;

Route::group(['middleware' => 'web', 'auth:sanctum'], function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}/checkout', [CheckOutBookController::class, 'store'])->name('books.checkout');
});
