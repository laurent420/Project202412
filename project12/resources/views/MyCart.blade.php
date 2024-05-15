<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Bag') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <h2 class="text-2xl font-semibold mb-4">My Bag Items</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($cartItems as $cartItem)
                @if ($cartItem->item)
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">{{ $cartItem->item->name }}</h3>
                        <p>Quantity: {{ $cartItem->quantity }}</p>
                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mb-2 remove-from-cart" data-cart-item-id="{{ $cartItem->id }}">
                            Remove from Bag
                        </button>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
