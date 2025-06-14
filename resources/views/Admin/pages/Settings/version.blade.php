@extends('Admin.layouts.app')

@section('content')

@section('title', 'App Version Setting')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')


<form action="{{ route('update.version') }}" method="post" enctype="multipart/form-data">
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
                    <div class="col-xl-6 mb-3">
                        <label for="currency" class="form-label">Android App Version<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" id="currency" name="android_app_version" value="{{ $data->android_app_version }}" required placeholder="1.0.0">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="currency_symbol" class="form-label">Android App Link<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" id="currency_symbol" name="android_app_link" value="{{ $data->android_app_link }}" required placeholder="https://play.google.com">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 mb-3">
                        <label for="currency" class="form-label">iOS App Version<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" id="currency" name="ios_app_version" value="{{ $data->ios_app_version }}" required placeholder="1.0.0">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="currency_symbol" class="form-label">iOS App Link<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" id="currency_symbol" name="ios_app_link" value="{{ $data->ios_app_link }}" required placeholder="https://apps.apple.com">
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

    </div>

</form>

@endsection
