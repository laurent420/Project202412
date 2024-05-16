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
                        <h3 class="text-lg font-semibold mb-2 ">{{ $favorite->item->name }}</h3>
                        <div class="w-full flex-none text-sm font-medium text-slate-700 mt-2">
                            amount left:  
                        </div>
                        <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mb-2 float-right">Unfavourite</button>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-2 float-right">Add to Bag</button>
                        <!-- Display other item details -->
                    </div>

                </div>     
         
            </div>
        </div>
        @endif
        @endforeach
    </div>
</x-app-layout>
