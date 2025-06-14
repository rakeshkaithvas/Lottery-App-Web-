{{-- Edit Dialouge --}}
<div class="modal fade" id="editModel_{{ $sticker->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ $title }}? #{{ $sticker->id }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ $action }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Price:</label>
                        <input type="number" class="form-control" id="recipient-name" placeholder="Enter price"
                            name="price" required value="{{ $sticker->price }}">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
