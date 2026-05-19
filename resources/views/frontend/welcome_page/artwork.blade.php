<section id="artworks">
    <div class="container">

        <h2>Featured Artworks</h2>

        <p>
            Explore selected artworks and creative collections
            by Alamgir Hai.
        </p>

        <div class="art-preview">

            <!-- Left Image -->
            <div class="art-item image-card">

                @if (isset($latestImages[0]))
                    <img src="{{ $latestImages[0] }}" alt="Artwork" class="zoomable-image">
                @endif

            </div>

            <!-- Image 2 -->
            <div class="art-item image-card">

                @if (isset($latestImages[1]))
                    <img src="{{ $latestImages[1] }}" alt="Artwork" class="zoomable-image">
                @endif

            </div>

            <!-- Image 3-->
            <div class="art-item image-card">

                @if (isset($latestImages[2]))
                    <img src="{{ $latestImages[2] }}" alt="Artwork" class="zoomable-image">
                @endif

            </div>

        </div>
        <a href="{{ route('gallery') }}" class="view-gallery-btn" style="">
            View More Gallery
        </a>
    </div>
</section>
