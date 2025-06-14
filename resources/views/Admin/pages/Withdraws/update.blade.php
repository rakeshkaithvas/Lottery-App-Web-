@extends('Admin.layouts.app')

@section('content')

@section('title', 'Update Withdraw Gateways')

@include('Admin.partials.alerts.errors')

@include('Admin.partials.alerts.success')

<form action="{{ route('update.withdraw.gateway', ['id' => $gateway->id]) }}" method="post" enctype="multipart/form-data" id="gatewayForm">
    @csrf
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Details
                </div>
            </div>
            <div style="margin-left: 1rem; margin-top: 1rem; margin-right: 1rem">


                <div class="row mb-none-15 mb-3">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-15">
                        <div class="form-group mb-2">
                            <label for="name" class="required">Gateway Name <span
                                class="small text-danger">*</span></label>
                            <input type="text" class="form-control " name="name" value="{{ $gateway->name }}" required="" id="name">
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-15">
                        <div class="form-group mb-2">
                            <label for="currency" class="required">Currency <span
                                    class="small text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="currency" class="form-control border-radius-5" required=""
                                    value="{{ $gateway->currency }}" id="currency" placeholder="e.g. BDT">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-15">
                        <div class="form-group mb-2">
                            <label for="rate" class="required">Rate <span
                                    class="small text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text">1 {{ $setting->currency }} =</div>
                                <input type="number" step="any" class="form-control" name="rate" required="" value="{{ number_format($gateway->rate, 0) }}"
                                    id="rate">
                                <div class="input-group-text"><span class="currency_symbol" id="currencyData">{{ $gateway->currency }}</span></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <div class="col-xl-12">
                        <label for="input-rounded" class="form-label">Gateway Logo<span
                                class="small text-danger">*</span></label>
                        <input class="form-control mb-2" type="file" id="formFile" name="logo">
                    </div>
                    <span class="avatar avatar-l">
                        <a href="{{ asset($gateway->logo) }}" target="_blank"><img src="{{ asset($gateway->logo) }}" class="img-fluid" alt="Logo"></a>
                    </span>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 mb-3">
                        <label for="input-rounded" class="form-label">Minimum Withdraw<span class="small text-danger">*</span></label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="min" id="" required value="{{ number_format($gateway->min, 0) }}">
                            <div class="input-group-text"><span class="currency_symbol" id="currencyData2">{{ $gateway->currency }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="input-rounded" class="form-label">Maximum Withdraw<span class="small text-danger">*</span></label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="max" id="" required value="{{ number_format($gateway->max, 0) }}">
                            <div class="input-group-text"><span class="currency_symbol" id="currencyData3">{{ $gateway->currency }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="input-rounded" class="form-label">Fee (e.g 2)<span class="small text-danger">*</span></label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="fee" id="" required value="{{ number_format($gateway->fee, 0) }}">
                            <div class="input-group-text">%</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col-xl-12">
                        <label for="input-rounded" class="form-label">Withdraw Instruction</label>
                                <textarea class="form-control" name="instruction" id="" cols="30" rows="10">{{ $gateway->instruction }}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    User Data
                                </div>
                                <div class="d-flex flex-wrap">
                                     <!-- Button to trigger modal -->
                        <button type="button" class="btn btn-primary" onclick="addNewField()">
                            Add New
                        </button>
                                </div>
                            </div>
                        </div>

                        <!-- Existing user data fields -->
                        @foreach ($gateway->dynamicFields as $userData)
                        <div class="row mb-3" id="field_{{ $userData->id }}">
                            <div class="col-md-6">
                                <label for="typeSelect" class="form-label">Type</label>
                                <select class="form-select" name="user_data[{{ $userData->id }}][type]" id="typeSelect">
                                    <option value="text" {{ $userData->field_type == 'text' ? 'selected' : '' }}>Text</option>
                                    <option value="file" {{ $userData->field_type == 'file' ? 'selected' : '' }}>File</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="labelInput" class="form-label">{{ $userData->field_name }}</label>
                                <input type="text" class="form-control" name="user_data[{{ $userData->id }}][label]" id="labelInput" value="{{ $userData->field_name }}">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger" onclick="deleteField('{{ $userData->id }}')">Delete</button>
                            </div>
                        </div>
                        @endforeach

                        <!-- List to display added data -->
            <ul id="dataList" class="list-group mt-3">

                <!-- Added data will be dynamically added here -->
            </ul>
                    </div>

                </div>


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
    // Update currency data dynamically
                document.getElementById('currency').addEventListener('input', function () {
                    var currencyData = document.getElementById('currencyData');
                    var currencyData3 = document.getElementById('currencyData3');
                    var currencyData2 = document.getElementById('currencyData2');
                    if (currencyData || currencyData2 || currencyData3) {
                        currencyData.textContent = this.value;
                        currencyData2.textContent = this.value;
                        currencyData3.textContent = this.value;
                    }
                });
</script>
<script>
    function deleteField(fieldId) {
        // Find the dynamic field element by its ID and remove it from the DOM
        var fieldElement = document.getElementById('field_' + fieldId);
        if (fieldElement) {
            fieldElement.remove();
        }
    }
</script>


<script>
    function addNewField() {
        var dataList = document.getElementById('dataList');

        // Create new user data field HTML elements
        var newRow = document.createElement('div');
        newRow.className = 'row mb-3';
        newRow.id = 'newField_' + Date.now(); // Unique ID for the new field

        var colType = document.createElement('div');
        colType.className = 'col-md-6';
        var typeLabel = document.createElement('label');
        typeLabel.setAttribute('for', 'typeSelect');
        typeLabel.className = 'form-label';
        typeLabel.innerText = 'Type';
        var typeSelect = document.createElement('select');
        typeSelect.className = 'form-select';
        typeSelect.name = 'new_data[' + newRow.id + '][type]'; // Adjusted name attribute for type
        typeSelect.id = 'typeSelect';
        var optionText = ['Text', 'File'];
        var optionValue = ['text', 'file'];
        for (var i = 0; i < optionText.length; i++) {
            var option = document.createElement('option');
            option.value = optionValue[i];
            option.innerText = optionText[i];
            typeSelect.appendChild(option);
        }
        colType.appendChild(typeLabel);
        colType.appendChild(typeSelect);

        var colLabel = document.createElement('div');
        colLabel.className = 'col-md-4';
        var labelLabel = document.createElement('label');
        labelLabel.setAttribute('for', 'labelInput');
        labelLabel.className = 'form-label';
        labelLabel.innerText = 'Label Name';
        var labelInput = document.createElement('input');
        labelInput.type = 'text';
        labelInput.className = 'form-control';
        labelInput.name = 'new_data[' + newRow.id + '][label]'; // Adjusted name attribute for label
        labelInput.id = 'labelInput';
        colLabel.appendChild(labelLabel);
        colLabel.appendChild(labelInput);

        var colButton = document.createElement('div');
        colButton.className = 'col-md-2 d-flex align-items-end';
        var deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className = 'btn btn-danger';
        deleteButton.innerText = 'Delete';
        deleteButton.onclick = function() {
            newRow.remove();
        };
        colButton.appendChild(deleteButton);

        newRow.appendChild(colType);
        newRow.appendChild(colLabel);
        newRow.appendChild(colButton);

        // Append new user data field to the form
        dataList.appendChild(newRow);
    }
</script>


<script>
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
</script>


@endsection
