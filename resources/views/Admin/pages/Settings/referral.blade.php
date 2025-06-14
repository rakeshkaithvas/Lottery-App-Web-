@extends('Admin.layouts.app')

@section('content')

@section('title', 'Referral Setting')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')


<form action="{{ route('update.refer.setting') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Details
                </div>
            </div>
            <div style="margin-left: 1rem; margin-top: 1rem; margin-right: 1rem">

                <div class="row mb-3">

                    <div class="col-xl-6">
                        <label for="input-rounded" class="form-label">Register Bonus<span
                                class="small text-danger">*</span></label>
                        <select class="form-control" id="lottery" name="joining_bonus">
                            <option value='1' {{ $setting->joining_bonus ? 'selected' : '' }}>Enabled</option>
                            <option value='0' {{ !$setting->joining_bonus ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="joining_bonus_amount" class="form-label">Register Bonus Amount<span class="small text-danger">*</span></label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="joining_bonus_amount" id="" required value="{{ $setting->joining_bonus_amount }}" placeholder="Enter amount">
                            <div class="input-group-text">{{ $info->currency }}</div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <label for="input-rounded" class="form-label">Deposit Bonus<span
                                class="small text-danger">*</span></label>
                        <select class="form-control" id="lottery" name="deposit_bonus">
                            <option value='1' {{ $setting->deposit_bonus ? 'selected' : '' }}>Enabled</option>
                            <option value='0' {{ !$setting->deposit_bonus ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>

                    <div class="col-xl-6 mb-3">
                        <label for="deposit_percentage" class="form-label">Deposit Percentage<span class="small text-danger">*</span></label>
                        <div class="input-group">
                            <input class="form-control" type="number" name="deposit_percentage" id="" required value="{{ $setting->deposit_percentage }}" placeholder="e.g 5">
                            <div class="input-group-text">%</div>
                        </div>
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
