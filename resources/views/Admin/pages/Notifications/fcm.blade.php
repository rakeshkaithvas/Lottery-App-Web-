@extends('Admin.layouts.app')

@section('content')

@section('title', 'Firebase Config')

@include('Admin.partials.alerts.errors')

@include('Admin.partials.alerts.success')

<form action="{{ route('fcm.update') }}" method="post" enctype="multipart/form-data" id="gatewayForm">
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
                    <div class="form-group mb-2">
                        <label for="name" class="required">Server key</label>
                        <input type="text" class="form-control " name="fcm" value="{{ $firebase->server_key }}" required="" id="fcm">
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

