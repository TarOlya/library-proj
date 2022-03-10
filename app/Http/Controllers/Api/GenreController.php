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
     * @param  Genre  $genre
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Genre $genre): JsonResponse {
        return response()->json($genre->toJson());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GenreRequest  $request
     * @param  Genre  $genre
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(GenreRequest $request, Genre $genre): JsonResponse {
        $genre->update($request->all());
        return response()->json($genre->toJson());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Genre  $genre
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Genre $genre): JsonResponse {
        $genre->delete();
        return response()->json('Deleted succesfully', 204);
    }
}
