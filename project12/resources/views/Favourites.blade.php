<link rel="stylesheet" href="/css/favourites.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Favourites') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        @foreach ($favorites as $favorite)
            @if ($favorite->item)
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold mb-2">{{ $favorite->item->name }}</h3>
                                    <img src="project12/public/images/heart.png" alt="Heart" class="w-6 h-6 ml-2">
                                </div>
                                <div class="w-full flex-none text-sm font-medium text-slate-700 mt-2">
                                    amount left:
                                </div>
                                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2">Add to Bag</button>
                            </div>
                        </div>
<<<<<<< Updated upstream
                        <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2 float-right">Unfavourite</button>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2 float-right add-to-cart"
                                        data-item-id="{{ $favorite->item->id }}"
                                        data-url="{{ route('cart-items.store') }}">
                                    Add to Bag
                                </button>                        <!-- Display other item details -->
                    </div>

                </div>     
         
            </div>
        </div>
        @endif
=======
                    </div>
                </div>
            @endif
>>>>>>> Stashed changes
        @endforeach
    </div>

    <!-- Add the JavaScript code for handling the button click -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Select all buttons with the class 'add-to-cart'
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            
            // Loop through each button and add a click event listener
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault(); // Prevent the default action
                    const itemId = this.getAttribute('data-item-id');
                    const url = this.getAttribute('data-url');
                    
                    // Disable the button to prevent multiple clicks
                    this.disabled = true;

                    // Create a form data object
                    const formData = new FormData();
                    formData.append('item_id', itemId);
                    
                    // Make an AJAX request to add the item to the cart
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        this.disabled = false; // Re-enable the button
                        if (data.success) {
                            alert('Failed to add item to bag.');
                        } else {
                            alert('Item added to bag successfully!');
                        }
                    })
                    .catch(error => {
                        this.disabled = false; // Re-enable the button
                        console.error('Error:', error);
                        alert('An error occurred.');
                    });
                });
            });
        });
    </script>
</x-app-layout>

