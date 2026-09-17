<?php
if (defined("LW_STYLES_LOADED")) {
    return;
}
define("LW_STYLES_LOADED", true);
$lwCssV = "20260917b";
$lwCss = [
    "variables.css",
    "design-system.css",
    "base.css",
    "layout.css",
    "header.css",
    "components.css",
    "pages.css",
    "auth.css",
    "admin.css",
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
:root {
    --lw-bg: #0a0a0b;
    --lw-banner: linear-gradient(135deg, #06080c 0%, #0c1520 52%, #111820 100%);
    --lw-hero-h: 420px;
    --lw-hero-min-h: 420px;
    --lw-font-display: "Oswald", Impact, sans-serif;
    --lw-font-body: "Outfit", system-ui, sans-serif;
    --color-bg-primary: #0a0a0b;
    --color-bg-secondary: #151517;
    --color-accent: #e57f1f;
    --color-accent-hover: #ff9a1f;
    --color-text-primary: #f5f5f4;
    --color-text-secondary: #9a9a9d;
    --color-border: #26262a;
    --font-display: "Oswald", Impact, sans-serif;
    --font-body: "Outfit", system-ui, sans-serif;
    --font-mono: "JetBrains Mono", ui-monospace, monospace;
    --container-max: 1280px;
    --section-y: 120px;
    --tracking-display: 0.04em;
}
.reveal-page,
body.lw-enhanced .reveal-page { opacity: 1; transform: none; }
html.lw-js .reveal-page {
    transition: opacity 0.55s ease, transform 0.55s ease;
}
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
