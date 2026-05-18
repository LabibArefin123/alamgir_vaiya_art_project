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

    <!-- Vite (ONLY JS ENTRY POINT) -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/frontend/custom_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/custom_banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/journey_section/journey_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/journey_section/journey_heading.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/journey_section/journey_timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/journey_section/journey_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/journey_section/journey_animation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/journey_section/journey_responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/about_section/about_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/about_section/about_sections.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/about_section/about_cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/about_section/artwork_cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/about_section/artwork_grid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/about_section/gallery_preview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/about_section/gallery_button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/welcome_page/family_section/custom_family.css') }}">

    <link rel="stylesheet" href="{{ asset('css/frontend/custom_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/gallery-page/gallery-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/gallery-page/gallery-top.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/gallery-page/gallery-toolbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/gallery-page/gallery-filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/gallery-page/gallery-empty.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/gallery-page/gallery-advanced-filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/gallery-page/gallery-grid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/gallery-page/gallery-card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/gallery-page/gallery-card-hover.css') }}">
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
        @include('frontend.partials.image-zoom-modal')
    </div>

    <script src="{{ asset('js/frontend/about-gallery.js') }}"></script>
    <script src="{{ asset('js/frontend/scroll-progress.js') }}"></script>
    <script src="{{ asset('js/frontend/back-to-top.js') }}"></script>
    <script src="{{ asset('js/frontend/gallery-page/gallery.js') }}"></script>
    <script src="{{ asset('js/frontend/gallery-page/image-zoom-modal.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
