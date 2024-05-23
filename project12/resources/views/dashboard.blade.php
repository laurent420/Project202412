@if (auth()->user()->is_banned == 1)
    <h1>You are banned</h1>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Add Item') }}
            </h2>
        </x-slot>

        <div class="container mx-auto py-8">
            <div class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Add Item</h2>

                    <!-- Add Item Form -->
                    <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Item Name Input -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item Name</label>
                            <input type="text" id="name" name="name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
        </div>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const items = @json($items); // Assuming you have a list of items available
                items.forEach(item => {
                    const selectedDateInput = document.getElementById('selectedDate-' + item.id);
                    const bookingStartDate = document.getElementById('bookingStartDate-' + item.id);
                    const bookingEndDate = document.getElementById('bookingEndDate-' + item.id);

                    selectedDateInput.addEventListener('change', function () {
                        const dates = selectedDateInput.value.split('-');
                        bookingStartDate.value = dates[0];
                        bookingEndDate.value = dates[1];
                    });

                    async function fetchUnavailableDates() {
                        const response = await fetch('{{ route('api.unavailable-dates', '') }}/' + item.id);
                        const data = await response.json();
                        return data.dates.map(date => new Date(date));
                    }

                    async function initializeDatePicker(itemId) {
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
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const year = date.getFullYear();
                        return `${day}/${month}/${year}`;
                    }

                    initializeDatePicker(item.id);
                });
            });
        </script>
    </x-app-layout>
@endif
