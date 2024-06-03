<div class="modal fade" id="detailModal{{ $group->id }}" tabindex="-1" role="dialog"
    aria-labelledby="detailModalLabel{{ $group->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">{{ $group->id }}-{{ $group->brand }}-{{ $group->name }} Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    @foreach ($group->items as $item)
                        <li>{{ $item->name }} -
                            {{ $item->serialnumber }} -
                            @if ($item->status == 0)
                                Available
                            @else
                                Not Available
                            @endif
                            <form method="POST" action="{{ route('dashboard.remove', ['id' => $item->id]) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-footer">
                                    <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                                </div>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
