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
                <div class="family-grid-item" data-image="{{ asset('uploads/images/family_section/image_6.png') }}">

                    <img src="{{ asset('uploads/images/family_section/image_6.png') }}" alt="Family Image 6">

                </div>

            </div>

        </div>

    </div>

</section>

{{-- JS --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const mainImage = document.getElementById('family-main-image');

        const thumbnails = document.querySelectorAll('.family-grid-item');

        thumbnails.forEach(item => {

            item.addEventListener('click', function() {

                // Remove active class
                thumbnails.forEach(el => {
                    el.classList.remove('active');
                });

                // Add active class
                this.classList.add('active');

                // Change main image
                const image = this.getAttribute('data-image');

                mainImage.classList.remove('show');

                setTimeout(() => {

                    mainImage.src = image;

                    mainImage.classList.add('show');

                }, 150);

            });

        });

    });
</script>
