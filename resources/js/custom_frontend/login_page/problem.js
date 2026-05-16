document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("problemModal");

    // ❌ If modal doesn't exist → STOP everything
    if (!modal) return;

    const openBtn = document.getElementById("openProblemBtn");
    const closeBtn = document.getElementById("closeModalBtn");

    // OPEN MODAL
    if (openBtn) {
        openBtn.addEventListener("click", function () {
            modal.style.display = "flex";
        });
    }

    // CLOSE MODAL
    if (closeBtn) {
        closeBtn.addEventListener("click", function () {
            modal.style.display = "none";
        });
    }

    // CLOSE OUTSIDE
    window.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

    // ESC CLOSE
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && modal.style.display === "flex") {
            modal.style.display = "none";
        }
    });

    // =========================
    // PROGRESS SYSTEM (SAFE)
    // =========================

    const circle = document.querySelector(".progress-ring .progress");
    const text = document.getElementById("progressText");
    const bar = document.getElementById("progressBar");
    const previewArea = document.getElementById("previewArea");
    const pdfViewer = document.getElementById("pdfViewer");
    const form = modal.querySelector("form");

    // ❌ If critical elements missing → STOP rest
    if (!circle || !text || !bar || !previewArea || !form) return;

    let percent = 0;
    const radius = 50;
    const circumference = 2 * Math.PI * radius;

    circle.style.strokeDasharray = circumference;
    circle.style.strokeDashoffset = circumference;

    function updateProgress(val) {
        percent = val;
        const offset = circumference - (circumference * percent) / 100;

        circle.style.strokeDashoffset = offset;
        text.innerText = Math.round(percent) + "%";
        bar.style.width = Math.round(percent) + "%";
    }

    // FILE CHANGE
    document.querySelectorAll(".file-input").forEach((input) => {
        input.addEventListener("change", function () {
            previewArea.innerHTML = "";
            updateProgress(0);

            const files = [...this.files];
            if (files.length === 0) return;

            let uploadedFiles = 0;

            files.forEach((file, index) => {
                const div = document.createElement("div");
                div.classList.add("preview-item");
                div.innerText = file.name;
                previewArea.appendChild(div);

                if (file.type.includes("pdf") && pdfViewer) {
                    const url = URL.createObjectURL(file);
                    pdfViewer.src = url;
                }

                setTimeout(() => {
                    uploadedFiles++;
                    const newPercent = (uploadedFiles / files.length) * 100;
                    updateProgress(newPercent);

                    if (uploadedFiles === files.length) {
                        const msg = document.getElementById("progressMessage");
                        if (msg) msg.innerText = "Files ready ✔";
                    }
                }, 100 * index);
            });
        });
    });

    // FORM SUBMIT
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const fileInput = form.querySelector(".file-input");
        const files = fileInput ? [...fileInput.files] : [];

        if (files.length === 0) {
            form.submit();
            return;
        }

        const msg = document.getElementById("progressMessage");
        if (msg) msg.innerText = "Uploading & processing...";

        let uploaded = 0;

        function uploadNext(index) {
            if (index >= files.length) {
                animateProgress(100, () => form.submit());
                return;
            }

            setTimeout(() => {
                uploaded++;
                const newPercent = (uploaded / files.length) * 100;
                updateProgress(newPercent);
                uploadNext(index + 1);
            }, 300);
        }

        uploadNext(0);
    });

    function animateProgress(target, callback = null) {
        let current = percent;
        const step = target > current ? 2 : -2;

        const interval = setInterval(() => {
            if (
                (step > 0 && current >= target) ||
                (step < 0 && current <= target)
            ) {
                clearInterval(interval);
                updateProgress(target);
                if (callback) callback();
            } else {
                current += step;
                updateProgress(current);
            }
        }, 15);
    }
});
