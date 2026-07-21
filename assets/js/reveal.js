(function () {
    document.addEventListener("DOMContentLoaded", () => {
        const elements = document.querySelectorAll(".reveal-page");
        if (!elements.length) return;

        elements.forEach((element, index) => {
            element.style.transitionDelay = `${Math.min(index * 0.04, 0.36)}s`;
        });

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    entry.target.classList.toggle("reveal-visible", entry.isIntersecting);
                });
            },
            { threshold: 0.1, rootMargin: "0px 0px -32px 0px" }
        );

        elements.forEach((element) => observer.observe(element));
    });
})();
