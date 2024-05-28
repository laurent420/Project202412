<!-- resources/views/components/modal.blade.php -->
<div class="modal fade" id="banUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="banUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('users.ban', $user->id) }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title" id="banUserModalLabel{{ $user->id }}">Ban User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="banReason">Reason for Ban:</label>
                        <input type="text" class="form-control" id="banReason" name="ban_reason" required>
                    </div>
                    <!-- Include any other fields you need for the ban -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Ban</button>
                </div>
            </form>
        </div>
    </div>
</div>
