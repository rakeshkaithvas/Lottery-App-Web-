@extends('Admin.layouts.app')

@section('content')

@section('title', 'Logo Setting')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')


<form action="{{ route('update.logo') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row mb-none-30">
        <div class="col-md-12 mb-30">
            <div class="card bl--5-primary">
                <div class="card-body">
                    <p class="text--primary">If the logo and favicon are not changed after you update from this page, please <span class="text--danger">clear the cache</span> from your browser. As we keep the filename the same after the update, it may show the old image for the cache. usually, it works after clear the cache but if you still see the old logo or favicon, it may be caused by server level or network level caching. Please clear them too.</p>
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-xl-6">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">Logo</div>
                    </div>
                    <div class="card-body">
                        <div style="width: 300px; height: 200px; padding: 20px; border: 2px solid #ccc; border-radius: 20px; display: flex; justify-content: center; align-items: center; overflow: hidden;">
                            <img src="{{ asset($data->logo) }}" alt="Image" style="max-width: 100%; max-height: 100%; width: auto; height: auto;">
                        </div>
                        <input class="form-control mb-2 mt-3" type="file" id="formFile" name="logo">
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">Favicon</div>
                    </div>
                    <div class="card-body">
                        <div style="width: 300px; height: 200px; padding: 20px; border: 2px solid #ccc; border-radius: 20px; display: flex; justify-content: center; align-items: center; overflow: hidden;">
                            <img src="{{ asset($data->fav_icon) }}" alt="Image" style="max-width: 100%; max-height: 100%; width: auto; height: auto;">
                        </div>
                        <input class="form-control mb-2 mt-3" type="file" id="formFile" name="fav_icon">
                    </div>
                </div>
            </div>


        </div>

        <div class="">
            <button type="submit" class="btn btn-primary" style="width: 100%;">Save Changes</button>
        </div>

    </div>

</form>

@endsection
