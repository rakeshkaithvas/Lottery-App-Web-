@extends('Admin.layouts.app')

@section('content')

@section('title', 'SMTP Config')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')


<form action="{{ route('update.smtp') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Details
                </div>

            </div>
            <p style="margin-left: 1rem; color: red" class="mt-2">Please relode one more time after save your config</p>
            <div style="margin-left: 1rem; margin-top: 1rem; margin-right: 1rem">

                <div class="row">
                    <div class="col-xl-4 mb-3">
                        <label for="host" class="form-label">HOST<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" id="host" name="host" value="{{ config('mail.mailers.smtp.host') }}" required placeholder="">
                    </div>

                    <div class="col-xl-4 mb-3">
                        <label for="port" class="form-label">PORT<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" id="port" name="port" value="{{ config('mail.mailers.smtp.port') }}" required placeholder="">
                    </div>

                    <div class="col-xl-4 mb-3">
                        <label for="username" class="form-label">Username<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" id="username" name="username" value="{{ config('mail.mailers.smtp.username') }}" required placeholder="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 mb-3">
                        <label for="password" class="form-label">Password<span class="small text-danger">*</span></label>
                        <input class="form-control" type="password" id="password" name="password" value="{{ config('mail.mailers.smtp.password') }}" required placeholder="">
                    </div>

                    <div class="col-xl-4 mb-3">
                        <label for="encryption" class="form-label">Encryption<span class="small text-danger">*</span></label>
                        <input class="form-control" type="text" id="encryption" name="encryption" value="{{ config('mail.mailers.smtp.encryption') }}" required placeholder="">
                    </div>

                    <!-- Add more rows for other SMTP configuration parameters -->
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
