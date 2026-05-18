@extends('frontend.layouts.app')

@section('title', 'Gallery - Alamgir Hai')

@section('content')

    @include('frontend.welcome_page.header')

    <section class="gallery-page">

        <div class="gallery-container">

            <div class="gallery-top">

                <!-- TOP CENTER -->
                <div class="gallery-top-center">

                    <h2>
                        Art Gallery
                    </h2>

                    <p>
                        Explore artistic collections, exhibitions,
                        cultural memories, and visual storytelling
                        by Alamgir Hai.
                    </p>

                </div>

                <!-- BOTTOM AREA -->
                <div class="gallery-toolbar">
                    @include('frontend.gallery_page.toolbar_section.left')
                    @include('frontend.gallery_page.toolbar_section.right')
                </div>
                @include('frontend.gallery_page.filter_section.filter')
            </div>

            <!-- GALLERY GRID -->
            <div class="gallery-grid">

                @foreach ($galleryFolders as $folder)
                    @foreach ($folder['images'] as $image)
                        @php
                            $carbonDate = \Carbon\Carbon::parse($folder['date']);
                        @endphp

                        <div class="gallery-card" data-category="{{ $folder['slug'] }}"
                            data-date="{{ strtolower($folder['date']) }}" data-year="{{ $carbonDate->format('Y') }}"
                            data-month="{{ strtolower($carbonDate->format('F')) }}"
                            data-day="{{ $carbonDate->format('d') }}">

                            <img src="{{ $image }}" alt="Gallery Image" class="zoomable-image">

                            <div class="gallery-overlay">

                                <button type="button" class="view-image-btn">

                                    <i class="bi bi-search"></i>

                                    View Image

                                </button>

                            </div>

                            <div class="gallery-date">

                                {{ $folder['date'] }}

                            </div>

                        </div>
                    @endforeach
                @endforeach

            </div>

            <!-- EMPTY -->
            <div class="no-gallery-found" id="noGalleryFound">

                <div class="no-gallery-icon">
                    <i class="bi bi-images"></i>
                </div>

                <h3>
                    No Photos Found
                </h3>

                <p>
                    Try another date or gallery category.
                </p>

            </div>

        </div>

    </section>

    @include('frontend.welcome_page.footer')

@endsection
