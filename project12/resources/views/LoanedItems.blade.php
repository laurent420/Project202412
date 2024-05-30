@if (auth()->check() && auth()->user()->isAdmin())
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Loaned Items') }}
            </h2>
        </x-slot>   

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if($loanedItems->isEmpty())
                            <p>No items are currently loaned.</p>
                        @else
                            <table class="min-w-full bg-white dark:bg-gray-800">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Item Name</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Start Date</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($loanedItems as $loanedItem)
                                        <tr>
                                            <td class="px-6 py-4 border-b border-gray-300 text-gray-800 dark:text-gray-100">{{ $loanedItem->item->name }}</td>
                                            <td class="px-6 py-4 border-b border-gray-300 text-gray-800 dark:text-gray-100">{{ $loanedItem->start_date }}</td>
                                            <td class="px-6 py-4 border-b border-gray-300 text-gray-800 dark:text-gray-100">{{ $loanedItem->end_date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Loaned Items') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if($loanedItems->isEmpty())
                            <p>No items are currently loaned.</p>
                        @else
                            <table class="min-w-full bg-white dark:bg-gray-800">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Item Name</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Start Date</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($loanedItems as $loanedItem)
                                        <tr>
                                            <td class="px-6 py-4 border-b border-gray-300 text-gray-800 dark:text-gray-100">{{ $loanedItem->item->name }}</td>
                                            <td class="px-6 py-4 border-b border-gray-300 text-gray-800 dark:text-gray-100">{{ $loanedItem->start_date }}</td>
                                            <td class="px-6 py-4 border-b border-gray-300 text-gray-800 dark:text-gray-100">{{ $loanedItem->end_date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif

