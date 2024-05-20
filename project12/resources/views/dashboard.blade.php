<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <h2 class="text-2xl font-semibold mb-4">Items</h2>
        <!-- Example -->
<div class="searchbar">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search...">
        <button type="submit">Search</button>
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
                            <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2 add-to-favorite"
    data-item-id="{{ $item->id }}" data-url="{{ route('favourites.add') }}"
    onclick="addToFavorite({{ $item->id }})">Add to Favorite</button>

                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                            
                            <button id="openCalendarBtn">Selecteer datum</button>
                            <input type="text" id="selectedDate" name="selected_date">
                            <form action="{{ route('bookings.store') }}" method="POST">
    @csrf
    <input type="hidden" name="item_id" value="{{ $item->id }}">
    <input type="hidden" name="start_date" id="bookingStartDate">
    <input type="hidden" name="end_date" id="bookingEndDate">
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Book Item</button>
</form>

                           
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                            <script>
document.addEventListener('DOMContentLoaded', function () {
    const selectedDateInput = document.getElementById('selectedDate');
    const bookingStartDate = document.getElementById('bookingStartDate');
    const bookingEndDate = document.getElementById('bookingEndDate');

    selectedDateInput.addEventListener('change', function () {
        const dates = selectedDateInput.value.split('-');
        bookingStartDate.value = dates[0];
        bookingEndDate.value = dates[1];
    });
    
    async function fetchUnavailableDates() {
        const response = await fetch('{{ route('api.unavailable-dates', $item->id) }}');
        const data = await response.json();
        return data.dates.map(date => new Date(date));
    }

    async function initializeDatePicker() {
        const unavailableDates = await fetchUnavailableDates();

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

    initializeDatePicker();
});
</script>



