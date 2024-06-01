<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Loaned Items') }}
        </h2>
    </x-slot>   

    <div class="py-12" style="background-color: #f7f7f7; padding: 20px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="background-color: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <div class="p-6 text-gray-900 dark:text-gray-100" style="padding: 24px;">
                    @if($loanedItems->isEmpty())
                        <p style="color: #6b7280; font-size: 1rem;">No items are currently loaned.</p>
                    @else
                        <table class="min-w-full bg-white dark:bg-gray-800" style="width: 100%; background-color: white; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider" style="padding: 16px; border-bottom: 2px solid #d1d5db; text-align: left; color: #374151;">Item Name</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider" style="padding: 16px; border-bottom: 2px solid #d1d5db; text-align: left; color: #374151;">Start Date</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider" style="padding: 16px; border-bottom: 2px solid #d1d5db; text-align: left; color: #374151;">End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loanedItems as $loanedItem)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-300 text-gray-800 dark:text-gray-100" style="padding: 16px; border-bottom: 1px solid #d1d5db; color: #1f2937;">{{ $loanedItem->item->name }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300 text-gray-800 dark:text-gray-100" style="padding: 16px; border-bottom: 1px solid #d1d5db; color: #1f2937;">{{ $loanedItem->start_date }}</td>
                                        <td class="px-6 py-4 border-b border-gray-300 text-gray-800 dark:text-gray-100" style="padding: 16px; border-bottom: 1px solid #d1d5db; color: #1f2937;">{{ $loanedItem->end_date }}</td>
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
