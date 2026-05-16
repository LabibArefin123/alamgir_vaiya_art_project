export function initPanel() {
    const btn = document.getElementById("floatingSettingsBtn");
    const panel = document.getElementById("settingsPanel");
    const closeBtn = document.getElementById("closeSettingsPanel");
    const overlay = document.getElementById("settingsOverlay");

    if (!btn || !panel) return;

    const openPanel = () => {
        panel.classList.add("active");
        if (overlay) overlay.classList.add("active");
    };

    const closePanel = () => {
        panel.classList.remove("active");
        if (overlay) overlay.classList.remove("active");
    };

    // Toggle panel
    btn.addEventListener("click", (e) => {
        e.stopPropagation();

        if (panel.classList.contains("active")) {
            closePanel();
        } else {
            openPanel();
        }
    });

    // Close button
    if (closeBtn) {
        closeBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            closePanel();
        });
    }

    // Overlay click
    if (overlay) {
        overlay.addEventListener("click", closePanel);
    }

    // Click outside panel
    document.addEventListener("click", (e) => {
        if (!panel.contains(e.target) && !btn.contains(e.target)) {
            closePanel();
        }
    });

    // Prevent closing when clicking inside panel
    panel.addEventListener("click", (e) => {
        e.stopPropagation();
    });

    // ESC key close
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            closePanel();
        }
    });
}
