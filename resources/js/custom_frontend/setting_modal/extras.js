import { showToast } from "./toast.js";

export function initExtras(settings, save, csrf) {
    const animations = document.getElementById("enableAnimations");
    const backTop = document.getElementById("showBackToTop");
    const darkMode = document.getElementById("darkModeToggle");

    if (animations) {
        animations.addEventListener("change", (e) => {
            settings.animations = e.target.checked ? 1 : 0;

            localStorage.setItem("enableAnimations", e.target.checked);

            showToast("Animations updated");

      
        });
    }

    if (backTop) {
        backTop.addEventListener("change", (e) => {
            const btn = document.getElementById("backToTop");

            if (btn) {
                btn.style.display = e.target.checked ? "block" : "none";
            }

            settings.back_to_top = e.target.checked ? 1 : 0;

            localStorage.setItem("showBackToTop", e.target.checked);

            showToast("Back to top updated");


        });
    }

    if (darkMode) {
        darkMode.addEventListener("change", (e) => {
            document.body.classList.toggle("dark-mode", e.target.checked);

            settings.dark_mode = e.target.checked ? 1 : 0;

            localStorage.setItem("darkMode", e.target.checked);

            showToast("Dark mode updated 🌙");


        });
    }
}
