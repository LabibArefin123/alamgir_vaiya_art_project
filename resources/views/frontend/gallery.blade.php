@extends('frontend.layouts.app')

@section('title', 'Gallery - Alamgir Hai')

@section('content')

    @include('frontend.welcome_page.header')

    <section class="gallery-page">

        <div class="gallery-container">

            <div class="gallery-top">

                {{-- LEFT --}}
                <div class="gallery-top-left">

                    <h2>Art Gallery</h2>

                    <p>
                        Explore artistic collections, exhibitions,
                        cultural memories, and visual storytelling
                        by Alamgir Hai.
                    </p>

                    {{-- LIVE COUNT --}}
                    <div class="gallery-total-images">

                        <span id="visiblePhotoCount">
                            {{ collect($galleryFolders)->sum(fn($folder) => count($folder['images'])) }}
                        </span>

                        Photos Available

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="gallery-filter-wrapper">

                    <!-- Search -->
                    <div class="gallery-search-box">

                        <i class="bi bi-search"></i>

                        <input type="text" id="gallerySearch" placeholder="Search by date...">

                    </div>

                    <!-- Filter -->
                    <div class="gallery-dropdown-box">

                        <i class="bi bi-calendar-event"></i>

                        <select id="galleryFilter">

                            <option value="all">
                                All Gallery
                            </option>

                            @php
                                $groupedFolders = collect($galleryFolders)->groupBy('month_year');
                            @endphp

                            @foreach ($groupedFolders as $monthYear => $folders)
                                <optgroup label="{{ $monthYear }}">

                                    @foreach ($folders as $folder)
                                        <option value="{{ $folder['slug'] }}">

                                            {{ $folder['date'] }}

                                        </option>
                                    @endforeach

                                </optgroup>
                            @endforeach

                        </select>

                    </div>

                </div>

            </div>

           

            <div class="gallery-grid">

                @foreach ($galleryFolders as $folder)
                    @foreach ($folder['images'] as $image)
                        <div class="gallery-card" data-category="{{ $folder['slug'] }}"
                            data-date="{{ strtolower($folder['date']) }}">

                            <img src="{{ $image }}" alt="Gallery Image" class="zoomable-image">

                            <!-- Overlay -->
                            <div class="gallery-overlay">

                                <button type="button" class="view-image-btn">
                                    <i class="bi bi-search"></i>
                                    View Image
                                </button>

                            </div>

                            <!-- Date -->
                            <div class="gallery-date">
                                {{ $folder['date'] }}
                            </div>

                        </div>
                    @endforeach
                @endforeach

            </div>

            <div class="no-gallery-found" id="noGalleryFound">

                <div class="no-gallery-icon">
                    <i class="bi bi-images"></i>
                </div>

                <h3>No Photos Found</h3>

                <p>
                    Try another date or gallery category.
                </p>

            </div>

        </div>

    </section>

    @include('frontend.welcome_page.footer')
@endsection
