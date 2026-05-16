document.addEventListener("DOMContentLoaded", function () {
    const bars = document.querySelectorAll(".skill-item");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const item = entry.target;
                    const bar = item.querySelector(".skill-progress");
                    const bubble = item.querySelector(".progress-bubble");
                    const percentLabel = item.querySelector(".skill-percent");

                    const value = parseInt(bar.getAttribute("data-progress"));
                    const delay = item.getAttribute("data-delay");

                    setTimeout(() => {
                        bar.style.width = value + "%";
                        bar.classList.add("animate");

                        // Counter Animation
                        let count = 0;
                        const increment = value / 60;

                        const counter = setInterval(() => {
                            count += increment;

                            if (count >= value) {
                                count = value;
                                clearInterval(counter);
                            }

                            bubble.innerText = Math.floor(count) + "%";
                            percentLabel.innerText = Math.floor(count) + "%";
                        }, 20);
                    }, delay * 400); // stagger delay

                    observer.unobserve(item);
                }
            });
        },
        {
            threshold: 0.4,
        },
    );

    bars.forEach((bar) => observer.observe(bar));
});
