@extends('layouts.master')

@section('title', 'Books')

@section('content')
    <p>
        All books: 
    </p>
    <ul>
        @foreach ($books as $book)
            <li>
                {{$book->name}}
            </li>
        @endforeach
    </ul>
@endsection