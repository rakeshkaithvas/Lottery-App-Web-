@extends('Admin.layouts.app')

@section('content')

@section('title', 'Maintenance Setting')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')


<form action="{{ route('update.maintenance.setting') }}" method="post" enctype="multipart/form-data">
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
                        <label for="input-rounded" class="form-label">Maintenance Mode<span
                                class="small text-danger">*</span></label>
                        <select class="form-control" id="lottery" name="maintenance_mode">
                            <option value='1' {{ $setting->maintenance_mode ? 'selected' : '' }}>Enabled</option>
                            <option value='0' {{ !$setting->maintenance_mode ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col-xl-12">
                        <label for="input-rounded" class="form-label">Maintenance Message<span
                                class="small text-danger">*</span></label>
                        <textarea name="maintenance_message" id="" cols="30" rows="10" class="form-control">{{ $setting->maintenance_message }}</textarea>
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
