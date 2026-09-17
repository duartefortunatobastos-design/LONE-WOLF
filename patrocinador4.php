

<?php
require_once "includes/init.php";

$pageTitle = 'A Imperatriz | Lone Wolf';
$bodyClass = 'parceiro-page';
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<section class="parceiro-hero" style="--parceiro-bg: url('IMAGENS/IMPERATRIZ.png')">
    <div class="hero-wrap reveal-page">
        <div class="hero-texto">
            <a href="patrocinadores.php" class="voltar-link">
                <i class="fa-solid fa-arrow-left"></i>
                <span data-i18n="backPartners">Voltar aos parceiros</span>
            </a>

            <div class="parceria-label" data-i18n="partnerSince">Parceria desde 2021</div>
            <h1>A Imperatriz</h1>
            <p data-i18n="heroText">
                Mesa, fogo e vizinhança. Casa no Seixal desde 2021.
            </p>

            <div class="redes-label" data-i18n="socialsLabel">Redes e contactos</div>
            <div class="footer-social-wrap reveal-page">
                <a href="https://www.instagram.com/a_imperatriz_churrasqueira/" target="_blank" rel="noopener noreferrer" class="social-instagram" aria-label="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://www.google.com/maps/place/A+Imperatriz/" target="_blank" rel="noopener noreferrer" class="social-maps" aria-label="Google Maps">
                    <?php include __DIR__ . "/includes/icon-google-maps.php"; ?>
                </a>
                <a href="https://wa.me/351934191343" target="_blank" rel="noopener noreferrer" class="social-whatsapp" aria-label="WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="secao-branca">
    <div class="parceiro-panel-inner">
        <header class="parceiro-panel-head">
            <h2 data-i18n="aboutTitle">Sobre esta parceria</h2>
            <p class="subtitulo" data-i18n="aboutSubtitle">Tradição à mesa. Raiz no sítio.</p>
            <div class="linha"></div>
        </header>
        <div class="parceiro-about-grid">
            <p data-i18n="aboutText1">A Imperatriz é casa no Seixal. Grelhados no carvão. Parceria desde 2021, com a comunidade à volta.</p>
            <p data-i18n="aboutText2">Marca local que acompanha o percurso. Comida, sítio, gente. O projeto não vive só na estrada.</p>
        </div>
    </div>
</section>

<section class="secao-cinza">
    <div class="parceiro-panel-inner">
        <header class="parceiro-panel-head">
            <h2 data-i18n="highlightsTitle">Destaques</h2>
            <p class="subtitulo" data-i18n="highlightsSubtitle">O que esta colaboração traz ao projeto</p>
            <div class="linha"></div>
        </header>
        <ol class="parceiro-highlights">
            <li>
                <span class="parceiro-highlight-index">01</span>
                <p data-i18n="highlight1">Raiz no Seixal</p>
            </li>
            <li>
                <span class="parceiro-highlight-index">02</span>
                <p data-i18n="highlight2">Tradição à mesa</p>
            </li>
            <li>
                <span class="parceiro-highlight-index">03</span>
                <p data-i18n="highlight3">Rede local a sério</p>
            </li>
        </ol>
    </div>
</section>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "A Imperatriz | Lone Wolf",
        backPartners: "Voltar aos parceiros",
        partnerSince: "Parceria desde 2021",
        heroText: "Mesa, fogo e vizinhança. Casa no Seixal desde 2021.",
        socialsLabel: "Redes e contactos",

        aboutTitle: "Sobre esta parceria",
        aboutSubtitle: "Tradição à mesa. Raiz no sítio.",
        aboutText1: "A Imperatriz é casa no Seixal. Grelhados no carvão. Parceria desde 2021, com a comunidade à volta.",
        aboutText2: "Marca local que acompanha o percurso. Comida, sítio, gente. O projeto não vive só na estrada.",

        highlightsTitle: "Destaques",
        highlightsSubtitle: "O que esta colaboração traz ao projeto",
        highlight1: "Raiz no Seixal",
        highlight2: "Tradição à mesa",
        highlight3: "Rede local a sério"
    },

    en: {
        pageTitle: "A Imperatriz | Lone Wolf",
        backPartners: "Back to partners",
        partnerSince: "Partnership since 2021",
        heroText: "Table, fire and neighbourhood. Home in Seixal since 2021.",
        socialsLabel: "Social media and contacts",

        aboutTitle: "About this partnership",
        aboutSubtitle: "Tradition at the table. Roots in the place.",
        aboutText1: "A Imperatriz is home in Seixal. Charcoal grilling. A partnership since 2021, with the community around it.",
        aboutText2: "A local brand that follows the path. Food, place, people. The project does not live on the road alone.",

        highlightsTitle: "Highlights",
        highlightsSubtitle: "What this collaboration brings to the project",
        highlight1: "Roots in Seixal",
        highlight2: "Tradition at the table",
        highlight3: "A local network that means it"
    }
};</script>
<?php include 'footer.php'; ?>

</body>
</html>
