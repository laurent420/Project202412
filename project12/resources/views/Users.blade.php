@if (auth()->check() && auth()->user()->is_banned == 1)
    <h1 class="text-center text-danger mt-5">You are banned</h1>
@else
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
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

        <div class="container mt-5">
            @foreach ($users as $user)
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">{{ $user->name }}</h3>
                        <p class="card-text">ID: {{ $user->id }}</p>
                        @if ($user->is_banned == 1)
                            <form method="POST" action="{{ route('users.unban', $user->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    Unban User
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('users.ban', $user->id) }}">
                                @csrf
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#banUserModal{{ $user->id }}">
                                    Ban User
                                </button>
                                @include('components.modal', ['user' => $user])
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Modal Component -->
                <div class="modal fade" id="banUserModal{{ $user->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="banUserModalLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="banUserModalLabel{{ $user->id }}">Ban User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to ban {{ $user->name }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <form method="POST" action="{{ route('users.ban', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Ban User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-app-layout>
@endif
</body>

</html>
