@extends('layouts.master')

@section('title', 'Authors')

@section('content')
    <p>
        All authors: 
    </p>
    <ul>
        @foreach ($authors as $author)
            <li>
                {{$author->name}}
            </li>
        @endforeach
    </ul>
@endsection