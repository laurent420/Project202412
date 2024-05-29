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
                    <a href="{{ route('additem') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Add Item</a>
                </div>
            @endif
            <!-- Search Form -->
            <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                <input type="text" name="search" placeholder="Search items..." value="{{ request('search') }}" class="px-4 py-2 border rounded">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
            </form>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($items as $item)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-2">{{ $item->name }}</h3>
                            <p class="text-sm mb-2">Amount Left: {{ $item->quantity }}</p>
                            <img src="{{ asset($item->picture) }}" alt="{{ $item->name }}" class="w-full mb-2">
                            <a href="{{ route('item.show', $item->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2">Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-app-layout>
@else
<!-- niet admin -->
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="container mx-auto">
            <br>
            <!-- Search Form -->
            <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                <input type="text" name="search" placeholder="Search items..." value="{{ request('search') }}" class="px-4 py-2 border rounded">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
            </form>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($items as $item)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-2">{{ $item->name }}</h3>
                            <p class="text-sm mb-2">Amount Left: {{ $item->quantity }}</p>
                            <img src="{{ asset($item->picture) }}" alt="{{ $item->name }}" class="w-full mb-2">
                            @if ($item->quantity > 0)
                                <a href="{{ route('cart-items.store', $item->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2">Add to Bag</a>
                                <a href="{{ route('favourites.add', $item->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2">Add to Favorite</a>
                            @else
                                <button class="bg-gray-500 text-white px-4 py-2 rounded mb-2" disabled>Out of Stock</button>
                            @endif
                            <a href="{{ route('item.show', $item->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2">Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-app-layout>
@endif
