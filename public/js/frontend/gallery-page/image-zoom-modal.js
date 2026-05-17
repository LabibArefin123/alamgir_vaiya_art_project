document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("imageModal");

    const modalImage = document.getElementById("modalImage");

    const closeModal = document.getElementById("closeModal");

    /*
    |--------------------------------------------------------------------------
    | Safety Check
    |--------------------------------------------------------------------------
    */

    if (!modal || !modalImage || !closeModal) {
        console.error("Modal elements not found.");

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Open Modal
    |--------------------------------------------------------------------------
    |
    | Works for:
    | - .gallery-card
    | - .image-card
    |--------------------------------------------------------------------------
    */

    const clickableCards = document.querySelectorAll(
        ".gallery-card, .image-card",
    );

    clickableCards.forEach((card) => {
        card.addEventListener("click", function () {
            const image = card.querySelector(".zoomable-image");

            if (!image) return;

            /*
            |--------------------------------------------------------------------------
            | Set Image
            |--------------------------------------------------------------------------
            */

            modalImage.src = image.src;

            /*
            |--------------------------------------------------------------------------
            | Open Modal
            |--------------------------------------------------------------------------
            */

            modal.style.display = "flex";

            /*
            |--------------------------------------------------------------------------
            | Prevent Scroll
            |--------------------------------------------------------------------------
            */

            document.body.style.overflow = "hidden";
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Close Button
    |--------------------------------------------------------------------------
    */

    closeModal.addEventListener("click", function (e) {
        e.stopPropagation();

        closeImageModal();
    });

    /*
    |--------------------------------------------------------------------------
    | Click Outside
    |--------------------------------------------------------------------------
    */

    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            closeImageModal();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | ESC Key
    |--------------------------------------------------------------------------
    */

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeImageModal();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | Close Function
    |--------------------------------------------------------------------------
    */

    function closeImageModal() {
        modal.style.display = "none";

        modalImage.src = "";

        document.body.style.overflow = "auto";
    }
});
