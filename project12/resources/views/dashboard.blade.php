<<<<<<< Updated upstream
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
                <input type="text" name="search" placeholder="Search items..." value="{{ request('search') }}"
                    class="px-4 py-2 border rounded">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
            </form>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($items as $item)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-2">{{ $item->name }}</h3>
                            <p class="text-sm mb-2">Amount Left: {{ $item->quantity }}</p>
                            <img src="{{ asset($item->picture) }}" alt="{{ $item->name }}" class="w-full mb-2">
                            <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2 details"
                                data-item-id="{{ $item->id }}" data-url="{{ route('item.show', $item->id) }}">Details</button>
                            @if ($item->status == 0)
                                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2 add-to-cart"
                                    data-item-id="{{ $item->id }}" data-url="{{ route('cart-items.store') }}">Add to Bag</button>
                                <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2 add-to-favorite"
                                    data-item-id="{{ $item->id }}" data-url="{{ route('favourites.add') }}"
                                    onclick="addToFavorite({{ $item->id }})">Add to Favorite</button>
                            @else
                                <button class="bg-gray-500 text-white px-4 py-2 rounded mb-2" disabled>Out of Stock</button>
                            @endif
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
                <input type="text" name="search" placeholder="Search items..." value="{{ request('search') }}"
                    class="px-4 py-2 border rounded">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
            </form>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($items as $item)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-2">{{ $item->name }}</h3>
                            <p class="text-sm mb-2">Amount Left: {{ $item->quantity }}</p>
                            <img src="{{ asset($item->picture) }}" alt="{{ $item->name }}" class="w-full mb-2">
                            @if ($item->status == 0)
                                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2 add-to-cart"
                                    data-item-id="{{ $item->id }}" data-url="{{ route('cart-items.store') }}">Add to Bag</button>
                                <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2 add-to-favorite"
                                    data-item-id="{{ $item->id }}" data-url="{{ route('favourites.add') }}"
                                    onclick="addToFavorite({{ $item->id }})">Add to Favorite</button>
                            @else
                                <button class="bg-gray-500 text-white px-4 py-2 rounded mb-2" disabled>Out of Stock</button>
                            @endif
                            <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2 details"
                                data-item-id="{{ $item->id }}" data-url="{{ route('item.show', $item->id) }}">Details</button>
                        </div>
                    </div>
                @endforeach
            </div>
=======
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
                        @if ($item->quantity > 0)
                            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2 add-to-cart" data-item-id="{{ $item->id }}" data-url="{{ route('cart-items.store') }}">Add to Bag</button>
                            <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2 add-to-favorite" data-item-id="{{ $item->id }}" data-url="{{ route('favourites.add') }}" onclick="addToFavorite({{ $item->id }})">Add to Favorite</button>
                        @else
                            <button class="bg-gray-500 text-white px-4 py-2 rounded mb-2" disabled>Out of Stock</button>
                        @endif
                        @if (auth()->check() && auth()->user()->isAdmin() && $item->quantity == 0)
                            <form method="POST" action="{{ route('items.destroy', $item) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Remove from Dashboard</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
>>>>>>> Stashed changes
        </div>
    </x-app-layout>
@endif

<!-- Detail Modal -->
<div id="detailModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-
            8 py-6 sm:px-10">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Item Details
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                <!-- Here, display the details of the item -->
                                Serial Number: <span id="serialNumber"></span><br>
                                ID: <span id="itemId"></span><br>
                                Name: <span id="itemName"></span><br>
                                Brand: <span id="itemBrand"></span><br>
                                <!-- Add more details as needed -->
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="button" class="bg-blue-500 text-white hover:bg-blue-600 px-4 py-2 rounded-md shadow-sm focus:outline-none"
                        onclick="closeDetailModal()">Close</button>
                </div>
            </div>
        </div>
    </div>
<<<<<<< Updated upstream
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add to Cart
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function () {
                const itemId = this.getAttribute('data-item-id');
                const url = this.getAttribute('data-url');

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ item_id: itemId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Failed to add item to bag.');
                        } else {
                            alert('Item added to bag!');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while adding the item to the bag.');
                    });
            });
        });

        // Add to Favorite
        document.querySelectorAll('.add-to-favorite').forEach(button => {
            button.addEventListener('click', function () {
                const itemId = this.getAttribute('data-item-id');
                const url = this.getAttribute('data-url');

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ item_id: itemId })
                })

                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Failed to add item to favorite.');
                        } else {
                            alert('Item added to favorite!');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while adding the item to favorite.');
                    });
            });
        });

        // Item Details
        document.querySelectorAll('.details').forEach(button => {
            button.addEventListener('click', function () {
                const itemId = this.getAttribute('data-item-id');
                const url = this.getAttribute('data-url');

                // Fetch the item details
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update the modal with item details
                            document.getElementById('serialNumber').innerText = data.item.serialnumber;
                            document.getElementById('itemId').innerText = data.item.id;
                            document.getElementById('itemName').innerText = data.item.name;
                            document.getElementById('itemBrand').innerText = data.item.brand;

                            // Show the detail modal
                            document.getElementById('detailModal').classList.remove('hidden');
                        } else {
                            // Handle error if item details couldn't be fetched
                            console.error('Failed to fetch item details.');
                            alert('Failed to fetch item details.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while fetching item details.');
                    });
            });
        });

        // Function to close the detail modal
        window.closeDetailModal = function () {
            document.getElementById('detailModal').classList.add('hidden');
        };
    });
</script>
=======
</x-app-layout>
>>>>>>> Stashed changes
