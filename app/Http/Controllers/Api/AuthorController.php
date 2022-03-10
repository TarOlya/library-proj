<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Http\Requests\AuthorRequest;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse {
        $authors = Author::all();
        return response()->json($authors->toJson(), 200);
    }

    /**
     * Create the resource.
     *
     * @param  AuthorRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(AuthorRequest $request): JsonResponse {
        $author = Author::create($request->all());
        return response()->json($author->toJson(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Author  $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Author $author): JsonResponse {
        return response()->json($author->toJson());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AuthorRequest  $request
     * @param  Author  $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AuthorRequest $request, Author $author): JsonResponse {
        $author->update($request->all());
        return response()->json($author->toJson());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Author  $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Author $author): JsonResponse {
        $author->delete();
        return response()->json('Deleted succesfully', 204);
    }
}