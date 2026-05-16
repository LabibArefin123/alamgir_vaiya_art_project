document.addEventListener("DOMContentLoaded", function () {
    const filterButtons = document.querySelectorAll(".filter-btn");
    const galleryCards = document.querySelectorAll(".gallery-card");

    filterButtons.forEach((button) => {
        button.addEventListener("click", function () {
            filterButtons.forEach((btn) => {
                btn.classList.remove("active");
            });

            this.classList.add("active");

            const filter = this.getAttribute("data-filter");

            galleryCards.forEach((card) => {
                if (
                    filter === "all" ||
                    card.getAttribute("data-category") === filter
                ) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    });
});
