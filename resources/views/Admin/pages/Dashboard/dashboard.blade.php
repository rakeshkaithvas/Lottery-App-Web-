@extends('Admin/layouts/app')

@section('title', 'Dashboard')

@section('content')


    {{-- Users --}}
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Total Users</span>
                            </div>
                            <div>
                                <span class="avatar bg-primary">
                                    <i class="bi bi-person fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $total ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Active User</span>
                            </div>
                            <div>
                                <span class="avatar bg-success">
                                    <i class="bi bi-person fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $active ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Blocked User</span>
                            </div>
                            <div>
                                <span class="avatar bg-danger">
                                    <i class="bi bi-person fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $blocked ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Email Unverified User</span>
                            </div>
                            <div>
                                <span class="avatar bg-danger">
                                    <i class="bi bi-person fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $unverified ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Deposits --}}
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Total Deposited</span>
                            </div>
                            <div>
                                <span class="avatar bg-primary">
                                    <i class="bi bi-bank fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $setting->currency_symbol }} {{ $total_deposit ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Pending Deposits</span>
                            </div>
                            <div>
                                <span class="avatar bg-success">
                                    <i class="bi bi-bank fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $pending_deposit ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Rejected Deposit</span>
                            </div>
                            <div>
                                <span class="avatar bg-danger">
                                    <i class="bi bi-bank fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $rejected_deposit ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Completed Deposit</span>
                            </div>
                            <div>
                                <span class="avatar bg-danger">
                                    <i class="bi bi-bank fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $completed_deposit ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Withdraws --}}
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Total Withdrawan</span>
                            </div>
                            <div>
                                <span class="avatar bg-primary">
                                    <i class="bi bi-bank fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $setting->currency_symbol }} {{ $total_withdraw ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Pending Withdrawals</span>
                            </div>
                            <div>
                                <span class="avatar bg-success">
                                    <i class="bi bi-bank fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $pending_withdraw ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Rejected Withdrawals</span>
                            </div>
                            <div>
                                <span class="avatar bg-danger">
                                    <i class="bi bi-bank fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $rejected_withdraw ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Completed Withdrawals</span>
                            </div>
                            <div>
                                <span class="avatar bg-danger">
                                    <i class="bi bi-bank fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $completed_withdraw ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Lotteries --}}
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Sold Tickets</span>
                            </div>
                            <div>
                                <span class="avatar bg-primary">
                                    <i class="bi bi-ticket-perforated fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $sold_ticket ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Sold Amounts</span>
                            </div>
                            <div>
                                <span class="avatar bg-success">
                                    <i class="bi bi-ticket-perforated fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $setting->currency_symbol }} {{ $sold_amount ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Total Winners</span>
                            </div>
                            <div>
                                <span class="avatar bg-danger">
                                    <i class="bi bi-trophy fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $total_winner ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="mb-3">
                                <span class="d-block fw-regular fs-13">Win Amounts</span>
                            </div>
                            <div>
                                <span class="avatar bg-danger">
                                    <i class="bi bi-cash-coin fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $setting->currency_symbol }} {{ $win_amount ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
