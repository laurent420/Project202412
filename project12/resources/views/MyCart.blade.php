<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Bag') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">Your Cart</h1>

        @if ($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($cartItems as $cartItem)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-2">{{ $cartItem->itemGroup->brand }} {{ $cartItem->itemGroup->name }}</h3>
                            <img src="{{ asset($cartItem->itemGroup->picture) }}" alt="{{ $cartItem->itemGroup->name }}" class="w-full mb-2">
                            <form action="{{ route('cart-items.remove', $cartItem->id) }}" method="POST" class="inline-block remove-from-cart-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mb-2">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Date picker and lend button -->
            <div class="mt-6">
                <form action="{{ route('cart-items.lend') }}" method="POST">
                    @csrf
                    <label for="lend_date" class="block text-lg font-medium text-gray-700 dark:text-gray-100">Select Lending Date</label>
                    <input type="date" id="lend_date" name="lend_date" class="mt-1 p-2 border rounded" required>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-2">Lend Items</button>
                </form>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set the minimum date for lending date input
            const lendDateInput = document.getElementById('lend_date');
            const today = new Date().toISOString().split('T')[0];
            lendDateInput.setAttribute('min', today);

            // Remove item from cart functionality
            document.querySelectorAll('.remove-from-cart-form').forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault(); // Prevent the default form submission

                    // Get the action URL and CSRF token
                    const url = form.action;
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Send a DELETE request to the server
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Content-Type': 'application/json',
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => { throw err; });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.message === 'Item removed from cart') {
                            alert('Item removed from cart!');
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while removing the item from the cart. Please try again.');
                    });
                });
            });
        });
    </script>
</x-app-layout>
