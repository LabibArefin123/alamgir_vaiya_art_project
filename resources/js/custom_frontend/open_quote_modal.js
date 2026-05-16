document.addEventListener("DOMContentLoaded", function () {
    var offcanvasElement = document.getElementById("quoteOffcanvas");

    if (!offcanvasElement) return;

    var offcanvas = new bootstrap.Offcanvas(offcanvasElement);

    document.querySelectorAll(".openQuote").forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            e.preventDefault(); // important for <a>
            offcanvas.show();
        });
    });
});
