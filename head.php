<?php

$pageTitle = $pageTitle ?? "Lone Wolf";
$pageDescription = $pageDescription ?? "Website oficial do atleta Rui Bastos — Lone Wolf. Trail running, ultra trail, competições e loja.";
$extraCss = $extraCss ?? [];
$bodyClass = $bodyClass ?? "";
$pageImage = $pageImage ?? "IMAGENS/logo_lobo.png";
$pageType = $pageType ?? "website";
$config = require __DIR__ . "/site-config.php";
$canonicalUrl = rtrim($config["site_url"], "/") . "/" . basename($_SERVER["SCRIPT_NAME"] ?? "index.php");
if (!empty($_SERVER["QUERY_STRING"])) {
    $canonicalUrl .= "?" . $_SERVER["QUERY_STRING"];
}
$ogImage = rtrim($config["site_url"], "/") . "/" . ltrim($pageImage, "/");
$faviconVersion = "20260820";

$excludeEnhanced = [
    "index.php",
    "admin_mensagens.php",
    "admin_produtos.php",
    "admin_encomendas.php",
    "minhas_mensagens.php",
    "responder_mensagem.php",
    "login_admin.php",
];
$currentScript = basename($_SERVER["SCRIPT_NAME"] ?? "");
if (!in_array($currentScript, $excludeEnhanced, true)) {
    $bodyClass = trim($bodyClass . " lw-enhanced");
}
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">
    <meta property="og:type" content="<?= htmlspecialchars($pageType) ?>">
    <meta property="og:site_name" content="<?= htmlspecialchars($config["site_name"]) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImage) ?>">
    <meta property="og:image:alt" content="Lone Wolf">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription) ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImage) ?>">
    <?php if (!empty($config["analytics_id"])): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars($config["analytics_id"]) ?>"></script>
        <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?= htmlspecialchars($config["analytics_id"]) ?>');</script>
    <?php endif; ?>

    <link rel="icon" type="image/png" href="IMAGENS/logo_lobo.png?v=<?= htmlspecialchars($faviconVersion) ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="IMAGENS/favicon-32.png?v=<?= htmlspecialchars($faviconVersion) ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="IMAGENS/favicon-16.png?v=<?= htmlspecialchars($faviconVersion) ?>">
    <link rel="apple-touch-icon" href="IMAGENS/logo_lobo.png?v=<?= htmlspecialchars($faviconVersion) ?>">

    <?php include __DIR__ . "/stylesheets.php"; ?>
    <?php
    if (strpos(" {$bodyClass} ", " admin-panel-page ") !== false) {
        include __DIR__ . "/admin-ds.php";
    }
    ?>

    <script>document.documentElement.classList.add("lw-js");setTimeout(function(){document.documentElement.classList.add("lw-js-ready");},1800);</script>

    <?php foreach ($extraCss as $cssFile): ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($cssFile) ?>">
    <?php endforeach; ?>
</head>
<body class="<?= htmlspecialchars($bodyClass) ?>" data-user-auth="<?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>">
<?php
if (strpos(" {$bodyClass} ", " auth-page ") === false) {
    require_once __DIR__ . "/site-header.php";
}
?>
