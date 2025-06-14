@extends('Admin.layouts.app')

@section('content')

@section('title', 'Add Slider')

@include('Admin.partials.alerts.errors')

@include('Admin.partials.alerts.success')

<form action="{{ route('add.slider') }}" method="post" enctype="multipart/form-data" id="gatewayForm">
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
                        <label for="input-rounded" class="form-label">Slider Image<span
                                class="small text-danger">*</span></label>
                        <input class="form-control mb-2" type="file" id="formFile" name="image">
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

@endsection
