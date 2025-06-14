@extends('Admin.layouts.app')

@section('content')

@section('title', 'Contest')

@section('button')

<a href="{{ route('lottery.add.view') }}"><button type="submit" class="btn btn-primary">Add New</button></a>

@endsection

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

{{-- // TODO:: When adding a new gateway it was not showing min and max currency properly --}}
{{-- TOTO:: Need to change also when updateing gateway  --}}

<div class="card custom-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Contest</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Ticket Qty</th>
                        <th scope="col">Sold | Remaining Qty</th>
                        <th scope="col">Start | Draw Date</th>
                        <th scope="col">Type</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $lottery)
                        <tr>
                            <td>{{ $lottery->id }}</td>
                            <td>
                                <p class="fw-semibold mb-0 lh-1">
                                    {{ $lottery->name }}</p>
                            </td>
                             <td>{{ $lottery->creator->name ?? 'N/A' }}</td>
                            <td>{{ $lottery->total_ticket }}</td>
                            <td>
                                <p style="font-weight: 900">{{ $lottery->lotteryTickets()->count() }}</p>
                                <p class="op-8">{{ $lottery->total_ticket - $lottery->lotteryTickets()->count() }}</p>
                            </td>

                            <td>
                                <p>{{ \Carbon\Carbon::parse($lottery->start_date)->format('Y-m-d') }}</p>
                                <p>{{ \Carbon\Carbon::parse($lottery->draw_date)->format('Y-m-d') }}</p>
                            </td>
                            <td>
                                @if($lottery->type == 'auto')
                                @include('Admin/partials/badges/pending', ['text' => 'Auto Draw'])
                                @else
                                @include('Admin/partials/badges/pending', ['text' => 'Manual Draw'])
                                @endif
                            </td>
                            <td>
                                @switch($lottery->status)
                                    @case('active')
                                        @include('Admin/partials/badges/active')
                                    @break

                                    @case('finished')
                                        @include('Admin/partials/badges/pending', ['text' => 'Finished'])
                                    @break

                                    @case('inactive')
                                        @include('Admin/partials/badges/blocked', ['text' => 'Inactive'])
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>
                                @if($lottery->status != 'finished')
                                @if ($lottery->status == 'active')
                                @include('Admin/partials/buttons/block', [
                                    'id' => $lottery->id,
                                    'title' => 'Inactive Lottery',
                                ])
                            @else
                                @include('Admin/partials/buttons/active', [
                                    'id' => $lottery->id,
                                    'title' => 'Active Lottery',
                                ])
                            @endif
                            @include('Admin/partials/buttons/edit', [
                                'id' => $lottery->id,
                                'title' => 'Edit Lottery',
                                'route' => route('update.lottery.view', ['id' => $lottery->id])
                            ])

                            @else
                            @include('Admin/partials/badges/pending', ['text' => 'Finished'])
                                @endif

                                @include('Admin/partials/dialogues/block', [
                                    'id' => $lottery->id,
                                    'title' => 'Inactive lottery',
                                    'action' => route('active.inactive.lottery', $lottery->id),
                                ])

                                @include('Admin/partials/dialogues/active', [
                                    'id' => $lottery->id,
                                    'title' => 'Active lottery',
                                    'action' => route('active.inactive.lottery', $lottery->id),
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
