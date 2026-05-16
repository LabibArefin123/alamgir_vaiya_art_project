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

    document.querySelectorAll(".zoomable-image").forEach((image) => {
        image.addEventListener("click", function () {
            modal.style.display = "flex";

            modalImage.src = this.src;

            document.body.style.overflow = "hidden";
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Close Button
    |--------------------------------------------------------------------------
    */

    closeModal.addEventListener("click", closeImageModal);

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
