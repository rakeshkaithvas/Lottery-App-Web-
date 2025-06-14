@extends('Admin.layouts.app')

@section('content')

@section('title', 'Deposit Details')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

<div class="row mb-none-30 justify-content-center">
    <div class="col-xl-4 col-md-6 mb-30">
        <div class="card b-radius--10 overflow-hidden box--shadow1">
            <div class="card-body">
                <h5 class="mb-20 text-muted">Deposit Via {{ $deposit->gateway->name }}</h5>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Date <span class="fw-bold">{{ \Carbon\Carbon::parse($deposit->created_at)->format('Y-m-d h:i A')
                            }}<br></span>
                    </li>
                    {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                        Transaction Number <span class="fw-bold">{{ $deposit->trx_id }}</span>
                    </li> --}}
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        User <span class="fw-bold">
                            {{ $deposit->user->name }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Email <span class="fw-bold">
                            {{ $deposit->user->email }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Method <span class="fw-bold">{{ $deposit->gateway->name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Amount <span class="fw-bold">{{ $deposit->total_amount }} {{ $deposit->gateway->currency
                            }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Charge <span class="fw-bold">{{ $deposit->fee }} {{ $deposit->gateway->currency }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        After Charge <span class="fw-bold">{{ $deposit->total_amount - $deposit->fee }} {{
                            $deposit->gateway->currency }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Rate <span class="fw-bold">{{ $deposit->gateway->rate }} {{ $deposit->gateway->currency }} = 1
                            {{ \App\Models\GeneralSetting::first()->currency }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Gteable <span class="fw-bold">{{ $deposit->amount }} {{
                            \App\Models\GeneralSetting::first()->currency }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Status <b>{{ $deposit->status }}</b></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-md-6 mb-30">
        <div class="card b-radius--10 overflow-hidden box--shadow1">
            <div class="card-body">
                <h5 class="card-title mb-50 border-bottom pb-2">User Deposit Information</h5>
                <div class="row mt-4">
                    @if($deposit->gateway->type == 'auto')

                        <div class="col-md-12">
                            <h6>Transaction ID</h6>
                            <p>{{ $deposit->trx_id }}</p>
                        </div>
                    @endif
                    @foreach($deposit->fields as $field)
                    <div class="col-md-12">
                        <h6>{{ $field->field_name }}</h6>
                        @php
                        // Get the file extension
                        $extension = pathinfo($field->field_value, PATHINFO_EXTENSION);
                        @endphp
                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'webp', 'ico', 'mp3', 'mp4']))
                        <!-- If the file extension is an image, display it as an image -->
                        <a href="{{ asset($field->field_value) }}" target="_blank"><button
                                class="btn btn-teal-light btn-border-down">View Attachment</button></a>
                        @else
                        <!-- If the file extension is not an image, display the field value as plain text -->
                        <p>{{ $field->field_value }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>

                @switch($deposit->status)
                @case('pending')
                <div class="row mt-4">
                    <div class="col-md-12">


                        <button type="button" style="padding: 0; border: none; background: none;" data-bs-toggle="modal"
                            data-bs-target="#activeModel_{{ $deposit->id }}"><a href="javascript:void(0);"
                                class="btn btn-success label-btn label-end" data-bs-toggle="tooltip"
                                title="Approve Deposit" data-bs-custom-class="tooltip-primary">Approve<i
                                    class="ri-check-line label-btn-icon ms-2"></i></a></button>


                        @include('Admin/partials/dialogues/active', [
                        'id' => $deposit->id,
                        'title' => 'Approve Deposit',
                        'action' => route('approve.deposit', $deposit->id),
                        ])

                        <button type="button" style="padding: 0; border: none; background: none;" data-bs-toggle="modal"
                            data-bs-target="#blockModel_{{ $deposit->id }}"><a href="javascript:void(0);"
                                class="btn btn-danger label-btn label-end" data-bs-toggle="tooltip"
                                title="Approve Deposit" data-bs-custom-class="tooltip-primary">Reject<i
                                    class="ri-close-line label-btn-icon ms-2"></i></a></button>

                        @include('Admin/partials/dialogues/block', [
                        'id' => $deposit->id,
                        'title' => 'Block Deposit',
                        'action' => route('reject.deposit', $deposit->id),
                        ])

                    </div>
                </div>
                @break
                @case('rejected')
                <button class="btn btn-sm btn-danger-light mt-2">Rejected</button>
                @break
                @case('completed')
                <button class="btn btn-sm btn-primary-light mt-2">Completed</button>
                @break
                @default

                @endswitch
            </div>
        </div>
    </div>
</div>


@endsection
