

<?php
require_once "includes/init.php";

$pageTitle = 'Predial Piedense | Lone Wolf';
$bodyClass = 'parceiro-page';
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<section class="parceiro-hero" style="--parceiro-bg: url('IMAGENS/PREDIAL_PIEDENSE.jpeg')">
    <div class="hero-wrap reveal-page">
        <div class="hero-texto">
            <a href="patrocinadores.php" class="voltar-link">
                <i class="fa-solid fa-arrow-left"></i>
                <span data-i18n="backPartners">Voltar aos parceiros</span>
            </a>

            <div class="parceria-label" data-i18n="partnerSince">Parceria desde 2021</div>
            <h1>Predial Piedense</h1>
            <p data-i18n="heroText">
                Imobiliária de referência. Território, confiança e retaguarda desde 2021.
            </p>

            <div class="redes-label" data-i18n="socialsLabel">Redes e site</div>
            <div class="footer-social-wrap reveal-page">
                <a href="https://www.instagram.com/predial.piedense/" target="_blank" rel="noopener noreferrer" class="social-instagram" aria-label="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://www.predialpiedense.net" target="_blank" rel="noopener noreferrer" class="social-website" aria-label="Website">
                    <?php include __DIR__ . "/includes/icon-website.php"; ?>
                </a>
                <a href="https://www.google.com/maps/place/Predial+Piedense/@38.6716103,-9.1627163,17z" target="_blank" rel="noopener noreferrer" class="social-maps" aria-label="Google Maps">
                    <?php include __DIR__ . "/includes/icon-google-maps.php"; ?>
                </a>
                <a href="https://wa.me/351212752097" target="_blank" rel="noopener noreferrer" class="social-whatsapp" aria-label="WhatsApp">
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
            <p class="subtitulo" data-i18n="aboutSubtitle">Chão, confiança, continuidade.</p>
            <div class="linha"></div>
        </header>
        <div class="parceiro-about-grid">
            <p data-i18n="aboutText1">A Predial Piedense entrou em 2021. Décadas de mercado. Uma relação sem ruído: apoio contínuo à identidade Lone Wolf.</p>
            <p data-i18n="aboutText2">Território e comunidade. A marca ganha chão. O atleta ganha retaguarda.</p>
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
                <p data-i18n="highlight1">Presença sólida no concelho</p>
            </li>
            <li>
                <span class="parceiro-highlight-index">02</span>
                <p data-i18n="highlight2">Casa com história no mercado imobiliário</p>
            </li>
            <li>
                <span class="parceiro-highlight-index">03</span>
                <p data-i18n="highlight3">Visibilidade partilhada. Sem atalhos.</p>
            </li>
        </ol>
    </div>
</section>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Predial Piedense | Lone Wolf",
        backPartners: "Voltar aos parceiros",
        partnerSince: "Parceria desde 2021",
        heroText: "Imobiliária de referência. Território, confiança e retaguarda desde 2021.",
        socialsLabel: "Redes e site",

        aboutTitle: "Sobre esta parceria",
        aboutSubtitle: "Chão, confiança, continuidade.",
        aboutText1: "A Predial Piedense entrou em 2021. Décadas de mercado. Uma relação sem ruído: apoio contínuo à identidade Lone Wolf.",
        aboutText2: "Território e comunidade. A marca ganha chão. O atleta ganha retaguarda.",

        highlightsTitle: "Destaques",
        highlightsSubtitle: "O que esta colaboração traz ao projeto",
        highlight1: "Presença sólida no concelho",
        highlight2: "Casa com história no mercado imobiliário",
        highlight3: "Visibilidade partilhada. Sem atalhos."
    },

    en: {
        pageTitle: "Predial Piedense | Lone Wolf",
        backPartners: "Back to partners",
        partnerSince: "Partnership since 2021",
        heroText: "A reference estate agency. Territory, trust and backing since 2021.",
        socialsLabel: "Social media and website",

        aboutTitle: "About this partnership",
        aboutSubtitle: "Ground, trust, continuity.",
        aboutText1: "Predial Piedense joined in 2021. Decades in the market. A quiet relationship: steady support for the Lone Wolf identity.",
        aboutText2: "Territory and community. The brand gains ground. The athlete gains a backline.",

        highlightsTitle: "Highlights",
        highlightsSubtitle: "What this collaboration brings to the project",
        highlight1: "A solid presence in the municipality",
        highlight2: "A house with history in real estate",
        highlight3: "Shared visibility. No shortcuts."
    }
};</script>
<?php include 'footer.php'; ?>

</body>
</html>
