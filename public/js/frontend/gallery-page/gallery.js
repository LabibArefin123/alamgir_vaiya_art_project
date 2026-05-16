document.addEventListener("DOMContentLoaded", function () {
    const filterDropdown = document.getElementById("galleryFilter");
    const searchInput = document.getElementById("gallerySearch");
    const galleryCards = document.querySelectorAll(".gallery-card");

    function filterGallery() {
        const selectedFilter = filterDropdown.value.toLowerCase();

        const searchValue = searchInput.value.toLowerCase().trim();

        galleryCards.forEach((card) => {
            const category = card.getAttribute("data-category").toLowerCase();

            const date = card.getAttribute("data-date").toLowerCase();

            const matchesDropdown =
                selectedFilter === "all" || category === selectedFilter;

            const matchesSearch = date.includes(searchValue);

            if (matchesDropdown && matchesSearch) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    }

    filterDropdown.addEventListener("change", filterGallery);

    searchInput.addEventListener("keyup", filterGallery);
});
