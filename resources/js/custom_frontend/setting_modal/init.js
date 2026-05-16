import { initPanel } from "./panel.js";
import { initTheme } from "./theme.js";
import { initLayouts } from "./layout.js";
import { initExtras } from "./extras.js";
import { saveSettings } from "./storage.js";

document.addEventListener("DOMContentLoaded", () => {
    const csrf =
        document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content") || "";

    // 🔥 USE BACKEND SETTINGS (CRITICAL FIX)
    const settings = window.appSettings || {
        theme_color: null,
        text_size: null,
        navbar_layout: 1,
        about_layout: 1,
        footer_layout: 1,
        animations: 0,
        back_to_top: 0,
        dark_mode: 0,
    };

    // Ensure numeric values
    settings.navbar_layout = parseInt(settings.navbar_layout) || 1;
    settings.about_layout = parseInt(settings.about_layout) || 1;
    settings.footer_layout = parseInt(settings.footer_layout) || 1;

    // INIT MODULES
    initPanel();
    initTheme(settings, saveSettings, csrf);
    initLayouts(settings);
    initExtras(settings, saveSettings, csrf);

    // =========================
    // SAVE HANDLER
    // =========================
    const form = document.getElementById("settingsForm");

    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            settings.theme_color =
                document.getElementById("themeColorInput")?.value || null;

            settings.text_size =
                document.getElementById("textSizeInput")?.value || null;

            settings.navbar_layout =
                parseInt(document.getElementById("navbarLayoutBtn")?.value) ||
                settings.navbar_layout;

            settings.about_layout =
                parseInt(document.getElementById("aboutLayoutBtn")?.value) ||
                settings.about_layout;

            settings.footer_layout =
                parseInt(document.getElementById("footerLayoutBtn")?.value) ||
                settings.footer_layout;

            settings.dark_mode = document.getElementById("darkModeToggle")
                ?.checked
                ? 1
                : 0;

            console.log("✅ FINAL SETTINGS:", settings);

            saveSettings(settings, csrf);
        });
    }
});

console.log("✅ Settings module loaded");
