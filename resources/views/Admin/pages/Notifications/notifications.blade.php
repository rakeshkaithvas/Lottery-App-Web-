@extends('Admin.layouts.app')
@section('content')
@section('title', 'Push Notification')
@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

<div class="row mb-5">
    <div class="col-xl-12">

        <div class="card custom-card">
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="personal-info" role="tabpanel">
                        <div class="p-sm-3 p-0">
                            <div class="row gy-4 mb-4">
                                <form action="{{ route('trigger.notification') }}" method="POST">
                                    @csrf
                                    <div class="col-xl-12">
                                        <label for="title" class="form-label">Title :</label>
                                        <input type="text" class="form-control" id="title"
                                            placeholder="Message Title" name="title" required><br>
                                        <label for="bio" class="form-label">Body :</label>
                                        <textarea class="form-control" id="message" placeholder="Message Body" rows="5" name="body" required></textarea>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="float-end">
                    <button type="submit" class="btn btn-primary m-1">
                        Send Notification
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>
@endsection
