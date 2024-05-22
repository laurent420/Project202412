@if (auth()->user()->is_banned == 1)
    <h1>You are banned</h1>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="container mx-auto">
            <h2 class="text-2xl font-semibold mb-4">Items</h2>

            @if (auth()->check() && auth()->user()->isAdmin())
                <div class="mb-4">
                    <a href="{{ route('additem') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add
                        Item</a>
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
                                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2 add-to-cart"
                                    data-item-id="{{ $item->id }}" data-url="{{ route('cart-items.store') }}">Add to
                                    Bag</button>
                                <button
                                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2 add-to-favorite"
                                    data-item-id="{{ $item->id }}" data-url="{{ route('favourites.add') }}"
                                    onclick="addToFavorite({{ $item->id }})">Add to Favorite</button>

                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

                                <button id="openCalendarBtn">Selecteer datum</button>
                                <input type="text" id="selectedDate" name="selected_date">

                                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const selectedDateInput = document.getElementById('selectedDate');

                                        flatpickr(selectedDateInput, {
                                            dateFormat: "d/m/Y",
                                            enableTime: false,
                                            disable: [
                                                function (date) {
                                                    return (date.getDay() !== 1);
                                                }
                                            ],
                                            onClose: function (selectedDates, dateStr, instance) {
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

                                        function formatDate(date) {
                                            const day = date.getDate();
                                            const month = date.getMonth() + 1;
                                            const year = date.getFullYear();
                                            return `${day}/${month}/${year}`;
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-app-layout>
@endif