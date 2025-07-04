@extends('Admin.layouts.app')

@section('content')

@section('title', 'All Withdraws')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

@section('button')
<form action="{{ route('all.withdraw') }}" method="GET">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0" placeholder="Search By Email" aria-describedby="search-contact-member" name="email" value="{{ request()->input('email') }}">
        <button class="btn btn-light" type="submit" id="search-contact-member"><i class="ri-search-line text-muted"></i></button>
    </div>
</form>
@endsection

<div class="card custom-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">Gateway</th>
                        <th scope="col">Initiated</th>
                        <th scope="col">User</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Conversion</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $withdraw)
                        <tr>
                            <td>{{ $withdraw->gateway->name ?? 'NULL' }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($withdraw->created_at)->format('Y-m-d h:i A') }}<br>
                                {{ \Carbon\Carbon::parse($withdraw->created_at)->diffForHumans() }}
                            </td>
                            <th scope="row">
                                <p class="fw-semibold mb-0 lh-1">
                                                {{ $withdraw->user->name }}</p>
                                                <p>{{ $withdraw->user->email }}</p>
                            </th>
                            <td>
                                <p>{{ $withdraw->amount }} {{ $setting->currency }}</p>
                                <b>{{ $withdraw->getable_amount }} {{ $withdraw->gateway->currency }} </b>
                            </td>
                            <td>
                                1 {{ $setting->currency }} = {{ $withdraw->gateway->rate ?? '' }} {{ $withdraw->gateway->currency ?? '' }}
                            </td>
                            <td>
                                @switch($withdraw->status)
                                @case('pending')
                                @include('Admin.partials.badges.pending')
                                    @break
                                @case('rejected')
                                <button class="btn btn-sm btn-danger-light">Rejected</button>
                                @break
                                @case('completed')
                                <button class="btn btn-sm btn-primary-light">Completed</button>
                                @break
                                @default

                            @endswitch
                            </td>
                            <td>
                                <a href="{{ route('withdraw.details', $withdraw->id) }}"><button class="btn btn-primary label-btn">
                                    <i class="ri-eye-line label-btn-icon me-2"></i>
                                    Details
                                </button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @include('Admin.partials.paginate.paginate')
        </div>
    </div>

</div>


@endsection
