@extends('Admin.layouts.app')

@section('content')

@section('title', 'Sold Ticket Log')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

@section('button')
<form action="{{ route('ticket.log') }}" method="GET">
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
                        <th scope="col">User</th>
                        <th scope="col">Lottery Name</th>
                        <th scope="col">Ticket Number</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $ticket)
                        <tr>
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
