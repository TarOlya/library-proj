@extends('layouts.master')

@section('title', 'Book')

@section('content')
    @if(isset($book))
        <p>
            Book: {{$book->name}}
        </p>
    @else
        <p>
            No book with ID {{$id}}
        </p>
    @endif
@endsection