<!-- resources/views/components/modal.blade.php -->
<div class="modal fade" id="modalDetails{{ $items->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailsLabel{{ $items->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        @foreach ($item_groups as $item)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold mb-2">{{ $item->name }}</h3>
                                @include('components.modalDetails', ['item_groups' => $items])
                            </form>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
</div>