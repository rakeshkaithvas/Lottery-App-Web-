@extends('Admin.layouts.app')

@section('content')

@section('title', 'Referral Log')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

@section('button')
<form action="{{ route('referral.log') }}" method="GET">
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
                        <th scope="col">Refered By</th>
                        <th scope="col">Joined User</th>
                        <th scope="col">Joined At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $refer)
                        <tr>
                            <th scope="row">
                                <p>
                                    <p class="fw-semibold mb-0 lh-1">
                                        {{ $refer->referrer->name }}</p>
                                        <p>{{ $refer->referrer->email }}</p>
                                </p>
                            </th>

                            <th scope="row">
                                <p>
                                    <p class="fw-semibold mb-0 lh-1">
                                        {{ $refer->refferer->name }}</p>
                                        <p>{{ $refer->refferer->email }}</p>
                                </p>
                            </th>

                            <td>{{ \Carbon\Carbon::parse($refer->created_at)->format('Y-m-d h:i A') }}<br></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            @include('Admin.partials.paginate.paginate')
        </div>
    </div>

</div>


@endsection
