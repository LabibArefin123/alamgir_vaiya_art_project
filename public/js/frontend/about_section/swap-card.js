document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".about-image-card");

    if (cards.length === 0) {
        return;
    }

    let current = 0;

    /*
    |----------------------------------------------------------
    | Activate Card
    |----------------------------------------------------------
    */

    function activateCard(index) {
        cards.forEach((card) => {
            card.classList.remove("active");
        });

        cards[index].classList.add("active");
    }

    /*
    |----------------------------------------------------------
    | Auto Loop
    |----------------------------------------------------------
    */

    function autoSwap() {
        current++;

        if (current >= cards.length) {
            current = 0;
        }

        activateCard(current);
    }

    /*
    |----------------------------------------------------------
    | Hover
    |----------------------------------------------------------
    */

    cards.forEach((card, index) => {
        card.addEventListener("mouseenter", function () {
            current = index;

            activateCard(index);
        });
    });

    /*
    |----------------------------------------------------------
    | Initial
    |----------------------------------------------------------
    */

    activateCard(0);

    /*
    |----------------------------------------------------------
    | Loop Every 10s
    |----------------------------------------------------------
    */

    setInterval(autoSwap, 10000);
});
