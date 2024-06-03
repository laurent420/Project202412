<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Include Bootstrap CSS and JS for modal functionality -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Admin -->
    @if (auth()->check() && auth()->user()->isAdmin())
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>
            <div class="container mx-auto">
                <br>
                @if (auth()->check() && auth()->user()->isAdmin())
                    <div class="mb-4">
                        <a href="{{ route('additem') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Add
                            Item</a>
                    </div>
                @endif
                <!-- Search Form -->
                <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                    <input type="text" name="search" placeholder="Search items..." value="{{ request('search') }}"
                        class="px-4 py-2 border rounded">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
                </form>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($item_groups as $group)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h3 class="text-lg font-semibold mb-2">{{ $group->brand }} {{ $group->name }}</h3>
                                <p class="text-sm mb-2">Total Items: {{ $group->items->count() }}</p>
                                <img src="{{ asset($group->picture) }}" alt="{{ $group->name }}" class="w-full mb-2">
                                <form method="POST" action="{{ route('dashboard.remove', $group->id) }}">
                                    @csrf
                                    @method('POST')
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#detailModal{{ $group->id }}">
                                        Details
                                    </button>
                                    @include('components.modalDetails', ['group' => $group])
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-app-layout>
    @else
        <!-- Not Admin -->
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>
            <div class="container mx-auto"><br>
                <!-- Search Form -->
                <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                    <input type="text" name="search" placeholder="Search items..." value="{{ request('search') }}"
                        class="px-4 py-2 border rounded">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
                </form>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($item_groups as $group)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h3 class="text-lg font-semibold mb-2">{{ $group->brand }} {{ $group->name }}</h3>
                                <p class="text-sm mb-2">Total Items: {{ $group->items->count() }}</p>
                                <img src="{{ asset($group->picture) }}" alt="{{ $group->name }}" class="w-full mb-2">
                                @if ($group->quantity != 0)
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2 add-to-cart" data-item-id="{{ $group->id }}" data-url="{{ route('cart-items.store') }}">Add to bag</button>
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2 add-to-favorites"
                                        data-item-id="{{ $group->id }}" data-url="{{ route('favourites.add') }}">Add to Favorites</button>
                                @else
                                    <button class="bg-gray-500 text-white px-4 py-2 rounded mb-2" disabled>Out of Stock</button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-app-layout>
    @endif
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function () {
            const itemId = this.dataset.itemId;
            const url = this.dataset.url;

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    item_id: itemId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.success);
                } else {
                    alert(data.error);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    document.querySelectorAll('.add-to-favorites').forEach(button => {
        button.addEventListener('click', function () {
            const itemId = this.getAttribute('data-item-id');
            const url = this.getAttribute('data-url');

            console.log('Adding item to favorites:', itemId); // Log the item ID
            console.log('URL:', url); // Log the URL

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ item_group_id: itemId })
            })
            .then(response => {
                console.log('Response status:', response.status); // Log the response status
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data); // Log the response data
                if (data.message === 'Item added to favorites.') {
                    alert('Item added to favorites!');
                } else if (data.message === 'Item already favorited.') {
                    alert('Item already favorited.');
                } else {
                    alert('Failed to add item to favorites.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding the item to favorites.');
            });
        });
    });
});

</script>
