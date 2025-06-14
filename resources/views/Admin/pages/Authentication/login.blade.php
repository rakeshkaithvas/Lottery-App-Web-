<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light"
    data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> {{ config('app.name') }} Login</title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/brand-logos/favicon.png') }}" type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="{{ asset('js/authentication-main.js') }}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('css/styles.min.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('libs/swiper/swiper-bundle.min.css') }}">

</head>

<body class="bg-white">

    <div class="row authentication mx-0">
        <div class="col-xxl-7 col-xl-7 col-lg-12">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-7 col-sm-8 col-12">
                    <div class="p-5">
                        <div class="mb-3">
                            <a href="">
                                <img src="{{ asset(\App\Models\LogoFaviconSetting::first()->logo) }}" alt=""
                                    class="authentication-brand desktop-logo">
                                <img src="{{ asset(\App\Models\LogoFaviconSetting::first()->logo) }}" alt=""
                                    class="authentication-brand desktop-dark">
                            </a>
                        </div>
                        <p class="h5 fw-semibold mb-2">Sign In</p>
                        <p class="mb-3 text-muted op-7 fw-normal">Please login with your credentials</p>

                        <div class="text-center my-5 authentication-barrier">
                            @if ($errors->any())
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <svg class="flex-shrink-0 me-2 svg-danger" xmlns="http://www.w3.org/2000/svg"
                                        enable-background="new 0 0 24 24" height="1.5rem" viewBox="0 0 24 24"
                                        width="1.5rem" fill="#000000">
                                        <g>
                                            <rect fill="none" height="24" width="24" />
                                        </g>
                                        <g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M15.73,3H8.27L3,8.27v7.46L8.27,21h7.46L21,15.73V8.27L15.73,3z M19,14.9L14.9,19H9.1L5,14.9V9.1L9.1,5h5.8L19,9.1V14.9z" />
                                                    <rect height="6" width="2" x="11" y="7" />
                                                    <rect height="2" width="2" x="11" y="15" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <div>
                                        Invalid Credentials
                                    </div>
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('request.login') }}" method="POST">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-xl-12 mt-0">
                                    <label for="signin-username" class="form-label text-default">Email Address</label>
                                    <input type="email" required name="email" class="form-control form-control-lg"
                                        id="signin-username" placeholder="Email Address">
                                </div>
                                <div class="col-xl-12 mb-3">
                                    <label for="signin-password"
                                        class="form-label text-default d-block">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-lg" id="signin-password"
                                            placeholder="Password" required name="password">
                                        <button class="btn btn-light" type="button"
                                            onclick="createpassword('signin-password',this)" id="button-addon2"><i
                                                class="ri-eye-off-line align-middle"></i></button>
                                    </div>
                                </div>

                                <div class="col-xl-12 d-grid mt-2">
                                    <button type="submit" class="btn btn-lg btn-primary">Login</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-5 col-xl-5 col-lg-5 d-xl-block d-none px-0">
            <div class="authentication-cover">
                <div class="aunthentication-cover-content rounded">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div
                                class="text-fixed-white text-center p-5 d-flex align-items-center justify-content-center">
                                <div>
                                    <div class="mb-5">
                                        <img src="{{ asset('images/authentication/app.png') }}">
                                    </div>
                                    <h6 class="fw-normal fs-14 op-7">{{ config('dev.ds_by') }}</h6>
                                    <a href="https://wa.me/{{ config('dev.whatsapp') }}" class="fw-semibold h4">
                                        <p class="fw-semibold h4">{{ config('dev.developer') }}</p>
                                    </a>
                                    <p class="op-5">{{ config('dev.tag') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Custom-Switcher JS -->
    <script src="{{ asset('js/custom-switcher.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Swiper JS -->
    <script src="{{ asset('libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Internal Sing-Up JS -->
    <script src="{{ asset('js/authentication.js') }}"></script>

    <!-- Show Password JS -->
    <script src="{{ asset('js/show-password.js') }}"></script>

</body>

</html>
