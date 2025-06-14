@extends('Admin.layouts.app')

@section('content')

@section('title', 'Update Contest')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

<form action="{{ route('lottery.update', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Details
                </div>
            </div>
            <div style="margin-left: 1rem; margin-top: 1rem; margin-right: 1rem">
                <div class="mb-3">
                    <div class="col-xl-12">
                        <label for="input-rounded" class="form-label">Contest Name<span
                                class="small text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" placeholder="Enter Contest name"
                        value="{{ $data->name }}"
                            required>
                    </div>
                </div>

                <div class="col-xl-4 mb-3">
                    <label for="lottery_image" class="form-label">Contest Image</label>
                    <input type="file" class="form-control" name="lottery_image" accept="image/*">
                    
                    @if (!empty($data->lottery_image))
                        <div class="mt-2">
                            <img src="{{ asset($data->lottery_image) }}" alt="Contest Image" style="height: 100px;">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <div class="col-xl-12">
                        <label for="input-rounded" class="form-label">Contest Price<span
                                class="small text-danger">*</span></label>
                        <input class="form-control" type="number" name="price" placeholder="Enter Contest price"
                        value="{{ $data->price }}"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col-xl-12">
                        <label for="input-rounded" class="form-label">Total Ticket<span
                                class="small text-danger">*</span></label>
                        <input class="form-control" type="number" name="total_ticket" placeholder="Total ticket quantity"
                        value="{{ $data->total_ticket }}"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col-xl-12">
                        <label for="input-rounded" class="form-label">Start Date<span
                                class="small text-danger">*</span></label>
                        <input class="form-control" type="date" name="start_date" placeholder="Total ticket quantity"
                            required value="{{ date('Y-m-d', strtotime($data->start_date)) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col-xl-12">
                        <label for="input-rounded" class="form-label">Draw Date<span
                                class="small text-danger">*</span></label>
                        <input class="form-control" type="date" name="draw_date" placeholder="Total ticket quantity"
                            required value="{{ date('Y-m-d', strtotime($data->draw_date)) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col-xl-12">
                        <label for="input-rounded" class="form-label">Draw Type<span
                                class="small text-danger">*</span></label>
                                <select class="form-control" id="category" name="type">
                                    <option value="auto" {{ $data->type == 'auto' ? 'selected' : '' }}>Auto Draw
                                    </option>
                                    <option value="manual" {{ $data->type == 'manual' ? 'selected' : '' }}>
                                        Manual Draw
                                    </option>
                                </select>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col-xl-12">
                        <label for="total_winner" class="form-label">Total Winners <span class="small text-danger">*</span></label>
                        <input class="form-control total-winners-input" type="number" name="total_winner" id="total_winner"
                            placeholder="How many prizes?" value="{{ $data->total_winner }}" required>
                        <br>

                        @foreach (json_decode($data->winner_bonuses) as $index => $winner)
                            <div class="mb-3 winner-bonus-group">
                                <input type="text" name="winner_bonuses[]" class="form-control winner-bonus-input"
                                    placeholder="Enter winner {{ $index + 1 }} bonus amount"
                                    value="{{ $winner->bonus }}" required>

                                <div class="image-upload mt-2">
                                    @if (!empty($winner->image))
                                        <img src="{{ asset($winner->image) }}" alt="Winner {{ $index + 1 }} Image"
                                            style="height: 80px; border: 1px solid #ccc; padding: 5px;">
                                    @endif
                                    <input type="file" name="winner_bonus_images[]" class="form-control mt-2">
                                </div>
                            </div>
                        @endforeach

                        <br>
                        <button type="button" class="btn btn-primary" id="generate-winners-btn">Generate Winners</button>
                    </div>
                </div>

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

<!-- Include this JS below your form -->
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

            const imageContainer = document.createElement('div');
            imageContainer.className = 'image-upload mt-2';

            divWrapper.appendChild(inputField);
            divWrapper.appendChild(imageContainer);

            winnerBonusFields.appendChild(divWrapper);
        }

        attachBonusFieldListeners();
    }

    function attachBonusFieldListeners() {
        const inputs = document.querySelectorAll('.winner-bonus-input');
        inputs.forEach(function (input) {
            input.addEventListener('input', function () {
                const wrapper = this.parentElement;
                const imageContainer = wrapper.querySelector('.image-upload');
                const value = this.value.trim();

                if (value === '' || !isNaN(value)) {
                    imageContainer.innerHTML = '';
                } else {
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
