@extends('Admin.layouts.app')

@section('content')

@section('title', 'Ticket History')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

<div class="card custom-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">ID</th>
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
                            <td>{{ $ticket->id }}</td>
                            <th scope="row">
                                <p class="fw-semibold mb-0 lh-1">
                                    {{ $ticket->name }}</p>
                            </th>
                            <td>{{ $ticket->email }}</td>
                            <td>
                                {{ $ticket->phone ?? 'No Data' }}
                            </td>

                            <td>{{ number_format($ticket->balance, 2, '.', '') }}</td>

                            <td>
                                @switch($ticket->status)
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
                            <td>
                                @include('Admin.partials.buttons.view', ['ticketID' => $ticket->id])

                                @if ($ticket->status == 'approved')
                                    @include('Admin/partials/buttons/block', [
                                        'id' => $ticket->id,
                                        'title' => 'Block ticket',
                                    ])
                                @else
                                    @include('Admin/partials/buttons/active', [
                                        'id' => $ticket->id,
                                        'title' => 'Active ticket',
                                    ])
                                @endif
                                @include('Admin/partials/buttons/delete', [
                                    'id' => $ticket->id,
                                    'title' => 'Delete ticket',
                                ])

                                @include('Admin/partials/dialogues/block', [
                                    'id' => $ticket->id,
                                    'title' => 'Block ticket',
                                    'action' => route('active.block.ticket', $ticket->id),
                                ])

                                @include('Admin/partials/dialogues/active', [
                                    'id' => $ticket->id,
                                    'title' => 'Active ticket',
                                    'action' => route('active.block.ticket', $ticket->id),
                                ])

                                @include('Admin/partials/dialogues/delete', [
                                    'id' => $ticket->id,
                                    'title' => 'Delete ticket',
                                    'action' => route('ticket.delete', $ticket->id),
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
