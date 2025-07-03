@extends('Admin.layouts.app')

@section('content')

@section('title', 'Sold Ticket Log')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

@section('button')
<form action="{{ route('ticket.log') }}" method="GET" class="d-flex gap-2">
    {{-- Email input --}}
    <input type="text" class="form-control bg-light border-0" 
           placeholder="Search By Email" name="email" 
           value="{{ request()->input('email') }}">

    {{-- Lottery Dropdown --}}
    <select name="lottery_id" class="form-select bg-light border-0">
        <option value="">-- Search By Lottery --</option>
        @foreach($lotteries as $lottery)
            <option value="{{ $lottery->id }}" 
                {{ request('lottery_id') == $lottery->id ? 'selected' : '' }}>
                {{ $lottery->name }}
            </option>
        @endforeach
    </select>

    {{-- Submit Button --}}
    <button class="btn btn-light" type="submit" id="search-contact-member">
        <i class="ri-search-line text-muted"></i>
    </button>
     {{-- Reset Button --}}
    <a href="{{ route('ticket.log') }}" class="btn btn-secondary" title="Reset">
        <i class="ri-refresh-line"></i>
    </a>
</form>
@endsection

<div class="card custom-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Lottery Name</th>
                        <th scope="col">Ticket Number</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $i => $ticket)
                        <tr>
                            <th scope="row">{{ $data->firstItem() + $i }}</th>
                            <th scope="row">
                                <p class="fw-semibold mb-0 lh-1">
                                                {{ $ticket->user->name }}</p>
                                                <p>{{ $ticket->user->email }}</p>
                            </th>
                            <th scope="row">
                                <p class="fw-semibold mb-0 lh-1">
                                    {{ $ticket->lottery->name }}</p>
                            </th>
                            <td>{{ $ticket->ticket_number }}</td>
                            <td>
                                {{ $ticket->lottery->price ?? 0 }}
                            </td>

                            <td>{{ \Carbon\Carbon::parse($ticket->updated_at)->format('Y-m-d h:i A') }}<br></td>

                            <td>
                                @switch($ticket->status)
                                    @case('win')
                                        @include('Admin/partials/badges/active', ['text' => 'Win'])
                                    @break

                                    @case('pending')
                                        @include('Admin/partials/badges/pending')
                                    @break

                                    @case('lose')
                                        @include('Admin/partials/badges/blocked', ['text' => 'Lose'])
                                    @break

                                    @default
                                @endswitch
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
