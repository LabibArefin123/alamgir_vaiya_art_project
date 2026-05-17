{{-- resources/views/frontend/welcome_page/about.blade.php --}}

<section id="about">
    <div class="container">

        <h2>About Alamgir Hai</h2>

        <p>
            Alamgir Hai is a respected artist, educator,
            entrepreneur, and cultural personality from Bangladesh.
            His contribution spans education, media, theatre,
            and business leadership.
        </p>

        <p>
            He currently serves as the Vice-Chairman of Pharmasia Ltd
            and Chairman of Momentum Media Ltd.
            He is also a Partner of Momentum and a cultural organizer
            deeply connected with theatre and education initiatives.
        </p>

        <p>
            Alamgir Hai is the Founder President of Sabdaboli Group Theatre, Barisal,
            and Founder Member & General Secretary of Mallika Kindergarten, Barisal.
        </p>

    </div>
</section>

<section id="journey">
    <div class="container">

        <h2>Professional Journey</h2>

        <div class="journey-item">
            <h3>Chairman — Momentum Media Limited</h3>
            <p>13 February 1991 – Present</p>
        </div>

        <div class="journey-item">
            <h3>Vice-Chairman — Pharmasia Limited</h3>
            <p>7 May 2012 – Present</p>
        </div>

        <div class="journey-item">
            <h3>Ex-Professor — BM College, Barisal</h3>
            <p>23 October 1991 – 30 December 1997</p>
        </div>

    </div>
</section>

<section id="education">
    <div class="container">

        <h2>Education</h2>

        <div class="education-item">
            <h3>University of Dhaka</h3>
        </div>

        <div class="education-item">
            <h3>Brojomohun College</h3>
        </div>

        <div class="education-item">
            <h3>Barisal Zilla School</h3>
        </div>

    </div>
</section>

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

<section id="contact">
    <div class="container">

        <h2>Contact</h2>

        <p>
            For exhibitions, collaborations, media inquiries,
            or artwork collections, please contact the gallery.
        </p>

    </div>
</section>
