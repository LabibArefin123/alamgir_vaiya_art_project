<section id="family-section">

    <div class="container">

        {{-- Header --}}
        <div class="family-header">

            <h2>Family Moments</h2>

            <p>
                Behind every artist is a beautiful family,
                support, love, and inspiration.
            </p>

        </div>

        {{-- Main Layout --}}
        <div class="family-showcase">

            {{-- LEFT FEATURED IMAGE --}}
            <div class="family-featured-image">

                <img id="family-main-image" src="{{ asset('uploads/images/family_section/image_1.png') }}"
                    alt="Featured Family Image">

            </div>

            {{-- RIGHT GRID IMAGES --}}
            <div class="family-image-grid">

                {{-- Image 1 --}}
                <div class="family-grid-item active"
                    data-image="{{ asset('uploads/images/family_section/image_1.jpg') }}">

                    <img src="{{ asset('uploads/images/family_section/image_1.jpg') }}" alt="Family Image 1">

                </div>

                {{-- Image 2 --}}
                <div class="family-grid-item" data-image="{{ asset('uploads/images/family_section/image_2.jpg') }}">

                    <img src="{{ asset('uploads/images/family_section/image_2.jpg') }}" alt="Family Image 2">

                </div>

                {{-- Image 3 --}}
                <div class="family-grid-item" data-image="{{ asset('uploads/images/family_section/image_3.jpg') }}">

                    <img src="{{ asset('uploads/images/family_section/image_3.jpg') }}" alt="Family Image 3">

                </div>

                {{-- Image 4 --}}
                <div class="family-grid-item" data-image="{{ asset('uploads/images/family_section/image_4.jpg') }}">

                    <img src="{{ asset('uploads/images/family_section/image_4.jpg') }}" alt="Family Image 4">

                </div>

                {{-- Image 5 --}}

                <div class="family-grid-item" data-image="{{ asset('uploads/images/family_section/image_5.jpg') }}">

                    <img src="{{ asset('uploads/images/family_section/image_5.jpg') }}" alt="Family Image 5">

                </div>

                {{-- Image 6 --}}
                <div class="family-grid-item" data-image="{{ asset('uploads/images/family_section/image_6.jpg') }}">

                    <img src="{{ asset('uploads/images/family_section/image_6.jpg') }}" alt="Family Image 6">

                </div>

            </div>

        </div>

    </div>

</section>

{{-- JS --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const mainImage =
            document.getElementById('family-main-image');

        const thumbnails =
            document.querySelectorAll('.family-grid-item');

        /*
        |--------------------------------------------------------------------------
        | Safety
        |--------------------------------------------------------------------------
        */

        if (!mainImage || thumbnails.length === 0) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Current Index
        |--------------------------------------------------------------------------
        */

        let currentIndex = 0;

        /*
        |--------------------------------------------------------------------------
        | Initial Image
        |--------------------------------------------------------------------------
        */

        const firstImage =
            thumbnails[0].getAttribute('data-image');

        mainImage.src = firstImage;

        thumbnails[0].classList.add('active');

        /*
        |--------------------------------------------------------------------------
        | Change Main Image
        |--------------------------------------------------------------------------
        */

        function changeMainImage(index) {

            const selectedItem =
                thumbnails[index];

            const newImage =
                selectedItem.getAttribute('data-image');

            /*
            |--------------------------------------------------------------------------
            | Remove Active
            |--------------------------------------------------------------------------
            */

            thumbnails.forEach((item) => {
                item.classList.remove('active');
            });

            /*
            |--------------------------------------------------------------------------
            | Active Current
            |--------------------------------------------------------------------------
            */

            selectedItem.classList.add('active');

            /*
            |--------------------------------------------------------------------------
            | Animation
            |--------------------------------------------------------------------------
            */

            mainImage.style.opacity = '0';

            setTimeout(() => {

                mainImage.src = newImage;

                mainImage.onload = function() {

                    mainImage.classList.remove('show');

                    void mainImage.offsetWidth;

                    mainImage.classList.add('show');

                    mainImage.style.opacity = '1';
                };

            }, 180);

            currentIndex = index;
        }

        /*
        |--------------------------------------------------------------------------
        | Hover Image Change
        |--------------------------------------------------------------------------
        */

        thumbnails.forEach((item, index) => {

            item.addEventListener('mouseenter', function() {

                changeMainImage(index);
            });

            /*
            |--------------------------------------------------------------------------
            | Click Support
            |--------------------------------------------------------------------------
            */

            item.addEventListener('click', function() {

                changeMainImage(index);
            });
        });

        /*
        |--------------------------------------------------------------------------
        | Auto Loop Every 15 Seconds
        |--------------------------------------------------------------------------
        */

        setInterval(() => {

            currentIndex++;

            if (currentIndex >= thumbnails.length) {
                currentIndex = 0;
            }

            changeMainImage(currentIndex);

        }, 15000);

    });
</script>
