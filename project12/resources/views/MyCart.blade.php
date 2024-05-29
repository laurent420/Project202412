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
                                <form action="{{ route('bookings.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $cartItem->item->id }}">
                                    <label for="startDate">Start Date:</label>
                                    <input type="date" id="startDate" name="start_date" required>
                                    <label for="endDate">End Date:</label>
                                    <input type="date" id="endDate" name="end_date" required>
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Book Item</button>
                                </form>
                                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mb-2 float-right remove-from-cart" data-cart-item-id="{{ $cartItem->id }}">
                                    Remove from Bag
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
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

    // Handle removing item from cart
    document.querySelectorAll('.remove-from-cart').forEach(button => {
        button.addEventListener('click', function () {
            const cartItemId = this.getAttribute('data-cart-item-id');
            const url = `/cart-items/${cartItemId}`;

            fetch(url, {
                method: 'DELETE',
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
                if (data.message) {
                    window.location.reload();
                } else {
                    alert('Failed to remove item from bag.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });
    });
});
</script>



</x-app-layout>
