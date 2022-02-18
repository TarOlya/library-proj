@extends('layouts.master')

@section('title', 'Author')

@section('content')
    @if(isset($author))
        <p>
            Author: {{$author->name}}
        </p>
    @else
        <p>
            No author with ID {{$id}}
        </p>
    @endif
@endsection