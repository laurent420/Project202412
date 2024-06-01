<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Favourites') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8" style="background-color: #f7f7f7; padding: 20px;">
        @foreach ($favorites as $favorite)
            @if ($favorite->item)
                <div class="py-6">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white shadow-sm sm:rounded-lg" style="background-color: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                            <div class="p-6 text-gray-900" style="padding: 24px;">
                                <h3 class="text-lg font-semibold mb-2" style="font-size: 1.25rem; margin-bottom: 8px;">{{ $favorite->item->name }}</h3>
                                <div class="text-sm font-medium text-slate-700 mb-4" style="margin-bottom: 16px; color: #4a5568;">
                                    Amount left:  <!-- Je kunt hier de hoeveelheid invoegen -->
                                </div>
                                <div class="flex justify-end space-x-2">
                                    <!-- Unfavourite Button -->
                                    <button class="unfavourite" style="background-color: #D97706; color: white; padding: 8px 16px; border-radius: 4px; transition: background-color 0.3s ease;"
                                            data-favourite-id="{{ $favorite->id }}"
                                            data-url="{{ route('favourites.remove', $favorite->id) }}">
                                        Unfavourite
                                    </button>
                                    <!-- Add to Bag Button -->
                                    <button class="add-to-cart" style="background-color: #1D4ED8; color: white; padding: 8px 16px; border-radius: 4px; transition: background-color 0.3s ease;"
                                            data-item-id="{{ $favorite->item->id }}"
                                            data-url="{{ route('cart-items.store') }}">
                                        Add to Bag
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- JavaScript code for handling the button click -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const itemId = this.getAttribute('data-item-id');
                const url = this.getAttribute('data-url');
                this.disabled = true;
                const formData = new FormData();
                formData.append('item_id', itemId);
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    this.disabled = false;
                    if (data.success) {
                        alert('Item added to bag successfully!');
                    } else {
                        alert('Failed to add item to bag.');
                    }
                })
                .catch(error => {
                    this.disabled = false;
                    console.error('Error:', error);
                    alert('An error occurred.');
                });
            });
        });

        const unfavouriteButtons = document.querySelectorAll('.unfavourite');
        unfavouriteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const favouriteId = this.getAttribute('data-favourite-id');
                const url = this.getAttribute('data-url');
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        button.closest('.max-w-7xl').remove();
                        alert('Item removed from favourites successfully!');
                    } else {
                        alert('Failed to remove item from favourites.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred.');
                });
            });
        });
    });
    </script>
</x-app-layout>
