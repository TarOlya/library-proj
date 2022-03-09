<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse {
        $books = Book::all();
        return response()->json($books->toJson(), 200);
    }

    /**
     * Create the resource.
     *
     * @param  \App\Http\Requests\BookRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(BookRequest $request): JsonResponse {
        $response = $this->createBook($request);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse {
        $book = Book::findOrFail($id);
        return response()->json($book->toJson(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BookRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BookRequest $request, $id): JsonResponse {
        $response = null;

        $book = Book::findOrFail($id);
        $response = $this->updateBook($request, $book);

        return $response;
    }

    private function createBook(BookRequest $request): JsonResponse {
        $response = null;

        if($this->isExists(new Author, $request->author_id)){
            if($this->isExists(new Genre, $request->genre_id)){
                $book = Book::create($request->all());
                $response = response()->json($book->toJson(), 201);
            }else{
                $response = response()->json('No genre', 404);
            }
        }else{
            $response = response()->json('No author', 404);
        }
        return $response;
    }

    private function isExists($model, $id): bool
    {
        $tmp = $model::find($id);
        return boolval($tmp);
    }

    private function updateBook(BookRequest $request, Book $book): JsonResponse {
        $response = null;

        if($this->isExists(new Author, $request->author_id)){
            if($this->isExists(new Genre, $request->genre_id)){
                $book->update($request->all());
                $response = response()->json($book->toJson(), 200);
            }else{
                $response = response()->json('No genre', 404);
            }
        }else{
            $response = response()->json('No author', 404);
        }
        
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json('Deleted succesfully', 204);
    }
}
