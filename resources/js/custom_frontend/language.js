// resources/js/language.js
window.googleTranslateElementInit = function () {
    new google.translate.TranslateElement(
        {
            pageLanguage: "en",
            includedLanguages: "en,bn",
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
        },
        "google_translate_element",
    );
};

function setGoogleLanguage(lang) {
    const interval = setInterval(() => {
        const select = document.querySelector(".goog-te-combo");
        if (select) {
            select.value = lang;
            select.dispatchEvent(new Event("change"));
            clearInterval(interval);
        }
    }, 200);
}

document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".langToggle");

    buttons.forEach((btn) => {
        btn.addEventListener("click", () => {
            const currentLang = btn.innerText.trim();
            const targetLang = currentLang === "EN" ? "bn" : "en";

            const select = document.querySelector(".goog-te-combo");
            if (select) {
                select.value = targetLang;
                select.dispatchEvent(new Event("change"));
            }

            buttons.forEach((b) => {
                b.innerText = targetLang.toUpperCase();
            });
        });
    });
});
