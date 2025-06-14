<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="izQVGhluS3MwBLIwFMBzxHc8NZvvucQFPD2uXBl5">
    <title>Installation | Programming Wormhole</title>
    <meta property="og:title" content="Installation | Programming Wormhole">
    <meta property="og:description" content="Installation | Programming Wormhole">
    <meta name="twitter:title" content="Installation | Programming Wormhole">
    <script type="application/ld+json">{"@context":"https://schema.org","name":"Installation | Programming Wormhole"}</script>
    <link rel="icon" type="image/png" href="https://programmingwormhole.com/wp-content/uploads/2024/01/cropped-favicon_main-1.png">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/install.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    <style>
        :root {
            --color-primary-h: 243;
            --color-primary-s: 75%;
            --color-primary-l: 59%;
        }
        html, body {
            font-family: 'Heebo', sans-serif !important;
            margin: 0;
            padding: 0;
            height: 100%;
            /* Add background image */
            background-image: url({{ asset('images/install/background.avif') }});
            background-size: cover; /* Cover the entire body */
            background-position: center; /* Center the background image */
        }
        .container {
            position: relative;
            overflow-y: auto; /* Enable vertical scrolling for container */
            height: 100%; /* Set container height to 100% */
        }
    </style>
    <script>
        // Your script tags here
    </script>
</head>
<body class="antialiased bg-[#fafafa] text-gray-600 min-h-full flex flex-col application application-ltr overflow-x-hidden" data-new-gr-c-s-check-loaded="14.1165.0" data-gr-ext-installed="" cz-shortcut-listen="true">
    <main class="flex-grow">
        <div class="container !max-w-full py-12 px-10 lg:px-24 pt-16 pb-24 space-y-8 min-h-screen">

            @yield('content')
        </div>
    </main>

    <div><div><div class="Vue-Toastification__container top-left"></div></div><div><div class="Vue-Toastification__container top-center"></div></div><div><div class="Vue-Toastification__container top-right"></div></div><div><div class="Vue-Toastification__container bottom-left"></div></div><div><div class="Vue-Toastification__container bottom-center"></div></div><div class="Vue-Toastification__container bottom-right"></div></div>
</body>
</html>
