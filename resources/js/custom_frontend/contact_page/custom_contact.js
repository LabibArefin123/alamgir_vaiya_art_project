document.addEventListener("DOMContentLoaded", () => {
    if (typeof bootstrap === "undefined") {
        console.error("❌ Bootstrap not loaded");
        return;
    }

    const emailBtn = document.getElementById("emailModalTrigger");
    const callBtn = document.getElementById("callModalTrigger");

    const emailModalEl = document.getElementById("emailModal");
    const callModalEl = document.getElementById("callModal");

    if (emailBtn && emailModalEl) {
        const emailModal = new bootstrap.Modal(emailModalEl);

        emailBtn.addEventListener("click", function () {
            emailModal.show();
        });
    }

    if (callBtn && callModalEl) {
        const callModal = new bootstrap.Modal(callModalEl);

        callBtn.addEventListener("click", function () {
            callModal.show();
        });
    }
});
