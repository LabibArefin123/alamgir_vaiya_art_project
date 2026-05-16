function toggleAbout(showFull) {
    const shortAbout = document.getElementById("aboutShort");
    const fullAbout = document.getElementById("aboutFull");
    if (showFull) {
        shortAbout.style.display = "none";
        fullAbout.style.display = "block";
    } else {
        fullAbout.style.display = "none";
        shortAbout.style.display = "block";
    }
}
