document.addEventListener("DOMContentLoaded", function () {
    const filterDropdown = document.getElementById("galleryFilter");

    const searchInput = document.getElementById("gallerySearch");

    const galleryCards = document.querySelectorAll(".gallery-card");

    const yearFilter = document.getElementById("yearFilter");

    const monthFilter = document.getElementById("monthFilter");

    const dayFilter = document.getElementById("dayFilter");

    const noGalleryFound = document.getElementById("noGalleryFound");

    const visiblePhotoCount = document.getElementById("visiblePhotoCount");

    const toggleAdvancedFilter = document.getElementById(
        "toggleAdvancedFilter",
    );

    const advancedFilterBox = document.getElementById("advancedFilterBox");

    /*
    |--------------------------------------------------------------------------
    | Toggle Advanced Filter
    |--------------------------------------------------------------------------
    */

    toggleAdvancedFilter.addEventListener("click", function () {
        if (advancedFilterBox.style.display === "block") {
            advancedFilterBox.style.display = "none";
        } else {
            advancedFilterBox.style.display = "block";
        }
    });

    /*
    |--------------------------------------------------------------------------
    | Filter Gallery
    |--------------------------------------------------------------------------
    */

    function filterGallery() {
        const selectedFilter = filterDropdown.value.toLowerCase();

        const searchValue = searchInput.value.toLowerCase().trim();

        const selectedYear = yearFilter.value;

        const selectedMonth = monthFilter.value.toLowerCase();

        const selectedDay = dayFilter.value;

        let visibleCount = 0;

        galleryCards.forEach((card) => {
            const category = card.getAttribute("data-category").toLowerCase();

            const date = card.getAttribute("data-date").toLowerCase();

            const year = card.getAttribute("data-year");

            const month = card.getAttribute("data-month");

            const day = card.getAttribute("data-day");

            const matchesDropdown =
                selectedFilter === "all" || category === selectedFilter;

            const matchesSearch = date.includes(searchValue);

            const matchesYear = selectedYear === "" || year === selectedYear;

            const matchesMonth =
                selectedMonth === "" || month === selectedMonth;

            const matchesDay = selectedDay === "" || day === selectedDay;

            if (
                matchesDropdown &&
                matchesSearch &&
                matchesYear &&
                matchesMonth &&
                matchesDay
            ) {
                card.style.display = "block";

                visibleCount++;
            } else {
                card.style.display = "none";
            }
        });

        visiblePhotoCount.innerText = visibleCount;

        if (visibleCount === 0) {
            noGalleryFound.style.display = "flex";
        } else {
            noGalleryFound.style.display = "none";
        }
    }

    filterDropdown.addEventListener("change", filterGallery);

    searchInput.addEventListener("keyup", filterGallery);

    yearFilter.addEventListener("change", filterGallery);

    monthFilter.addEventListener("change", filterGallery);

    dayFilter.addEventListener("change", filterGallery);
});
