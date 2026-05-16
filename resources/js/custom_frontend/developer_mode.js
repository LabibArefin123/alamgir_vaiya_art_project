let typedKeys = "";
let developerUnlocked = false;

document.addEventListener("keydown", function (e) {
    typedKeys += e.key.toLowerCase();
    typedKeys = typedKeys.slice(-9);

    if (typedKeys === "developer" && !developerUnlocked) {
        developerUnlocked = true;

        fetch("/developer-unlock", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "success",
                    title: "Developer Mode Activated",
                    text: "You may login the system and use it",
                    showConfirmButton: false,
                    timer: 3500,
                });

                setTimeout(() => {
                    window.location.href = "/login";
                }, 1200);
            });
    }
});
