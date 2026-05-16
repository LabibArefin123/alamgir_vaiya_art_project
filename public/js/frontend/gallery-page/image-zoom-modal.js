document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("imageModal");

    const modalImage = document.getElementById("modalImage");

    const closeModal = document.getElementById("closeModal");

    const galleryImages = document.querySelectorAll(".zoomable-image");

    /*
    |--------------------------------------------------------------------------
    | Open Modal
    |--------------------------------------------------------------------------
    */

    galleryImages.forEach((image) => {
        image.addEventListener("click", function () {
            modal.style.display = "flex";

            modalImage.src = this.src;

            document.body.style.overflow = "hidden";
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Close Modal Button
    |--------------------------------------------------------------------------
    */

    closeModal.addEventListener("click", function () {
        closeImageModal();
    });

    /*
    |--------------------------------------------------------------------------
    | Click Outside Close
    |--------------------------------------------------------------------------
    */

    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            closeImageModal();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | ESC Key Close
    |--------------------------------------------------------------------------
    */

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeImageModal();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | Reusable Close Function
    |--------------------------------------------------------------------------
    */

    function closeImageModal() {
        modal.style.display = "none";

        modalImage.src = "";

        document.body.style.overflow = "auto";
    }
});
