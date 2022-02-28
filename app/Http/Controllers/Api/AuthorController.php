<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Views\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors->toJson(), 200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AuthorRequest $request)
    {
        $author = new Author;
        $author->name = $request->name;
        $author->save();
        return response()->json($author->toJson(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::findOrFail($id);
        return $author?
                response()->json($author->toJson(), 200):
                response()->json("No obj", 404);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\AuthorRequest $request, $id)
    {
        $response = null;

        $author = Author::find($id);
        if(!empty($request->name)){
            if(empty($author)){
                $author = new Author;
                $author->name = $request->name;
                $author->id = $id;
                $author->save();
                $response = response()->json($author->toJson(), 201); //create new author
            }else{
                $author->update($request->all()); //edit existing author
                $response = response()->json($author->toJson(), 200);
            }
        }

        return $response?
                $response:
                response()->json('No params', 405);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = null;

        $author = Author::find($id);
        if(!empty($author)){
            $isDeleted = $author->delete();
            if($isDeleted){
                $response = response()->json('Deleted succesfully', 200);
            }else{
                $response = response()->json('Not deleted', 400);
            }
        }
        
        return $response?
                $response:
                response()->json('Not found obj', 404);
    }
}