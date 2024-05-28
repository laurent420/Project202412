@if (auth()->check() && auth()->user()->is_banned == 1)
    <h1>You are banned</h1>
@else
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include Bootstrap CSS and JS for modal functionality -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>
    

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
        </x-slot>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($users as $user)
                <div class="py-3">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-2">{{ $user->name }}</h3>
                            <p class="text-sm mb-2">ID: {{ $user->id }}</p>
                            @if ($user->is_banned == 1)
                                <form method="POST" action="{{ route('users.unban', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                        Unban User
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('users.ban', $user->id) }}">
                                    @csrf   
                                    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" data-toggle="modal"
                                    data-target="#banUserModal{{ $user->id }}">
                                        Ban user
                                    </button>
                                        @include('components.modal', ['user' => $user])                                    
                                </form>


                                <!-- Modal Component -->
                                
                                

                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-app-layout>
@endif
</body>
</html>