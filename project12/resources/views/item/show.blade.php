<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Item Details') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <br>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-semibold mb-2">{{ $item->name }}</h3>
                <p><strong>ID:</strong> {{ $item->id }}</p>
                <p><strong>Serial Number:</strong> {{ $item->serialnumber }}</p>
                <p><strong>Brand:</strong> {{ $item->brand }}</p>
                <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
                <img src="{{ asset($item->picture) }}" alt="{{ $item->name }}" class="w-full mb-2">
                <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Back to Dashboard</a>
            </div>
        </div>
    </div>
</x-app-layout>
