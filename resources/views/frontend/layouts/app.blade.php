<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" type="image/png" href="{{ asset('uploads/images/icon.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', config('app.name'))
    </title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- AOS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Vite (ONLY JS ENTRY POINT) -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/frontend/custom_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/custom_banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/custom_about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/custom_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/gallery-page/gallery-filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/gallery-page/gallery-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/gallery-page/gallery-card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/gallery-page/zoom_modal.css') }}">
</head>

<body>
    <div id="app">
        {{-- Scroll Progress --}}
        <div id="scroll-progress"></div>
        {{-- Back To Top --}}
        <button id="backToTop">↑</button>
        <!-- MAIN CONTENT -->
        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/frontend/about-gallery.js') }}"></script>
    <script src="{{ asset('js/frontend/scroll-progress.js') }}"></script>
    <script src="{{ asset('js/frontend/back-to-top.js') }}"></script>
    <script src="{{ asset('js/frontend/gallery-page/gallery.js') }}"></script>
    <script src="{{ asset('js/frontend/gallery-page/image-zoom-modal.js') }}"></script>
    <!-- External JS only -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
