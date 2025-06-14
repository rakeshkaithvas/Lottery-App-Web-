@extends('Admin.layouts.app')

@section('content')

@section('title', 'General Setting')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')


<form action="{{ route('update.general.setting') }}" method="post" enctype="multipart/form-data">
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
                        <label for="currency" class="form-label">Site Title<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" id="currency" name="title" value="{{ config('app.name') }}" required placeholder="Site title">
                    </div>

                    <div class="col-xl-4 mb-3">
                        <label for="currency" class="form-label">Support Email<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" id="currency" name="email" value="{{ config('app.support_email') }}" required placeholder="Site title">
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label for="currency" class="form-label">Support Phone<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" id="currency" name="phone" value="{{ config('app.support_phone') }}" required placeholder="Site title">
                    </div>
                </div>

                <div class="row mb-3">

                    <div class="col-xl-6">
                        <label for="input-rounded" class="form-label">User Registration<span
                                class="small text-danger">*</span></label>
                        <select class="form-control" id="lottery" name="user_registration">
                            <option value='1' {{ $setting->user_registration ? 'selected' : '' }}>Enabled</option>
                            <option value='0' {{ !$setting->user_registration ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>

                <div class="col-xl-6">
                    <label for="input-rounded" class="form-label">Email Verification<span
                            class="small text-danger">*</span></label>
                    <select class="form-control" id="lottery" name="email_verification">
                        <option value='1' {{ $setting->email_verification ? 'selected' : '' }}>Enabled</option>
                        <option value='0' {{ !$setting->email_verification ? 'selected' : '' }}>Disabled</option>
                    </select>
                </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 mb-3">
                        <label for="currency" class="form-label">Currency<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" id="currency" name="currency" value="{{ $setting->currency }}" required placeholder="USD">
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="currency_symbol" class="form-label">Currency Symbol<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" id="currency_symbol" name="currency_symbol" value="{{ $setting->currency_symbol }}" required placeholder="$">
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
