document.addEventListener("DOMContentLoaded", function () {
    const filterDropdown = document.getElementById("galleryFilter");

    const searchInput = document.getElementById("gallerySearch");

    const galleryCards = document.querySelectorAll(".gallery-card");

    const visiblePhotoCount = document.getElementById("visiblePhotoCount");

    const noGalleryFound = document.getElementById("noGalleryFound");

    /*
    |--------------------------------------------------------------------------
    | Update Gallery
    |--------------------------------------------------------------------------
    */

    function filterGallery() {
        const selectedFilter = filterDropdown.value.toLowerCase();

        const searchValue = searchInput.value.toLowerCase().trim();

        let visibleCount = 0;

        galleryCards.forEach((card) => {
            const category = card.dataset.category.toLowerCase();

            const date = card.dataset.date.toLowerCase();

            /*
            |--------------------------------------------------------------------------
            | Matching Logic
            |--------------------------------------------------------------------------
            */

            const matchesDropdown =
                selectedFilter === "all" || category === selectedFilter;

            const matchesSearch = date.includes(searchValue);

            /*
            |--------------------------------------------------------------------------
            | Show / Hide
            |--------------------------------------------------------------------------
            */

            if (matchesDropdown && matchesSearch) {
                card.style.display = "block";

                visibleCount++;
            } else {
                card.style.display = "none";
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Update Counter
        |--------------------------------------------------------------------------
        */

        visiblePhotoCount.textContent = visibleCount;

        /*
        |--------------------------------------------------------------------------
        | Empty State
        |--------------------------------------------------------------------------
        */

        if (visibleCount === 0) {
            noGalleryFound.style.display = "flex";
        } else {
            noGalleryFound.style.display = "none";
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Initial Run
    |--------------------------------------------------------------------------
    */

    filterGallery();

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    filterDropdown.addEventListener("change", filterGallery);

    searchInput.addEventListener("keyup", filterGallery);
});
