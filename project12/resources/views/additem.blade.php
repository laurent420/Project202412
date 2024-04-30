<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <h2 class="text-2xl font-semibold mb-4">Add Item</h2>

        <!-- Add Item Form -->
        <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="picture" class="form-label">Item Picture</label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>

            <button type="submit" class="btn btn-primary">Add Item</button>
        </form>
    </div>
</x-app-layout>
