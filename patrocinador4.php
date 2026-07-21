

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
                Parceiro do projeto desde 2021.
            </p>

            <div class="redes-label" data-i18n="socialsLabel">Redes e contactos</div>
            <div class="footer-social-wrap reveal-page">
                <a href="https://www.instagram.com/a_imperatriz_churrasqueira/" target="_blank" rel="noopener noreferrer" class="social-instagram" aria-label="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://www.google.com/maps/place/A+Imperatriz/" target="_blank" rel="noopener noreferrer" class="social-maps" aria-label="Localização">
                    <i class="fa-solid fa-location-dot"></i>
                </a>
                <a href="tel:+351934191343" class="social-phone" aria-label="Telefone">
                    <i class="fa-solid fa-phone"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="secao-branca reveal-page">
    <div class="bloco-centro reveal-page">
        <h2 data-i18n="aboutTitle">Sobre esta parceria</h2>
        <div class="subtitulo" data-i18n="aboutSubtitle">Como trabalhamos em conjunto</div>
        <div class="linha"></div>

        <div class="texto-info reveal-page">
            <p data-i18n="aboutText1">
                A Imperatriz faz parte do projeto como parceiro local, representando proximidade,
                tradição e apoio ao crescimento da Lone Wolf.
            </p>
            <p data-i18n="aboutText2">
                Esta colaboração reforça a ligação à comunidade do Seixal e valoriza parceiros
                que acompanham o percurso competitivo do clube.
            </p>
        </div>
    </div>
</section>

<section class="secao-cinza reveal-page">
    <div class="bloco-centro reveal-page">
        <h2 data-i18n="highlightsTitle">Destaques</h2>
        <div class="subtitulo" data-i18n="highlightsSubtitle">O que esta colaboração traz ao projeto</div>
        <div class="linha"></div>

        <ul class="lista-destaques reveal-page">
            <li data-i18n="highlight1">Ligação à comunidade local do Seixal</li>
            <li data-i18n="highlight2">Apoio de uma marca próxima e tradicional</li>
            <li data-i18n="highlight3">Reforço da rede de parceiros da Lone Wolf</li>
        </ul>
    </div>
</section>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "A Imperatriz | Lone Wolf",
        backPartners: "Voltar aos parceiros",
        partnerSince: "Parceria desde 2021",
        heroText: "Parceiro do projeto desde 2021.",
        socialsLabel: "Redes e contactos",

        aboutTitle: "Sobre esta parceria",
        aboutSubtitle: "Como trabalhamos em conjunto",
        aboutText1: "A Imperatriz faz parte do projeto como parceiro local, representando proximidade, tradição e apoio ao crescimento da Lone Wolf.",
        aboutText2: "Esta colaboração reforça a ligação à comunidade do Seixal e valoriza parceiros que acompanham o percurso competitivo do clube.",

        highlightsTitle: "Destaques",
        highlightsSubtitle: "O que esta colaboração traz ao projeto",
        highlight1: "Ligação à comunidade local do Seixal",
        highlight2: "Apoio de uma marca próxima e tradicional",
        highlight3: "Reforço da rede de parceiros da Lone Wolf"
    },

    en: {
        pageTitle: "A Imperatriz | Lone Wolf",
        backPartners: "Back to partners",
        partnerSince: "Partnership since 2021",
        heroText: "Project partner since 2021.",
        socialsLabel: "Social media and contacts",

        aboutTitle: "About this partnership",
        aboutSubtitle: "How we work together",
        aboutText1: "A Imperatriz is part of the project as a local partner, representing proximity, tradition and support for Lone Wolf's growth.",
        aboutText2: "This collaboration strengthens the connection to the Seixal community and values partners who support the club's competitive journey.",

        highlightsTitle: "Highlights",
        highlightsSubtitle: "What this collaboration brings to the project",
        highlight1: "Connection to the local Seixal community",
        highlight2: "Support from a close and traditional brand",
        highlight3: "Strengthening Lone Wolf's partner network"
    }
};</script>
<?php include 'footer.php'; ?>

</body>
</html>
