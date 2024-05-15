<!-- resources/views/search-results.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Search Results for "{{ $query }}"</h1>
    @if($results->isEmpty())
        <p>No results found.</p>
    @else
        <ul>
            @foreach($results as $result)
                <li>{{ $result->column_name }}</li> <!-- Adjust this line to display the desired attribute -->
            @endforeach
        </ul>
    @endif
@endsection
