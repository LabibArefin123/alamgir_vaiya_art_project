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

                    <!-- LEFT -->
                    <div class="gallery-toolbar-left">

                        <div class="gallery-total-images">

                            <span id="visiblePhotoCount">
                                {{ collect($galleryFolders)->sum(fn($folder) => count($folder['images'])) }}
                            </span>

                            Photos Available

                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="gallery-toolbar-right">

                        <!-- Search -->
                        <div class="gallery-search-box">

                            <i class="bi bi-search"></i>

                            <input type="text" id="gallerySearch" placeholder="Search by date...">

                        </div>

                        <!-- Main Filter -->
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

                        <!-- Settings Button -->
                        <button type="button" class="gallery-setting-btn" id="toggleAdvancedFilter">
                            <i class="bi bi-sliders"></i>
                        </button>

                    </div>

                </div>

                <!-- ADVANCED FILTER -->
                <div class="advanced-filter-box" id="advancedFilterBox">

                    <div class="row g-3">

                        <!-- YEAR -->
                        <div class="col-md-4">

                            <div class="advanced-filter-item">

                                <label>
                                    Filter By Year
                                </label>

                                <select id="yearFilter">

                                    <option value="">
                                        Select Year
                                    </option>

                                    @foreach (collect($galleryFolders)->pluck('date')->map(fn($date) => \Carbon\Carbon::parse($date)->format('Y'))->unique() as $year)
                                        <option value="{{ $year }}">
                                            {{ $year }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <!-- MONTH -->
                        <div class="col-md-4">

                            <div class="advanced-filter-item">

                                <label>
                                    Filter By Month
                                </label>

                                <select id="monthFilter">

                                    <option value="">
                                        Select Month
                                    </option>

                                    @foreach (collect($galleryFolders)->pluck('date')->map(fn($date) => \Carbon\Carbon::parse($date)->format('F'))->unique() as $month)
                                        <option value="{{ strtolower($month) }}">
                                            {{ $month }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <!-- DAY -->
                        <div class="col-md-4">

                            <div class="advanced-filter-item">

                                <label>
                                    Filter By Day
                                </label>

                                <select id="dayFilter">

                                    <option value="">
                                        Select Day
                                    </option>

                                    @foreach (collect(range(1, 31))->map(fn($day) => str_pad($day, 2, '0', STR_PAD_LEFT)) as $day)
                                        <option value="{{ $day }}">
                                            {{ $day }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

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
