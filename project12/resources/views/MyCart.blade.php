<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Bag') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
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
                        <form action="{{ route('cart-items.remove', $cartItem->id) }}" method="POST" class="inline-block">
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle booking form submission
            document.querySelectorAll('form.booking-form').forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault(); // Prevent the default form submission

                    // Fetch the form data
                    const formData = new FormData(form);

                    // Send a POST request to the server
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => { throw err; });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.errors) {
                                alert(Object.values(data.errors).join('\n'));
                            } else {
                                alert('Item booked successfully.');
                                window.location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        });
                });
            });

            // Remove from Cart
            document.querySelectorAll('.remove-from-cart').forEach(button => {
                button.addEventListener('click', function () {
                    const itemId = this.getAttribute('data-item-id');
                    const url = this.getAttribute('data-url');

                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ item_id: itemId })
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.message === 'Item removed from cart') {
                                alert('Item removed from cart!');
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while removing the item from the bag.');
                        });
                });
            });
        });
        
    document.addEventListener('DOMContentLoaded', function () {
        const lendDateInput = document.getElementById('lend_date');
        const today = new Date().toISOString().split('T')[0];
        lendDateInput.setAttribute('min', today);
    });


    </script>



</x-app-layout>
