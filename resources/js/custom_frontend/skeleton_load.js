window.addEventListener("load", function () {
    const loader = document.getElementById("appLoader");

    setTimeout(() => {
        loader.classList.add("fade-out");

        setTimeout(() => {
            loader.style.display = "none";
        }, 400);
    }, 300); // small delay = smooth feel
});
