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
Route::get('authors/{author}', [Api\AuthorController::class, 'show']);
Route::patch('authors/{author}', [Api\AuthorController::class, 'update']);
Route::post('authors', [Api\AuthorController::class, 'create']);
Route::delete('authors/{author}', [Api\AuthorController::class, 'destroy']);


Route::get('genres', [Api\GenreController::class, 'index']);
Route::get('genres/{genre}', [Api\GenreController::class, 'show']);
Route::patch('genres/{genre}', [Api\GenreController::class, 'update']);
Route::post('genres', [Api\GenreController::class, 'create']);
Route::delete('genres/{genre}', [Api\GenreController::class, 'destroy']);


Route::get('books', [Api\BookController::class, 'index']);
Route::get('books/{book}', [Api\BookController::class, 'show']);
Route::patch('books/{book}', [Api\BookController::class, 'update']);
Route::post('books', [Api\BookController::class, 'create']);
Route::delete('books/{book}', [Api\BookController::class, 'destroy']);

Route::get('search/authors', [Api\AuthorController::class, 'search']);
Route::get('search/genres', [Api\GenreController::class, 'search']);
Route::get('search/books', [Api\BookController::class, 'search']);