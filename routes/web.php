<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Views;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/authors', [Views\AuthorController::class, 'getAll']);
Route::get('/authors/{id}', [Views\AuthorController::class, 'getById']);

Route::get('/genres', [Views\GenreController::class, 'getAll']);
Route::get('/genres/{id}', [Views\GenreController::class, 'getById']);

Route::get('/books', [Views\BookController::class, 'getAll']);
Route::get('/books/{id}', [Views\BookController::class, 'getById']);