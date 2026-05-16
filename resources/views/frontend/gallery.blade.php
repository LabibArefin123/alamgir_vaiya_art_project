@extends('frontend.layouts.app')

@section('title', 'Gallery - Alamgir Hai')

@section('content')

    @include('frontend.welcome_page.header')

    <section class="gallery-page">

        <div class="container">

            <div class="gallery-top">

                <h2>Art Gallery</h2>

                <div class="gallery-filter">

                    <button class="filter-btn active" data-filter="all">
                        All
                    </button>

                    @foreach ($galleryFolders as $folder)
                        <button class="filter-btn" data-filter="{{ $folder['slug'] }}">
                            {{ $folder['date'] }}
                        </button>
                    @endforeach

                </div>

            </div>

            <div class="gallery-grid">

                @foreach ($galleryFolders as $folder)
                    @foreach ($folder['images'] as $image)
                        <div class="gallery-card" data-category="{{ $folder['slug'] }}">

                            <img src="{{ $image }}" alt="Gallery Image" class="zoomable-image">

                            <div class="gallery-date">
                                {{ $folder['date'] }}
                            </div>

                        </div>
                    @endforeach
                @endforeach

            </div>

        </div>

    </section>

    @include('frontend.partials.image-zoom-modal')

    @include('frontend.welcome_page.footer')

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/gallery.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('frontend/js/gallery.js') }}"></script>
    <script src="{{ asset('frontend/js/image-zoom-modal.js') }}"></script>
@endpush
