@extends('layouts.master')

@section('title', 'Genres')

@section('content')
    <p>
        All genres: 
    </p>
    <ul>
        @foreach ($genres as $genre)
            <li>
                {{$genre->name}}
            </li>
        @endforeach
    </ul>
@endsection