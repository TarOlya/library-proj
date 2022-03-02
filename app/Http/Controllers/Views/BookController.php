<?php

namespace App\Http\Controllers\Views;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function getAll()
    {
        $books = Book::all();
        return view('book.all')->with('books', $books);
    }

    public function getById($id = 0)
    {
        $book = $id != 0 ?
                Book::find($id):
                null;
        return view('book.one_item')
                ->with('book', $book)
                ->with('id', $id);
    }
}