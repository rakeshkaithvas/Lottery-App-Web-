@extends('Admin.layouts.app')

@section('content')

@section('title', 'Profile Update')

@include('Admin.partials.alerts.errors')

@include('Admin.partials.alerts.success')

<form action="{{ route('admin.email.update') }}" method="post" enctype="multipart/form-data" id="gatewayForm">
    @csrf
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Update Email
                </div>
            </div>
            <div style="margin-left: 1rem; margin-top: 1rem; margin-right: 1rem">


                <div class="row mb-none-15 mb-3">
                    <div class="form-group mb-2">
                        <label for="name" class="required">Admin Email</label>
                        <input type="text" class="form-control " name="email" value="{{ $admin->email }}" required=""
                            id="email">
                    </div>
                    <div>
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

<form action="{{ route('admin.password.update') }}" method="post" enctype="multipart/form-data" id="gatewayForm">
    @csrf
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Update Password
                </div>
            </div>
            <div style="margin-left: 1rem; margin-top: 1rem; margin-right: 1rem">


                <div class="row mb-none-15 mb-3">
                    <div class="form-group mb-2">
                        <label for="name" class="required">Current Password</label>
                        <input type="password" class="form-control " name="password" required="">
                    </div>
                    <div>
                    </div>
                </div>
                <div class="row mb-none-15 mb-3">
                    <div class="form-group mb-2">
                        <label for="name" class="required">New Password</label>
                        <input type="password" class="form-control " name="new_password" required="">
                    </div>
                    <div>
                    </div>
                </div>
                <div class="row mb-none-15 mb-3">
                    <div class="form-group mb-2">
                        <label for="name" class="required">Confirm Password</label>
                        <input type="password" class="form-control " name="confirm_password" required="">
                    </div>
                    <div>
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
