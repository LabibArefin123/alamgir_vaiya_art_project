import { showToast } from "./toast.js";

// 🔹 Helpers
function hideAll(selector) {
    document.querySelectorAll(selector).forEach((el) => {
        el.style.display = "none";
    });
}

function setInputValue(id, value) {
    const input = document.getElementById(id);
    if (input) input.value = value;
}

function setActive(buttons, activeBtn) {
    buttons.forEach((btn) => btn.classList.remove("active"));
    if (activeBtn) activeBtn.classList.add("active");
}

// 🔥 APPLY LAYOUT (NO TOAST, NO CLICK)
function applyLayout(type, layout) {
    layout = parseInt(layout);

    if (type === "navbar") {
        hideAll(".topbar-layout, .navbar-layout");

        document
            .getElementById("topbar" + layout)
            ?.style.setProperty("display", "block");
        document
            .getElementById("navbar" + layout)
            ?.style.setProperty("display", "block");

        setInputValue("navbarLayoutBtn", layout);
    }

    if (type === "about") {
        hideAll(".about-layout");

        document
            .getElementById("about" + layout)
            ?.style.setProperty("display", "block");

        setInputValue("aboutLayoutBtn", layout);
    }

    if (type === "footer") {
        hideAll(".footer-layout");

        document
            .getElementById("footer" + layout)
            ?.style.setProperty("display", "block");

        setInputValue("footerLayoutBtn", layout);
    }
}

export function initLayouts(settings) {
    // =========================
    // NAVBAR
    // =========================
    const navbarButtons = document.querySelectorAll(".navbarLayoutBtn");

    navbarButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            const layout = parseInt(btn.dataset.layout);

            applyLayout("navbar", layout);

            settings.navbar_layout = layout;
            setInputValue("navbarLayoutBtn", layout);

            localStorage.setItem("navbarLayout", layout);

            setActive(navbarButtons, btn);

            showToast("Navbar Layout " + layout + " applied");
        });
    });

    // =========================
    // ABOUT
    // =========================
    const aboutButtons = document.querySelectorAll(".aboutLayoutBtn");

    aboutButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            const layout = parseInt(btn.dataset.layout);

            applyLayout("about", layout);

            settings.about_layout = layout;
            setInputValue("aboutLayoutBtn", layout);

            localStorage.setItem("aboutLayout", layout);

            setActive(aboutButtons, btn);

            showToast("About Layout " + layout + " applied");
        });
    });

    // =========================
    // FOOTER
    // =========================
    const footerButtons = document.querySelectorAll(".footerLayoutBtn");

    footerButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            const layout = parseInt(btn.dataset.layout);

            applyLayout("footer", layout);

            settings.footer_layout = layout;
            setInputValue("footerLayoutBtn", layout);

            localStorage.setItem("footerLayout", layout);

            setActive(footerButtons, btn);

            showToast("Footer Layout " + layout + " applied");
        });
    });

    // =========================
    // 🔥 LOAD INITIAL STATE (FIXED)
    // =========================

    const savedNavbar =
        settings.navbar_layout ||
        parseInt(localStorage.getItem("navbarLayout")) ||
        1;

    const savedAbout =
        settings.about_layout ||
        parseInt(localStorage.getItem("aboutLayout")) ||
        1;

    const savedFooter =
        settings.footer_layout ||
        parseInt(localStorage.getItem("footerLayout")) ||
        1;

    // APPLY WITHOUT CLICK (NO TOAST)
    applyLayout("navbar", savedNavbar);
    applyLayout("about", savedAbout);
    applyLayout("footer", savedFooter);

    // SET ACTIVE BUTTONS
    setActive(
        navbarButtons,
        document.querySelector(
            `.navbarLayoutBtn[data-layout="${savedNavbar}"]`,
        ),
    );

    setActive(
        aboutButtons,
        document.querySelector(`.aboutLayoutBtn[data-layout="${savedAbout}"]`),
    );

    setActive(
        footerButtons,
        document.querySelector(
            `.footerLayoutBtn[data-layout="${savedFooter}"]`,
        ),
    );
}
