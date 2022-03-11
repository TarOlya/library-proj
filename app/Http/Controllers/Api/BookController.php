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
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Book $book): JsonResponse {
        return response()->json($book->toJson());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BookRequest  $request
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BookRequest $request, Book $book): JsonResponse {
        return $this->updateBook($request, $book);
    }

    /**
     * Will create the resource in storage if all objects of entities are exists.
     *
     * @param  \App\Http\Requests\BookRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    private function createBook(BookRequest $request): JsonResponse {
        $response = null;

        if($this->isExists(new Author, $request->author_id) && $this->isExists(new Genre, $request->genre_id)){
            $book = Book::create($request->all());
            $response = response()->json($book->toJson(), 201);
        }else{
            $response = $this->isExists(new Author, $request->author_id)?
                    response()->json('No genre', 404):
                    response()->json('No author', 404);
        }
        return $response;
    }

    /** 
     * Check if object exists in entity.
     * 
     * @param mixed  $model
     * @param int  $id
     * @return bool
     */
    private function isExists($model, $id): bool
    {
        $tmp = $model::find($id);
        return boolval($tmp);
    }

    /**
     * Will update the resource in storage if all objects of entities are exists.
     *
     * @param  \App\Http\Requests\BookRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    private function updateBook(BookRequest $request, Book $book): JsonResponse {
        $response = null;

        if($this->isExists(new Author, $request->author_id) && $this->isExists(new Genre, $request->genre_id)){
            $book->update($request->all());
            $response = response()->json($book->toJson(), 200);
        }else{
            $response = $this->isExists(new Author, $request->author_id)?
                        response()->json('No genre', 404):
                        response()->json('No author', 404);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Book $book): JsonResponse {
        $book->delete();
        return response()->json('Deleted succesfully', 204);
    }

    public function search(BookRequest $request){
        $query = $request->all();
        $search_result = Book::where('name', 'LIKE', '%'. $query['name'].'%')->get();
        return response()->json($search_result);
    }
}
