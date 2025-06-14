@extends('Admin.layouts.app')

@section('content')

@section('title', 'Users')

<form method="GET" action="{{ route('users') }}" class="mb-4">
    <div class="row g-2 align-items-center">
        <div class="col-auto">
            <label for="user_status" class="form-label">Filter by User Status:</label>
        </div>
        <div class="col-auto">
            <select name="user_status" id="user_status" class="form-select">
                <option value="">All</option>
                <option value="normal" {{ request('user_status') == 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="wait_for_verification" {{ request('user_status') == 'wait_for_verification' ? 'selected' : '' }}>Wait for Verification</option>
                <option value="verified" {{ request('user_status') == 'verified' ? 'selected' : '' }}>Verified</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

<div class="card custom-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Status</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <th scope="row">
                                <p class="fw-semibold mb-0 lh-1">
                                    {{ $user->name }}</p>
                            </th>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ $user->phone ?? 'No Data' }}
                            </td>

                            <td>{{ number_format($user->balance, 2, '.', '') }}</td>

                            <td>
                                @switch($user->status)
                                    @case('approved')
                                        @include('Admin/partials/badges/active')
                                    @break

                                    @case('pending')
                                        @include('Admin/partials/badges/pending')
                                    @break

                                    @case('blocked')
                                        @include('Admin/partials/badges/blocked', ['text' => 'Blocked'])
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>{{ $user->user_status ?? 'No Data' }}</td>
                            <td>
                                @include('Admin.partials.buttons.view', ['userID' => $user->id])

                                @if ($user->status == 'approved')
                                    @include('Admin/partials/buttons/block', [
                                        'id' => $user->id,
                                        'title' => 'Block User',
                                    ])
                                @else
                                    @include('Admin/partials/buttons/active', [
                                        'id' => $user->id,
                                        'title' => 'Active User',
                                    ])
                                @endif
                                @include('Admin/partials/buttons/delete', [
                                    'id' => $user->id,
                                    'title' => 'Delete User',
                                ])

                                @include('Admin/partials/dialogues/block', [
                                    'id' => $user->id,
                                    'title' => 'Block User',
                                    'action' => route('active.block.user', $user->id),
                                ])

                                @include('Admin/partials/dialogues/active', [
                                    'id' => $user->id,
                                    'title' => 'Active User',
                                    'action' => route('active.block.user', $user->id),
                                ])

                                @include('Admin/partials/dialogues/delete', [
                                    'id' => $user->id,
                                    'title' => 'Delete User',
                                    'action' => route('user.delete', $user->id),
                                ])
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
