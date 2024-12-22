<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/movies', [MovieController::class, 'index']);


Route::get('/books', [BookController::class, 'index']);