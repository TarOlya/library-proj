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

    public function getById($id)
    {
        $book = Book::find($id);
        return view('book.one_item')
                ->with('book', $book)
                ->with('id', $id);
    }
}