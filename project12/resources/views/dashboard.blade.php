<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<<<<<<< HEAD
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <form action="/search" method="post">
    @csrf
    <input type="text" name="query" placeholder="Search">
    <input type="submit" value="Search">
</form>

                </div>
=======
    <div class="container mx-auto">
        <h2 class="text-2xl font-semibold mb-4">Items</h2>

        <!-- Button to Add Item (Visible only to admins) -->
        @if (auth()->check() && auth()->user()->isAdmin())
            <div class="mb-4">
                <a href="{{ route('additem') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Item</a>
>>>>>>> main
            </div>
        @endif

      <!-- Items Grid -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
@foreach ($items as $item)
    <div class="bg-gray-100 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">{{ $item->name }}</h3>
        <p class="text-sm mb-2">Amount Left: {{ $item->quantity }}</p>
        <img src="{{ asset('storage/' . $item->picture) }}" alt="{{ $item->name }}" class="w-full mb-2"> <!-- Adjusted image path -->
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2">Add to Bag</button>
        <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2">Add to Favorite</button>
    </div>
@endforeach

</div>
    
    </div>
</x-app-layout>
