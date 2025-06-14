@extends('Admin.layouts.app')

@section('content')

@section('title', 'Add Contest')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

<form action="{{ route('lottery.add') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Details
                </div>
            </div>
            <div style="margin-left: 1rem; margin-top: 1rem; margin-right: 1rem">

                <div class="row">
                    <div class="col-xl-4 mb-3">
                        <label for="input-rounded" class="form-label">Contest Name<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" placeholder="Enter Contest name" required>
                    </div>

                    <!-- New Image Upload Field -->
                    <div class="col-xl-4 mb-3">
                        <label for="lottery_image" class="form-label">Contest Image <span class="small text-danger">*</span></label>
                        <input class="form-control" type="file" name="lottery_image" id="lottery_image" accept="image/*" required>
                    </div>

                    <div class="col-xl-4 mb-3">
                        <label for="input-rounded" class="form-label">Contest Price<span class="small text-danger">*</span></label>
                        <input class="form-control" type="number" name="price" placeholder="Enter contest price" required>
                    </div>

                    <div class="col-xl-4 mb-3">
                        <label for="input-rounded" class="form-label">Total Ticket<span class="small text-danger">*</span></label>
                        <input class="form-control" type="number" name="total_ticket" placeholder="Total ticket quantity" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 mb-3">
                        <label for="input-rounded" class="form-label">Start Date<span class="small text-danger">*</span></label>
                        <input class="form-control" type="date" name="start_date" placeholder="Start Date" required>
                    </div>

                    <div class="col-xl-4 mb-3">
                        <label for="input-rounded" class="form-label">Draw Date<span class="small text-danger">*</span></label>
                        <input class="form-control" type="date" name="draw_date" placeholder="Draw Date" required>
                    </div>

                    <div class="col-xl-4 mb-3">
                        <label for="input-rounded" class="form-label">Draw Type<span class="small text-danger">*</span></label>
                        <select class="form-control" id="category" name="type">
                            <option value="auto">Auto Draw</option>
                            <option value="manual">Manual Draw</option>
                        </select>
                    </div>
                </div>
            <div class="mb-3">
                <div class="col-xl-12">
                    <label for="input-rounded" class="form-label">Total Winners<span class="small text-danger">*</span></label>
                    <input class="form-control total-winners-input" type="text" name="total_winner" id="total_winner" placeholder="How many prizes?" required>
                    <br>
                    <button type="button" class="btn btn-primary" id="generate-winners-btn">Generate Winners</button>
                </div>
            </div>
            <!-- Winner bonus amount fields will be generated dynamically based on total winners -->
                <div id="winner-bonus-fields"></div>
            </div>
            <div class="card-header">
                <div class="">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function generateWinnerBonusFields(totalWinners) {
        const winnerBonusFields = document.getElementById('winner-bonus-fields');
        winnerBonusFields.innerHTML = ''; // Clear old fields

        for (let i = 1; i <= totalWinners; i++) {
            const divWrapper = document.createElement('div');
            divWrapper.className = 'mb-3 winner-bonus-group';

            const inputField = document.createElement('input');
            inputField.className = 'form-control winner-bonus-input';
            inputField.type = 'text';
            inputField.name = 'winner_bonuses[]';
            inputField.placeholder = 'Enter winner ' + i + ' bonus amount';
            inputField.required = true;

            // Container for image upload field
            const imageContainer = document.createElement('div');
            imageContainer.className = 'image-upload mt-2';

            divWrapper.appendChild(inputField);
            divWrapper.appendChild(imageContainer);

            winnerBonusFields.appendChild(divWrapper);
        }

        // Attach input listener after creation
        attachBonusFieldListeners();
    }

    function attachBonusFieldListeners() {
        const inputs = document.querySelectorAll('.winner-bonus-input');
        inputs.forEach(function(input) {
            input.addEventListener('input', function () {
                const wrapper = this.parentElement;
                const imageContainer = wrapper.querySelector('.image-upload');

                const value = this.value.trim();

                if (value === '' || !isNaN(value)) {
                    // Valid number or empty → remove image input if it exists
                    imageContainer.innerHTML = '';
                } else {
                    // Non-numeric text → add image input if not already added
                    if (!imageContainer.querySelector('input[type="file"]')) {
                        const imageInput = document.createElement('input');
                        imageInput.type = 'file';
                        imageInput.name = 'winner_bonus_images[]';
                        imageInput.className = 'form-control mt-2';
                        imageInput.required = true;
                        imageContainer.appendChild(imageInput);
                    }
                }
            });
        });
    }

    document.getElementById('generate-winners-btn').addEventListener('click', function () {
        const totalWinners = parseInt(document.getElementById('total_winner').value);
        if (totalWinners > 0) {
            generateWinnerBonusFields(totalWinners);
        }
    });
</script>


@endsection
