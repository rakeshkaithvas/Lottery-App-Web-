@extends('Admin.layouts.app')

@section('content')

@section('title', 'ScratchCards')
<style>
    .switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  background-color: #ccc;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  transition: .4s;
  border-radius: 24px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #28a745;
}

input:checked + .slider:before {
  transform: translateX(26px);
}
    </style>
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
                        <th scope="col">No OF Cards</th>
                        <th scope="col">gift</th>
                        <th scope="col">Status</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scratchCards as $scratch)
                        <tr>
                            <td>{{ $scratch->id }}</td>
                            <th scope="row">
                                <p class="fw-semibold mb-0 lh-1">{{ $scratch->creator->name ?? 'N/A'  }}</p>
                            </th>
                                <td>{{ $scratch->no_cards }}</td>
                            <td>
                                {{ $scratch->gift ?? 'No Data' }}
                            </td>
                            <td>
                                  {{ $scratch->status ?? 'No Data' }}
                            </td>
                               <td>&nbsp;</td>
                           <td>
                                <form action="{{ route('scratchcard.toggle', $scratch->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <label class="switch">
                                        <input type="checkbox" onchange="this.form.submit()" {{ $scratch->status == 'active' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
         </div>
    </div>
</div>
@endsection
