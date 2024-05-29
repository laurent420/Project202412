@if ( auth()->user()->is_banned  == 1)
    <h1>You are banned</h1>    

@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Bag') }}
            </h2>
        </x-slot>
    


            

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @php
                    $bagIsEmpty = true;
                @endphp

                @foreach ($cartItems as $cartItem)
                    @if ($cartItem->item)
                        @php
                            $bagIsEmpty = false;
                        @endphp
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">{{ $cartItem->item->name }}</h3>
                            <p>Quantity: {{ $cartItem->quantity }}</p>
                            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mb-2 remove-from-cart" data-cart-item-id="{{ $cartItem->id }}">
                                Remove from Bag
                            </button>
                        </div>
                    @endif
                @endforeach

                
                @if ($bagIsEmpty)
            
                <div class="flex items-center justify-center h-full">
        <h3 class="font-semibold mb-2 text-center text-4xl">Nothing in your bag</h3>
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
