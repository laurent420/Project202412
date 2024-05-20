<!-- resources/views/profile.blade.php -->

@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <div class="bg-white p-8 rounded shadow-md mt-6">
        <h1 class="text-2xl font-bold mb-6">User Profile</h1>

        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <!-- Add more fields as necessary -->
    </div>
@endsection
