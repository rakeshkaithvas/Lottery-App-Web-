{{-- Block Dialouge --}}
<div class="modal fade" id="deleteModel_{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel_{{ $id }}">
                    {{ $title }}? #{{ $id }}
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Do you really want to execute?</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="{{ $action }}"><button type="submit" class="btn btn-primary"
                        id="confirmBlockUser">Continue</button></a>
            </div>
        </div>
    </div>
</div>
