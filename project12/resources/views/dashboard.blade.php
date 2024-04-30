<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <h2 class="text-2xl font-semibold mb-4">Items</h2>

<!-- Button to Add Item (Visible only to admins) -->
@if (auth()->check() && auth()->user()->isAdmin())
    <div class="mb-4">
        <a href="{{ route('additem') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Item</a>
    </div>
@endif



        <!-- Items Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Item 1 -->
            <div class="bg-gray-100 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">Item 1</h3>
                <p class="text-sm mb-2">Amount Left: 5</p>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2">Add to Bag</button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2">Add to Favorite</button>
            </div>

            <!-- Item 2 -->
            <div class="bg-gray-100 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">Item 2</h3>
                <p class="text-sm mb-2">Amount Left: 3</p>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2">Add to Bag</button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2">Add to Favorite</button>
            </div>
            
            <!-- Item 3 -->
            <div class="bg-gray-100 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">Item 3</h3>
                <p class="text-sm mb-2">Amount Left: 7</p>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2">Add to Bag</button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2">Add to Favorite</button>
            </div>

            <!-- Item 4 -->
            <div class="bg-gray-100 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">Item 4</h3>
                <p class="text-sm mb-2">Amount Left: 2</p>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2">Add to Bag</button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2">Add to Favorite</button>
            </div>

            <!-- Add more items here -->
        </div>
    </div>
</x-app-layout>
