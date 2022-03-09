<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Controllers\Controller;

class GenreController extends Controller
{
    public function getAll()
    {
        $genres = Genre::all();
        return view('genre.all')->with('genres', $genres);
    }

    public function getById($id)
    {
        $genre = Genre::find($id);
        return view('genre.one_item')
                ->with('genre', $genre)
                ->with('id', $id);
    }
}
