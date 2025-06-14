{{-- Notification Dialouge --}}
<div class="modal fade" id="notificationModel_{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Send Notification To
                    {{ $user->first_name . ' ' . $user->last_name }}
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('sent.push', ['id' => $user->id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text" placeholder="Message" name="body" required></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send
                    message</button>
            </div>
            </form>
        </div>
    </div>
</div>
