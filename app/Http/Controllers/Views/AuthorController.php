<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function getAll()
    {
        $authors = Author::all();
        return view('author.all')->with('authors', $authors);
    }

    public function getById($id = 0)
    {
        $author = $id !=0 ?
                    Author::find($id):
                    null;
        return view('author.one_item')
                ->with('author', $author)
                ->with('id', $id);
    }
}
