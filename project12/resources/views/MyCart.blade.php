<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Bag') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8" style="background-color: #f7f7f7; padding: 20px;">
        @foreach ($cartItems as $cartItem)
            @if ($cartItem->item)
                <div class="py-6">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white shadow-sm sm:rounded-lg" style="background-color: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                            <div class="p-6 text-gray-900" style="padding: 24px;">
                                <h3 class="text-lg font-semibold mb-2" style="font-size: 1.25rem; margin-bottom: 8px;">{{ $cartItem->item->name }}</h3>
                                <p>Quantity: {{ $cartItem->quantity }}</p>
                                <form action="{{ route('bookings.store') }}" method="POST" class="booking-form" style="margin-bottom: 16px;">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $cartItem->item->id }}">
                                    <div style="margin-bottom: 8px;">
                                        <label for="startDate" style="margin-right: 8px;">Start Date:</label>
                                        <input type="date" id="startDate" name="start_date" required style="padding: 4px; border: 1px solid #ccc; border-radius: 4px;">
                                    </div>
                                    <div style="margin-bottom: 16px;">
                                        <label for="endDate" style="margin-right: 8px;">End Date:</label>
                                        <input type="date" id="endDate" name="end_date" required style="padding: 4px; border: 1px solid #ccc; border-radius: 4px;">
                                    </div>
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600" style="background-color: #10B981; color: white; padding: 8px 16px; border-radius: 4px; transition: background-color 0.3s ease;">Book Item</button>
                                </form>
                                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mb-2 float-right remove-from-cart" data-cart-item-id="{{ $cartItem->id }}" style="background-color: #EF4444; color: white; padding: 8px 16px; border-radius: 4px; transition: background-color 0.3s ease;">
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
        document.querySelectorAll('form.booking-form').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const formData = new FormData(form);
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
