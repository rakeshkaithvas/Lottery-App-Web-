@extends('Admin.layouts.app')

@section('content')

@section('title', 'Sliders')

@section('button')

<a href="{{ route('add.slider.view') }}"><button type="submit" class="btn btn-primary">Add New</button></a>

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
                        <th scope="col">Image</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $slider)
                        <tr>
                            <td>{{ $slider->id }}</td>
                            <td><span class="avatar avatar-xxl">
                                    <a href="{{ asset($slider->image ?? 'images/default/default.png') }}"
                                        target="_blank"><img
                                            src="{{ asset($slider->image ?? 'images/default/default.png') }}"
                                            class="img-fluid" alt="Thumbnail"></a>
                                </span>
                            </td>
                            <td>
                                @include('Admin/partials/badges/active')
                            </td>
                            <td>
                                @include('Admin/partials/buttons/delete', [
                                    'id' => $slider->id,
                                    'title' => 'Delete slider',
                                ])
                                @include('Admin/partials/dialogues/delete', [
                                    'id' => $slider->id,
                                    'title' => 'Delete slider',
                                    'action' => route('delete.slider', $slider->id),
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
