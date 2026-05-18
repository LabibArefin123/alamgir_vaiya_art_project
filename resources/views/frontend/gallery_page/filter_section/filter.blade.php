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
