@if ( auth()->user()->is_banned  == 1)
    <h1>You are banned</h1>    

<<<<<<< HEAD
@else
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
@endif
=======
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
>>>>>>> e578d589131416473b9de7a517e2b9115aea5dab
