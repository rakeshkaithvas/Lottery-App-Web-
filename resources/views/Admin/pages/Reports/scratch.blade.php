@extends('Admin.layouts.app')

@section('content')

@section('title', 'Scratch Card Log')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

@section('button')
<form action="{{ route('scratch.log') }}"  method="GET" class="d-flex gap-2">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0" placeholder="Search By Email" aria-describedby="search-contact-member" name="email" value="{{ request()->input('email') }}">
        
    </div>

      <div class="col-md-6">
        <select name="created_by" class="form-select">
            <option value="">-- Filter by Creator --</option>
            @foreach($users1 as $u)
                <option value="{{ $u->id }}" {{ request('created_by') == $u->id ? 'selected' : '' }}>
                    {{ $u->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Submit Button --}}
    <button class="btn btn-light" type="submit" id="search-contact-member">
        <i class="ri-search-line text-muted"></i>
    </button>
     {{-- Reset Button --}}
    <a href="{{ route('scratch.log') }}" class="btn btn-secondary" title="Reset">
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
                        <th>#</th>
                        <th scope="col">Creator Name</th>
                         <th scope="col">Gift</th>
                        <th scope="col">User</th>
                        <th scope="col">Status</th>
                        <th scope="col">Assigned At</th>
                        <th scope="col">Total Scratches</th>
                        <th scope="col">Scratched</th>
                        <th scope="col">Last Scratch</th>
                    </tr>
                </thead>
                <tbody>
                   @forelse($data as $i => $item)
                        <tr>
                            <th scope="row">{{ $data->firstItem() + $i }}</th>
                            <td>{{ $item->scratch->creator->name ?? 'N/A' }}</td>
                            <td>{{ $item->scratch->gift ?? 'N/A' }}</td>
                            <th scope="row">{{ $item->user->name ?? 'N/A' }}<br><p>{{ $item->user->phone ?? '' }}</p></th>
                            <td>{{ ucfirst($item->status) }}</td>
                            <td>{{ $item->created_at->format('d M Y, h:i A') }}</td>
                            <td>{{ $item->scratch->total_cards ?? '-' }}</td>
                            <td>{{ $item->progress->count() }}</td>
                            <td>{{ optional($item->progress->last())->created_at->format('d M Y, h:i A') ?? '-' }}</td>
                        </tr>
                            @empty
                            <tr><td colspan="8" class="text-center text-danger">No records found</td></tr>
                            @endforelse
                  </tbody>
            </table>
            @include('Admin.partials.paginate.paginate')
        </div>
    </div>
</div>
@endsection
