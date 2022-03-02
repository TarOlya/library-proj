<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Model;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books->toJson(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $response = $this->createBook($request);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response($book->toJson(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BookRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {
        $response = null;

        $book = Book::find($id);
        if(empty($book)){
            $response = $this->createBook($request, $id);
        }else{
            $response = $this->updateBook($request, $book);
        }

        return $response;
    }

    private function createBook(BookRequest $request, $id = 0)
    {
        $response = null;

        if($this->isExists(new Author, $request->author_id)){
            if($this->isExists(new Genre, $request->genre_id)){
                if($id != 0){
                    $data = array_merge(['id' => $id], $request->all());
                }else{
                    $data = $request->all();
                }
                $book = Book::create($data);
                $response = response()->json($book->toJson(), 201);
            }else{
                $response = response()->json('No genre', 404);
            }
        }else{
            $response = response()->json('No author', 404);
        }
        return $response;
    }

    private function isExists($model, $id)
    {
        $tmp = $model::findOrFail($id);
        return boolval($tmp);
    }

    private function updateBook(BookRequest $request, Book $book){
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
       
        return response()->json('Deleted succesfully', 204);
    }
}
