{{-- Block Dialouge --}}
<div class="modal fade" id="blockModel_{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="blockModel_{{ $id }}">
                    {{ $title }}? #{{ $id }}
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ $action }}" method="POST">
                    @csrf
                    @if(!isset($hideForm))
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Reason:</label>
                        <textarea class="form-control" id="message-text" placeholder="Enter Reason" name="reason" required></textarea>
                    </div>

                    @else
                    Do you really want to execute?
                    @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="confirmBlockUser">@if (isset($hideForm))
                    Inactive
                    @else
                    Block
                @endif</button>
                </form>
            </div>
        </div>
    </div>
</div>
