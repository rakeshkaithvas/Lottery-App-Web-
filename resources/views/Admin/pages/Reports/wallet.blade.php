@extends('Admin.layouts.app')

@section('title', 'Wallet Transactions')

@section('content')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

@section('button')
<form action="{{ url()->current() }}" method="GET">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0" placeholder="Search by sender/receiver name" name="search" value="{{ request()->input('search') }}">
        <button class="btn btn-light" type="submit" id="search-wallet"><i class="ri-search-line text-muted"></i></button>
    </div>
</form>
@endsection

<div class="card custom-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="table-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Sender</th>
                        <!-- <th>Sender Phone</th> -->
                        <th>Receiver</th>
                        <!-- <th>Receiver Phone</th> -->
                        <th>Amount</th>
                        <th>Inv. Amount</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Comment</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $txn)
                        <tr>
                            <td>{{ $txn->id }}</td>
                            <td>
                                <strong>{{ $txn->sender->name ?? 'N/A' }}</strong><br>
                                <small>{{ $txn->sender->email ?? '' }}</small><br>
                                <small>{{ $txn->sender->phone ?? '' }}</small>
                            </td>
                            <td>
                                <strong>{{ $txn->receiver->name ?? 'N/A' }}</strong><br>
                                <small>{{ $txn->receiver->email ?? '' }}</small><br>
                                <small>{{ $txn->receiver->phone ?? '' }}</small>
                            </td>
                            <td>{{ $txn->amount }}</td>
                            <td>{{ $txn->inv_amount }}</td>
                            <td>{{ ucfirst($txn->type) }}</td>
                            <td>{{ ucfirst($txn->status) }}</td>
                            <td>{{ $txn->comments ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($txn->created_at)->format('Y-m-d h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-danger">No Wallet Transactions Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

           @include('Admin.partials.paginate.paginate')
        </div>
    </div>
</div>

@endsection
