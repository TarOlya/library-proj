<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('authors', [Api\AuthorController::class, 'index']);
Route::get('authors/{id}', [Api\AuthorController::class, 'show']);
Route::put('authors/{id}', [Api\AuthorController::class, 'update']);
Route::post('authors', [Api\AuthorController::class, 'store']);
Route::delete('authors/{id}', [Api\AuthorController::class, 'destroy']);


Route::get('genres', [Api\GenreController::class, 'index']);
Route::get('genres/{id}', [Api\GenreController::class, 'show']);
Route::put('genres/{id}', [Api\GenreController::class, 'update']);
Route::post('genres', [Api\GenreController::class, 'store']);
Route::delete('genres/{id}', [Api\GenreController::class, 'destroy']);


Route::get('books', [Api\BookController::class, 'index']);
Route::get('books/{id}', [Api\BookController::class, 'show']);
Route::put('books/{id}', [Api\BookController::class, 'update']);
Route::post('books', [Api\BookController::class, 'store']);
Route::delete('books/{id}', [Api\BookController::class, 'destroy']);