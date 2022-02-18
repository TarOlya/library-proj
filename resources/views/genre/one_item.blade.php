@extends('layouts.master')

@section('title', 'Genre')

@section('content')
    @if(isset($genre))
        <p>
            Genre: {{$genre->name}}
        </p>
    @else
        <p>
            No Genre with ID {{$id}}
        </p>
    @endif
@endsection