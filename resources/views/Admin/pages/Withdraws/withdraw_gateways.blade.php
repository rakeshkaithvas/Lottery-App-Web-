@extends('Admin.layouts.app')

@section('content')

@section('title', 'Withdraw Gateways')

@section('button')

<a href="{{ route('add.withdraw.gateway.view') }}"><button type="submit" class="btn btn-primary">Add New</button></a>

@endsection

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

<div class="card custom-card overflow-hidden">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Gateway Name</th>
                        <th scope="col">Gateway Logo</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Charge</th>
                        <th scope="col">Limits</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $gateway)
                        <tr>
                            <td>{{ $gateway->id }}</td>
                            <td>
                                {{ $gateway->name }}
                            </td>
                            <td><span class="avatar avatar-l">
                                    <a href="{{ asset($gateway->logo ?? 'images/default/default.png') }}"
                                        target="_blank"><img
                                            src="{{ asset($gateway->logo ?? 'images/default/default.png') }}"
                                            class="img-fluid" alt="Thumbnail"></a>
                                </span>
                            </td>
                            <td>
                                {{ $gateway->currency }}
                            </td>
                            <td>
                                {{ number_format($gateway->fee) }}%
                            </td>
                            <td>
                                {{ number_format($gateway->min, 0) }} - {{ number_format($gateway->max) }} {{ \App\Models\GeneralSetting::first()->currency }}
                            </td>
                            <td>
                                @if($gateway->status == 'active')
                                @include('Admin/partials/badges/active')
                                @else
                                @include('Admin/partials/badges/blocked', ['text' => 'Inactive'])
                                @endif
                            </td>
                            <td>
                               @if($gateway->status == 'inactive')
                               @include('Admin/partials/buttons/active', [
                                'id' => $gateway->id,
                                'title' => 'Active Gateway',
                                ])
                               @else
                               @include('Admin/partials/buttons/block', [
                                'id' => $gateway->id,
                                'title' => 'Inactive Gateway',
                            ])
                               @endif

                                @include('Admin/partials/buttons/delete', [
                                    'id' => $gateway->id,
                                    'title' => 'Delete Gateway',
                                ])

                                @include('Admin/partials/buttons/edit', [
                                    'id' => $gateway->id,
                                    'title' => 'Edit Gateway',
                                    'route' => route('update.withdraw.gateway.view', $gateway->id)
                                ])

                                @include('Admin/partials/dialogues/delete', [
                                    'id' => $gateway->id,
                                    'title' => 'Delete Gateway',
                                    'action' => route('delete.withdraw.gateway', $gateway->id),
                                ])

                                @include('Admin/partials/dialogues/block', [
                                    'id' => $gateway->id,
                                    'hideForm' => true,
                                    'title' => 'Inactive Gateway',
                                    'action' => route('active.inactive.withdraw.gateway', $gateway->id),
                                ])

                                @include('Admin/partials/dialogues/active', [
                                    'id' => $gateway->id,
                                    'title' => 'Active Gateway',
                                    'action' => route('active.inactive.withdraw.gateway', $gateway->id),
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
