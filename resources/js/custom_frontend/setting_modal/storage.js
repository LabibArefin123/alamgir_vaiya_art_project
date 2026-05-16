import { showToast } from "./toast.js";

export function saveSettings(settings, csrf) {
    const url = document
        .querySelector('meta[name="settings-update-url"]')
        ?.getAttribute("content");

    if (!url) {
        console.error("❌ Route URL not found");
        return;
    }

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf,
            Accept: "application/json",
        },
        body: JSON.stringify(settings),
    })
        .then(async (res) => {
            const text = await res.text();

            let data;
            try {
                data = JSON.parse(text);
            } catch (e) {
                console.error("❌ Non-JSON response:", text);
                throw { message: "Invalid server response", raw: text };
            }

            if (!res.ok) {
                throw data;
            }

            return data;
        })
        .then((data) => {
            console.log("✅ Settings Saved:", data);

            showToast("Settings saved successfully!");
        })
        .catch((err) => {
            console.error("❌ Save Error:", err);
            showToast("Failed to save settings!", "error");
        });
}
