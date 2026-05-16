// public/frontend/js/scroll-progress.js

window.addEventListener("scroll", function () {
    let scrollTop = document.documentElement.scrollTop;
    let scrollHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;

    let progress = (scrollTop / scrollHeight) * 100;

    document.getElementById("scroll-progress").style.width = progress + "%";
});
