<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        $seo = \App\Models\SeoSetting::first();
        $settings = \App\Models\FrontendSetting::first();
    @endphp

    <link rel="icon" type="image/png" href="{{ asset('uploads/images/icon.png') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="{{ $seo->meta_description ?? 'TechnoTech Engineering Ltd.' }}">
    <meta name="keywords" content="{{ $seo->meta_keywords ?? 'engineering, technology, bangladesh' }}">
    <meta name="author" content="TechnoTech">

    <!-- OpenGraph -->
    <meta property="og:title" content="{{ $seo->og_title ?? config('app.name') }}">
    <meta property="og:image" content="{{ asset($seo->og_image ?? 'uploads/default-seo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="settings-update-url" content="{{ route('settings.update') }}">
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

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/frontend/frontend.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/skeleton_load.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/setting_button/button.css') }}">
</head>

<body>
    <div id="app" x-data x-cloak>
        <!-- Scroll Progress -->
        <div id="scrollProgress"></div>

        <!-- Google Translate -->
        @if (!request()->routeIs(['login', 'register', 'password.*']))
            <div id="google_translate_element"></div>

            <script>
                function googleTranslateElementInit() {
                    new google.translate.TranslateElement({
                        pageLanguage: 'en',
                        includedLanguages: 'en,bn',
                        autoDisplay: false
                    }, 'google_translate_element');
                }
            </script>

            <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        @endif

        <!-- MAIN CONTENT -->
        <main>
            @yield('content')
        </main>

        <!-- MODALS -->
        @include('frontend.components.quote_modal')
        @include('frontend.components.location_modal_t')
        @include('frontend.components.phone_modal_t')
        @include('frontend.components.email_modal_footer')
        @include('frontend.components.phone_modal_footer')
        @include('frontend.components.location_modal_footer')

        @if (!request()->routeIs(['login', 'register', 'password.*']))
            @include('frontend.components.setting_float_modal')
            @include('frontend.components.skeleton_load')
        @endif
    </div>

    <!-- BACK TO TOP -->
    <button id="backToTop" class="back-to-top">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- External JS only -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
        });
    </script>
    <!-- Global JS Data -->
    <script>
        window.appData = {
            success: @json(session('success')),
            errors: @json($errors->all())
        };

        window.appSettings = @json($settings ?? null);
    </script>
    <!-- Google Translate -->
</body>

</html>
