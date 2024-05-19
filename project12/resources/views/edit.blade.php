<!-- resources/views/profile/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="bg-white p-8 rounded shadow-md mt-6">
        <h1 class="text-2xl font-bold mb-6">Edit Profile</h1>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ $user->name }}" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ $user->email }}" required>
            </div>

            <!-- Add more fields as necessary -->

            <div>
                <button type="submit">Update Profile</button>
            </div>
        </form>
    </div>
@endsection
