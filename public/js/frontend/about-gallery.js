document.addEventListener("DOMContentLoaded", async function () {
    const image1 = document.getElementById("gallery-image-1");
    const image2 = document.getElementById("gallery-image-2");

    try {
        // Fetch latest gallery images
        const response = await fetch("/latest-gallery-images");

        const data = await response.json();

        if (data.length >= 2) {
            image1.src = data[0];
            image2.src = data[1];
        }
    } catch (error) {
        console.error("Gallery loading error:", error);
    }
});
