import { showToast } from "./toast.js";

export function initTheme(settings, save, csrf) {
    document.querySelectorAll(".themeColor").forEach((el) => {
        el.addEventListener("click", () => {
            const color = el.dataset.color;

            document.documentElement.style.setProperty("--theme-color", color);

            localStorage.setItem("themeColor", color);

            settings.theme_color = color;

            showToast("Theme color updated 🎨");

        });
    });

    document.querySelectorAll(".textSizeBtn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const size = btn.dataset.size;

            document.body.style.fontSize = size + "px";

            localStorage.setItem("textSize", size);

            settings.text_size = size;

            showToast("Text size updated 🔤");

        });
    });
}
