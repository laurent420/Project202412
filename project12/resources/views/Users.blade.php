@if (auth()->check() && auth()->user()->is_banned == 1)
    <h1>You are banned</h1>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
        </x-slot>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($users as $user)
                <div class="py-12">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-2">{{ $user->name }}</h3>
                            <p class="text-sm mb-2">ID: {{ $user->id }}</p>

                            @if (auth()->user()->isAdmin())
                                <div class="flex space-x-4">
                                    @if ($user->is_banned == 1)
                                        <form method="POST" action="{{ route('users.unban', $user->id) }}">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Unban User</button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('users.ban', $user->id) }}">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Ban User</button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('users.returned', $user->id) }}">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Returned</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-app-layout>
@endif
