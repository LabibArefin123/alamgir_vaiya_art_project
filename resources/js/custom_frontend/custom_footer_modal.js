document.addEventListener("DOMContentLoaded", function () {
    var mapModal = new bootstrap.Modal(
        document.getElementById("footerMapModal"),
    );
    var phoneModal = new bootstrap.Modal(
        document.getElementById("footerPhoneModal"),
    );
    var emailModal = new bootstrap.Modal(
        document.getElementById("footerEmailModal"),
    );

    document.querySelectorAll(".footer-action").forEach(function (element) {
        element.addEventListener("click", function () {
            var action = this.getAttribute("data-action");

            if (action === "location") {
                mapModal.show();
            }

            if (action === "phone") {
                phoneModal.show();
            }

            if (action === "email") {
                emailModal.show();
            }
        });
    });
});
