

<?php
require_once "includes/init.php";

$pageTitle = 'Filipe Paiva Transportes | Lone Wolf';
$bodyClass = 'parceiro-page';
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<section class="parceiro-hero" style="--parceiro-bg: url('IMAGENS/FILIPE_PAIVA.png')">
    <div class="hero-wrap reveal-page">
        <div class="hero-texto">
            <a href="patrocinadores.php" class="voltar-link">
                <i class="fa-solid fa-arrow-left"></i>
                <span data-i18n="backPartners">Voltar aos parceiros</span>
            </a>

            <div class="parceria-label" data-i18n="partnerSince">Parceria desde 2021</div>
            <h1>Filipe Paiva Transportes</h1>
            <p data-i18n="heroText">
                Estrada, prazo e palavra. Transporte local desde 2021.
            </p>

            <div class="redes-label" data-i18n="socialsLabel">Redes e contactos</div>
            <div class="footer-social-wrap reveal-page">
                <a href="https://www.google.com/maps/place/Pinhal+de+Frades,+2840-167+Arrentela/" target="_blank" rel="noopener noreferrer" class="social-maps" aria-label="Google Maps">
                    <?php include __DIR__ . "/includes/icon-google-maps.php"; ?>
                </a>
                <a href="https://wa.me/351968281116" target="_blank" rel="noopener noreferrer" class="social-whatsapp" aria-label="WhatsApp">
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
            <p class="subtitulo" data-i18n="aboutSubtitle">Compromisso de quem cumpre.</p>
            <div class="linha"></div>
        </header>
        <div class="parceiro-about-grid">
            <p data-i18n="aboutText1">A Filipe Paiva Transportes está no projeto desde 2021. Empresa local. Compromisso de quem cumpre o que diz.</p>
            <p data-i18n="aboutText2">Apoio discreto. Base sólida. O tipo de parceria que não precisa de palco.</p>
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
                <p data-i18n="highlight1">Confiança de proximidade</p>
            </li>
            <li>
                <span class="parceiro-highlight-index">02</span>
                <p data-i18n="highlight2">Parceiro da região, sem ruído</p>
            </li>
            <li>
                <span class="parceiro-highlight-index">03</span>
                <p data-i18n="highlight3">Retaguarda que chega a horas</p>
            </li>
        </ol>
    </div>
</section>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Filipe Paiva Transportes | Lone Wolf",
        backPartners: "Voltar aos parceiros",
        partnerSince: "Parceria desde 2021",
        heroText: "Estrada, prazo e palavra. Transporte local desde 2021.",
        socialsLabel: "Redes e contactos",

        aboutTitle: "Sobre esta parceria",
        aboutSubtitle: "Compromisso de quem cumpre.",
        aboutText1: "A Filipe Paiva Transportes está no projeto desde 2021. Empresa local. Compromisso de quem cumpre o que diz.",
        aboutText2: "Apoio discreto. Base sólida. O tipo de parceria que não precisa de palco.",

        highlightsTitle: "Destaques",
        highlightsSubtitle: "O que esta colaboração traz ao projeto",
        highlight1: "Confiança de proximidade",
        highlight2: "Parceiro da região, sem ruído",
        highlight3: "Retaguarda que chega a horas"
    },

    en: {
        pageTitle: "Filipe Paiva Transportes | Lone Wolf",
        backPartners: "Back to partners",
        partnerSince: "Partnership since 2021",
        heroText: "Road, deadline, word. Local transport since 2021.",
        socialsLabel: "Social media and contacts",

        aboutTitle: "About this partnership",
        aboutSubtitle: "The kind of promise that gets kept.",
        aboutText1: "Filipe Paiva Transportes has been in the project since 2021. A local company. Commitment from people who do what they say.",
        aboutText2: "Quiet support. A solid base. The kind of partnership that does not need a stage.",

        highlightsTitle: "Highlights",
        highlightsSubtitle: "What this collaboration brings to the project",
        highlight1: "Trust built up close",
        highlight2: "A regional partner, without noise",
        highlight3: "A backline that arrives on time"
    }
};</script>
<?php include 'footer.php'; ?>

</body>
</html>
