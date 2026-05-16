@extends('frontend.layouts.app')

@section('title', 'Gallery - Alamgir Hai')

@section('content')

    @include('frontend.welcome_page.header')

    <section class="gallery-page">

        <div class="gallery-container">

            <div class="gallery-top">

                <h2>Art Gallery</h2>

                <div class="gallery-filter-wrapper">

                    <!-- Search -->
                    <div class="gallery-search-box">

                        <input type="text" id="gallerySearch" placeholder="Search by date...">

                    </div>

                    <!-- Dropdown Filter -->
                    <div class="gallery-dropdown-box">

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
{{--
