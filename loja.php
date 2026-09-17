<?php
require_once "includes/init.php";

$pageTitle = "Loja | Lone Wolf";
$bodyClass = "pagina-loja";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="pagina-loja">
    <section class="hero-loja">
        <div class="hero-conteudo reveal-page">
            <p class="hero-kicker" data-i18n="heroMini">Rui Bastos</p>
            <h1 data-i18n="heroTitle">Loja</h1>
            <p class="hero-texto" data-i18n="heroPhrase">Novidades em breve.</p>
        </div>
    </section>

    <section class="ds-section ds-section--alt shop-soon">
        <div class="ds-container">
            <article class="shop-soon-card reveal-page">
                <p class="shop-soon-kicker" data-i18n="soonKicker">Loja oficial</p>
                <h2 class="ds-title" data-i18n="soonTitle">Novidades em breve</h2>
                <p class="ds-text" data-i18n="soonText">A coleção Lone Wolf ainda não está disponível. O equipamento volta quando estiver pronto.</p>
                <a href="contatos.php" class="ds-btn ds-btn-primary" data-i18n="soonCta">Falar connosco</a>
            </article>
        </div>
    </section>
</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Loja | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Loja",
        heroPhrase: "Novidades em breve.",
        soonKicker: "Loja oficial",
        soonTitle: "Novidades em breve",
        soonText: "A coleção Lone Wolf ainda não está disponível. O equipamento volta quando estiver pronto.",
        soonCta: "Falar connosco"
    },
    en: {
        pageTitle: "Shop | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Shop",
        heroPhrase: "Coming soon.",
        soonKicker: "Official shop",
        soonTitle: "Coming soon",
        soonText: "The Lone Wolf collection is not available yet. Gear returns when it is ready.",
        soonCta: "Talk to us"
    }
};</script>
<?php include "footer.php"; ?>
</body>
</html>
