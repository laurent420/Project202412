@if ( auth()->user()->is_banned  == 1)
    <h1>You are banned</h1>    

@else 
    <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Favorites') }}
                </h2>
            </x-slot>

            <div class="container mx-auto">
                <h2 class="text-2xl font-semibold mb-4">Favorite Items</h2>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($favorites as $favorite)
                    @if ($favorite->item)
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">{{ $favorite->item->name }}</h3>
                            <!-- Display other item details -->
                        </div>
                    @endif
                 @endforeach
@endif