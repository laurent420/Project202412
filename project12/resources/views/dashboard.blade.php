<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <h2 class="text-2xl font-semibold mb-4">Items</h2>

        <div class="mb-4">
            <form action="{{ route('dashboard') }}" method="GET" class="flex items-center space-x-4">
                <input type="text" name="query" placeholder="Search..." class="px-4 py-2 border rounded">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
                
                <select name="category" onchange="this.form.submit()" class="px-4 py-2 border rounded">
                    <option value="">All Categories</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Cameras">Cameras</option>
                    <option value="Printers">Printers</option>
                    <option value="Screens">Screens</option>

                </select>
            </form>
        </div>

        @if (auth()->check() && auth()->user()->isAdmin())
            <div class="mb-4">
                <a href="{{ route('additem') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Item</a>
            </div>
        @endif
        
        @foreach ($items as $item)
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-2">{{ $item->name }}</h3>
                            <p class="text-sm mb-2">Amount Left: {{ $item->quantity }}</p>
                            <img src="{{ asset('storage/' . $item->picture) }}" alt="{{ $item->name }}" class="w-full mb-2">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2 add-to-cart" data-item-id="{{ $item->id }}" data-url="{{ route('cart-items.store') }}">Add to Bag</button>
                            <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2 add-to-favorite" data-item-id="{{ $item->id }}" data-url="{{ route('favourites.add') }}" onclick="addToFavorite({{ $item->id }})">Add to Favorite</button>
                            
                            <button id="openCalendarBtn-{{ $item->id }}">Selecteer datum</button>
                            <input type="text" id="selectedDate-{{ $item->id }}" name="selected_date">
                            <form action="{{ route('bookings.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <input type="hidden" name="start_date" id="bookingStartDate-{{ $item->id }}">
                                <input type="hidden" name="end_date" id="bookingEndDate-{{ $item->id }}">
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Book Item</button>
                            </form>
                        </div>

                        <!-- Serial Number Input -->
                        <div class="mb-4">
                            <label for="serialnumber" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Serial Number</label>
                            <input type="text" id="serialnumber" name="serialnumber" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Item Picture Input -->
                        <div class="mb-4">
                            <label for="picture" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item Picture</label>
                            <input type="file" id="picture" name="picture" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Add Item</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const items = @json($items);

    items.forEach(item => {
        const selectedDateInput = document.getElementById('selectedDate-' + item.id);
        const bookingStartDate = document.getElementById('bookingStartDate-' + item.id);
        const bookingEndDate = document.getElementById('bookingEndDate-' + item.id);

        selectedDateInput.addEventListener('change', function () {
            const dates = selectedDateInput.value.split('-');
            bookingStartDate.value = dates[0];
            bookingEndDate.value = dates[1];
        });

        async function fetchUnavailableDates(itemId) {
            const response = await fetch(`{{ route('api.unavailable-dates', '') }}/${itemId}`);
            const data = await response.json();
            return data.dates.map(date => new Date(date));
        }

        async function initializeDatePicker(itemId) {
            const unavailableDates = await fetchUnavailableDates(itemId);

            flatpickr(selectedDateInput, {
                dateFormat: "d/m/Y",
                enableTime: false,
                disable: [
                    function(date) {
                        return (date.getDay() !== 1 || unavailableDates.some(d => d.getTime() === date.getTime()));
                    }
                ],
                onClose: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length > 0) {
                        const selectedDate = new Date(selectedDates[0]);
                        const nextFriday = new Date(selectedDate);
                        nextFriday.setDate(selectedDate.getDate() + (5 - selectedDate.getDay() + 7) % 7);

                        const mondayDateStr = formatDate(selectedDate);
                        const fridayDateStr = formatDate(nextFriday);

                        selectedDateInput.value = `${mondayDateStr}-${fridayDateStr}`;
                    }
                }
            });
        }

        function formatDate(date) {
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }

        initializeDatePicker(item.id);
    });
});
</script>
