<?php
if (defined("LW_STYLES_LOADED")) {
    return;
}
define("LW_STYLES_LOADED", true);
$lwCssV = "20260821b";
$lwCss = [
    "variables.css",
    "design-system.css",
    "base.css",
    "layout.css",
    "header.css",
    "components.css",
    "pages.css",
    "auth.css",
    "chat.css",
    "social-brands.css",
    "content.css",
    "shop.css",
    "sponsors.css",
    "polish.css",
    "premium.css",
    "pages-enhanced.css",
    "features.css",
    "pages-pro.css",
    "structure.css",
    "home-sections.css",
    "athlete.css",
    "pages-ds.css",
    "admin.css",
    "admin-theme.css",
];
?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Outfit:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<?php foreach ($lwCss as $lwFile): ?>
    <link rel="stylesheet" href="assets/css/<?= htmlspecialchars($lwFile) ?>?v=<?= htmlspecialchars($lwCssV) ?>">
<?php endforeach; ?>
<style>
.reveal-page,
body.lw-enhanced .reveal-page { opacity: 1; transform: none; }
html.lw-js .reveal-page:not(.reveal-visible) { opacity: 0; transform: translateY(18px); }
html.lw-js-ready .reveal-page,
.reveal-page.reveal-visible { opacity: 1; transform: none; }
.nota-legal,
body.lw-enhanced .nota-legal {
    background: transparent !important;
    background-color: transparent !important;
    border: 1px solid rgba(229, 127, 31, 0.45);
    border-left: 4px solid #e57f1f;
}
</style>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var nodes = document.querySelectorAll(".js-countup");
    if (!nodes.length) return;

    function pad(n) { return String(n).padStart(2, "0"); }
    function parseTime(value) {
        var parts = String(value).split(":").map(function (p) { return parseInt(p, 10) || 0; });
        if (parts.length === 3) return { seconds: parts[0] * 3600 + parts[1] * 60 + parts[2], parts: 3 };
        return { seconds: parts[0] * 60 + (parts[1] || 0), parts: 2 };
    }
    function formatTime(total, parts) {
        var h = Math.floor(total / 3600), m = Math.floor((total % 3600) / 60), s = total % 60;
        return parts === 3 ? h + ":" + pad(m) + ":" + pad(s) : m + ":" + pad(s);
    }
    function finish(el) {
        var type = el.getAttribute("data-count-type") || "number";
        var suffix = el.getAttribute("data-count-suffix") || "";
        var value = el.getAttribute("data-count-value") || "";
        el.textContent = type === "time" ? value : value + suffix;
        el.setAttribute("data-counted", "1");
    }
    function animate(el) {
        if (el.getAttribute("data-counted") === "1") return;
        el.setAttribute("data-counted", "1");
        var type = el.getAttribute("data-count-type") || "number";
        var suffix = el.getAttribute("data-count-suffix") || "";
        var value = el.getAttribute("data-count-value") || "0";
        var start = performance.now();
        var duration = 1400;
        if (type === "time") {
            var parsed = parseTime(value);
            (function tick(now) {
                var p = Math.min((now - start) / duration, 1);
                var e = 1 - Math.pow(1 - p, 3);
                el.textContent = formatTime(Math.round(parsed.seconds * e), parsed.parts);
                if (p < 1) requestAnimationFrame(tick);
                else el.textContent = value;
            })(start);
            return;
        }
        var target = parseFloat(value) || 0;
        (function tick(now) {
            var p = Math.min((now - start) / duration, 1);
            var e = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(target * e) + suffix;
            if (p < 1) requestAnimationFrame(tick);
            else el.textContent = value + suffix;
        })(start);
    }

    var section = document.querySelector(".athlete-stats");
    var run = function () { nodes.forEach(animate); };
    if (section && "IntersectionObserver" in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                run();
                io.disconnect();
            });
        }, { threshold: 0.12 });
        io.observe(section);
    }
    requestAnimationFrame(function () {
        var box = (section || nodes[0]).getBoundingClientRect();
        if (box.top < window.innerHeight && box.bottom > 0) run();
    });
    window.setTimeout(function () { nodes.forEach(finish); }, 2000);
});
</script>
