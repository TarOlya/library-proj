<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Views\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Requests\GenreRequest;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::all();
        return response()->json($genres->toJson(), 200);
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
     * @param  \App\Http\Requests\GenreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreRequest $request)
    {
        $genre = new Genre;
        $genre->name = $request->name;
        $genre->save();
        return response()->json($genre->toJson(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genre = Genre::findOrFail($id);
        return response()->json($genre->toJson(), 200);
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
     * @param  \App\Http\Requests\GenreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GenreRequest $request, $id)
    {
        $response = null;

        $genre = Genre::find($id);
        if(!empty($request->name)){
            if(empty($genre)){
                $genre = new Genre;
                $genre->name = $request->name;
                $genre->id = $id;
                $genre->save();
                $response = response()->json($genre->toJson(), 201);
            }else{
                $genre->update($request->all());
                $response = response()->json($genre->toJson(), 200);
            }
        }

        return $response?
                $response:
                response()->json('No correct params', 405);
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

        $genre = Genre::find($id);
        if(!empty($genre)){
            $isDeleted = $genre->delete();
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
