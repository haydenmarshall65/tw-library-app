<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CheckOutBookController;
use App\Http\Controllers\CustomerReviewController;

Route::group(['middleware' => 'web', 'auth:sanctum'], function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::post('/books/{book}/checkout', [CheckOutBookController::class, 'store'])->name('books.checkout');
    Route::post('/books/{book}/review', [CustomerReviewController::class, 'store'])->name('books.new-review');
    Route::post('/books/{book}/reviews', [CustomerReviewController::class, 'show'])->name('books.all-reviews');
});
