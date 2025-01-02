<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:api');


Route::middleware(['auth:api'])->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware(['role:admin,staff'])->group(function() {
        Route::apiResource('/books', BookController::class)->only(['store','update','destroy']);
        Route::apiResource('/genres', GenreController::class)->only(['store','update','destroy']);
        Route::apiResource('/authors', AuthorController::class)->only(['store','update','destroy']);
    });

    Route::middleware(['role:customer'])->group(function() {
        Route::apiResource('/orders',OrderController::class);
    });
});

Route::apiResource('/books',BookController::class)->only(['index','show']);
Route::apiResource('/genres',GenreController::class)->only(['index','show']);
Route::apiResource('/authors',AuthorController::class)->only(['index','show']);


// Route::get('/tes', function () {
//     return  "ORD-" . strtoupper(uniqid()); // yg "ORD-" . ITU adalah concat 
// });

// Route::get('/books',[BookController::class,'index']);
// Route::post('/books',[BookController::class,'store']);
// Route::get('/books/{id}',[BookController::class,'show']);
// Route::put('/books/{id}',[BookController::class,'update']);
// Route::delete('/books/{id}',[BookController::class,'destroy']);

// Route::get('/genres',[GenreController::class,'index']);
// Route::post('/genres',[GenreController::class,'store']);
// Route::get('/genres/{id}',[GenreController::class,'show']);
// Route::put('/genres/{id}',[GenreController::class,'update']);
// Route::delete('/genres/{id}',[GenreController::class,'destroy']);

// Route::get('/authors',[AuthorController::class,'index']);
// Route::post('/authors',[AuthorController::class,'store']);
// Route::get('/authors/{id}',[AuthorController::class,'show']);
// Route::put('/authors/{id}',[AuthorController::class,'update']);
// Route::delete('/authors/{id}',[AuthorController::class,'destroy']);

// Route::apiResource('/books',BookController::class);
// Route::apiResource('/genres',GenreController::class);

