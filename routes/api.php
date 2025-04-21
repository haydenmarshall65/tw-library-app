<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;


Route::group(['middleware' => 'web', 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::get('/books', [BookController::class, 'index'])->name('books.index')->middleware('auth:sanctum');
});
