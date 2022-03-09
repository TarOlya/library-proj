<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Requests\GenreRequest;
use Illuminate\Http\JsonResponse;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse {
        $genres = Genre::all();
        return response()->json($genres->toJson());
    }

    /**
     * Create the resource.
     *
     * @param  \App\Http\Requests\GenreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(GenreRequest $request): JsonResponse {
        $genre = Genre::create($request->all());
        return response()->json($genre->toJson(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse {
        $genre = Genre::findOrFail($id);
        return response()->json($genre->toJson());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GenreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(GenreRequest $request, $id): JsonResponse {
        $genre = Genre::findOrFail($id);
        $genre->update($request->all());

        return response()->json($genre->toJson());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return response()->json('Deleted succesfully', 204);
    }
}
