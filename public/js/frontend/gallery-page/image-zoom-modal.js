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
    */

    document.querySelectorAll(".gallery-card").forEach((card) => {
        card.addEventListener("click", function () {
            const image = card.querySelector(".zoomable-image");

            if (!image) return;

            modal.style.display = "flex";

            modalImage.src = image.src;

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
