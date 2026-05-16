document.addEventListener("DOMContentLoaded", function () {
    const mapEl = document.getElementById("mapModal");
    const phoneEl = document.getElementById("phoneModal");

    // 🔥 Safety check
    if (!mapEl || !phoneEl) {
        console.error("Modal elements not found");
        return;
    }

    const mapModal = new bootstrap.Modal(mapEl);
    const phoneModal = new bootstrap.Modal(phoneEl);

    // ✅ DIRECT CLICK HANDLERS (CLEAN & RELIABLE)

    const mapBtn = document.getElementById("openMapModal");
    const phoneBtn = document.getElementById("openPhoneModal");

    if (mapBtn) {
        mapBtn.addEventListener("click", function (e) {
            e.preventDefault();
            mapModal.show();
        });
    }

    if (phoneBtn) {
        phoneBtn.addEventListener("click", function (e) {
            e.preventDefault();
            phoneModal.show();
        });
    }
});
