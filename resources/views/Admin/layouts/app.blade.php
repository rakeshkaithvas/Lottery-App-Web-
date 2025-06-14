<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title')</title>
    <meta name="Description" content="Truested Online Earning Platform">
    <meta name="Author" content="Programming Wormhole">
    <meta name="keywords" content="dating, love, dating app, programming wormhole">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset(\App\Models\LogoFaviconSetting::first()->fav_icon) }}" type="image/x-icon">

    <!-- Choices JS -->
    <script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Main Theme Js -->
    <script src="../assets/js/main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{ asset('libs/node-waves/waves.min.css') }}" rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="{{ asset('libs/simplebar/simplebar.min.css') }}" rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css') }}">

    <link rel="stylesheet" href="{{ asset('libs/jsvectormap/css/jsvectormap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('libs/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/prismjs/themes/prism-coy.min.css') }}">

    <!-- Choices JS -->
    <script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css') }}">
    <!-- Prism CSS -->
    <link rel="stylesheet" href="{{ asset('libs/prismjs/themes/prism-coy.min.css') }}">

    <link rel="stylesheet" href="{{ asset('libs/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/quill/quill.bubble.css') }}">


</head>

<body>
    @include('Admin.layouts.switcher')
    <div class="page">

        {{-- Header --}}
        @include('Admin.layouts.header')
        @include('Admin.layouts.sidebar')
        <div class="main-content app-content">
            <div class="container-fluid">
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <h1 class="page-title fw-semibold fs-18 mb-0">@yield('title')</h1>
                    <div class="ms-md-1 ms-0">

                    @if (!empty(trim($__env->yieldContent('button'))))
                        @yield('button')
                    @else
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#">@yield('title')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                            </ol>
                        </nav>
                    @endif
                    </div>
                </div>
                @yield('content')
            </div>
        </div>



        @include('Admin.layouts.footer')

    </div>
    <div class="scrollToTop">
        <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Popper JS -->
    <script src="{{ asset('libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('js/defaultmenu.min.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('js/sticky.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('js/simplebar.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>


    <!-- JSVector Maps JS -->
    <script src="{{ asset('libs/jsvectormap/js/jsvectormap.min.js') }}"></script>

    <!-- JSVector Maps MapsJS -->
    <script src="{{ asset('libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!-- Apex Charts JS -->
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Chartjs Chart JS -->
    <script src="{{ asset('libs/chart.js/chart.min.js') }}"></script>

    <!-- CRM-Dashboard -->
    <script src="{{ asset('js/crm-dashboard.js') }}"></script>


    <!-- Custom-Switcher JS -->
    <script src="{{ asset('js/custom-switcher.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <!-- Internal Choices JS -->
    <script src="{{ asset('js/choices.js') }}"></script>

    <!-- Quill Editor JS -->
    <script src="{{ asset('libs/quill/quill.min.js') }}"></script>

    <!-- Internal Quill JS -->
    <script src="{{ asset('js/quill-editor.js') }}"></script>



</body>


</html>
