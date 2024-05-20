<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Bag') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
    @foreach ($cartItems as $cartItem)
                @if ($cartItem->item)
        <div class="py-12">
            
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-2">{{ $cartItem->item->name }}</h3>
                        <p>Quantity: {{ $cartItem->quantity }}</p>
                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mb-2 float-right remove-from-cart" data-cart-item-id="{{ $cartItem->id }}">
                            Remove from Bag
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif
    @endforeach
</x-app-layout>
