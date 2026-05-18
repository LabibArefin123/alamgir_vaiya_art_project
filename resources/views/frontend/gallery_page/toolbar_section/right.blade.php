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
