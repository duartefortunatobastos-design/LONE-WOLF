

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
                Parceiro do projeto desde 2021.
            </p>

            <div class="redes-label" data-i18n="socialsLabel">Redes e contactos</div>
            <div class="footer-social-wrap">
                <a href="https://www.google.com/maps/place/Pinhal+de+Frades,+2840-167+Arrentela/" target="_blank" rel="noopener noreferrer" class="social-maps" aria-label="Localização">
                    <i class="fa-solid fa-location-dot"></i>
                </a>
                <a href="tel:+351968281116" class="social-phone" aria-label="Telefone">
                    <i class="fa-solid fa-phone"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="secao-branca">
    <div class="bloco-centro reveal-page">
        <h2 data-i18n="aboutTitle">Sobre esta parceria</h2>
        <div class="subtitulo" data-i18n="aboutSubtitle">Como trabalhamos em conjunto</div>
        <div class="linha"></div>

        <div class="texto-info">
            <p data-i18n="aboutText1">
                A Filipe Paiva Transportes faz parte do projeto como parceiro de confiança, representando
                compromisso, proximidade e apoio ao crescimento sustentado da Lone Wolf.
            </p>
            <p data-i18n="aboutText2">
                Esta colaboração valoriza empresas locais que acreditam no esforço, na consistência
                e na evolução contínua do clube.
            </p>
        </div>
    </div>
</section>

<section class="secao-cinza">
    <div class="bloco-centro reveal-page">
        <h2 data-i18n="highlightsTitle">Destaques</h2>
        <div class="subtitulo" data-i18n="highlightsSubtitle">O que esta colaboração traz ao projeto</div>
        <div class="linha"></div>

        <ul class="lista-destaques">
            <li data-i18n="highlight1" class="reveal-page">Relação de confiança e proximidade</li>
            <li data-i18n="highlight2" class="reveal-page">Valorização de parceiros da região</li>
            <li data-i18n="highlight3" class="reveal-page">Reforço da base de apoio ao projeto</li>
        </ul>
    </div>
</section>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Filipe Paiva Transportes | Lone Wolf",
        backPartners: "Voltar aos parceiros",
        partnerSince: "Parceria desde 2021",
        heroText: "Parceiro do projeto desde 2021.",
        socialsLabel: "Redes e contactos",

        aboutTitle: "Sobre esta parceria",
        aboutSubtitle: "Como trabalhamos em conjunto",
        aboutText1: "A Filipe Paiva Transportes faz parte do projeto como parceiro de confiança, representando compromisso, proximidade e apoio ao crescimento sustentado da Lone Wolf.",
        aboutText2: "Esta colaboração valoriza empresas locais que acreditam no esforço, na consistência e na evolução contínua do clube.",

        highlightsTitle: "Destaques",
        highlightsSubtitle: "O que esta colaboração traz ao projeto",
        highlight1: "Relação de confiança e proximidade",
        highlight2: "Valorização de parceiros da região",
        highlight3: "Reforço da base de apoio ao projeto"
    },

    en: {
        pageTitle: "Filipe Paiva Transportes | Lone Wolf",
        backPartners: "Back to partners",
        partnerSince: "Partnership since 2021",
        heroText: "Project partner since 2021.",
        socialsLabel: "Social media and contacts",

        aboutTitle: "About this partnership",
        aboutSubtitle: "How we work together",
        aboutText1: "Filipe Paiva Transportes is part of the project as a trusted partner, representing commitment, proximity and support for Lone Wolf's sustained growth.",
        aboutText2: "This collaboration values local companies that believe in effort, consistency and the club's continuous progress.",

        highlightsTitle: "Highlights",
        highlightsSubtitle: "What this collaboration brings to the project",
        highlight1: "A relationship based on trust and proximity",
        highlight2: "Valuing partners from the region",
        highlight3: "Strengthening the project's support base"
    }
};</script>
<?php include 'footer.php'; ?>

</body>
</html>
