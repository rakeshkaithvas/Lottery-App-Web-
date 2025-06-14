@extends('Admin.layouts.app')

@section('content')

@section('title', 'Add Withdraw Gateways')

@include('Admin.partials.alerts.errors')

@include('Admin.partials.alerts.success')

<form action="{{ route('add.withdraw.gateway') }}" method="post" enctype="multipart/form-data" id="gatewayForm">
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
                            <input type="text" class="form-control " name="name" value="" required="" id="name">
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-15">
                        <div class="form-group mb-2">
                            <label for="currency" class="required">Currency <span
                                    class="small text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="currency" class="form-control border-radius-5" required=""
                                    value="" id="currency" placeholder="e.g. BDT">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-15">
                        <div class="form-group mb-2">
                            <label for="rate" class="required">Rate <span class="small text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text">1 {{ $setting->currency }} =</div>
                                <input type="number" step="any" class="form-control" name="rate" required="" value=""
                                    id="rate">
                                <div class="input-group-text"><span class="currency_symbol" id="currencyData"></span>
                                </div>
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
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 mb-3">
                        <label for="input-rounded" class="form-label">Minimum Withdraw<span
                                class="small text-danger">*</span></label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="min" id="" required>
                            <div class="input-group-text"><span class="currency_symbol" id="currencyData2"></span></div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="input-rounded" class="form-label">Maximum Withdraw<span
                                class="small text-danger">*</span></label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="max" id="" required>
                            <div class="input-group-text"><span class="currency_symbol" id="currencyData3"></span></div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="input-rounded" class="form-label">Fee (e.g 2)<span
                                class="small text-danger">*</span></label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="fee" id="" required>
                            <div class="input-group-text">%</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col-xl-12">
                        <label for="input-rounded" class="form-label">Withdraw Instruction</label>
                        <textarea class="form-control" name="instruction" id="" cols="30" rows="10"></textarea>
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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Add New
                                    </button>
                                </div>
                            </div>
                        </div>
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




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to add new data -->
                <form id="addDataForm">
                    <div class="mb-3">
                        <label for="typeSelect" class="form-label">Type</label>
                        <select class="form-select" id="typeSelect">
                            <option value="text">Text</option>
                            <option value="file">File</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="labelInput" class="form-label">Label Name</label>
                        <input type="text" class="form-control" id="labelInput">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addData()">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



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
    function addData() {
        // Get form values
        var type = document.getElementById('typeSelect').value;
        var label = document.getElementById('labelInput').value;

        // Check if label is empty
        if (label === '') {
            // Show error message or prevent adding data
            alert('Label name cannot be empty');
            return;
        }

        // Create list item
        var listItem = document.createElement('li');
        listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
        listItem.innerHTML = `Type: ${type.toUpperCase()} | Label: ${label}`;

        // Create remove button
        var removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn btn-danger';
        removeBtn.innerHTML = 'Remove';
        removeBtn.onclick = function() {
            listItem.remove();
        };

        listItem.appendChild(removeBtn);

        // Add list item to the list
        document.getElementById('dataList').appendChild(listItem);

        // Create hidden input fields for user data and append them to the form
        var form = document.getElementById('gatewayForm');

        // Create an object to hold the user data
        var userData = {
            type: type,
            label: label
        };

        // Create a hidden input field for the user data
        var hiddenUserDataInput = document.createElement('input');
        hiddenUserDataInput.type = 'hidden';
        hiddenUserDataInput.name = 'user_data[]';
        hiddenUserDataInput.value = JSON.stringify(userData);
        form.appendChild(hiddenUserDataInput);

        // Clear form fields
        document.getElementById('addDataForm').reset();

        // Close modal
        var modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
        modal.hide();
    }
</script>

<script>
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
</script>


@endsection
