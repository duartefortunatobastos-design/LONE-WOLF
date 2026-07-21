

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
                Parceiro oficial do projeto desde 2021.
            </p>

            <div class="redes-label" data-i18n="socialsLabel">Redes e site</div>
            <div class="footer-social-wrap reveal-page">
                <a href="https://www.instagram.com/predial.piedense/" target="_blank" rel="noopener noreferrer" class="social-instagram" aria-label="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://www.predialpiedense.net" target="_blank" rel="noopener noreferrer" class="social-website" aria-label="Website">
                    <i class="fa-solid fa-globe"></i>
                </a>
                <a href="https://www.google.com/maps/place/Predial+Piedense/@38.6716103,-9.1627163,17z" target="_blank" rel="noopener noreferrer" class="social-maps" aria-label="Localização">
                    <i class="fa-solid fa-location-dot"></i>
                </a>
                <a href="tel:212752097" class="social-phone" aria-label="Telefone">
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
                A Predial Piedense acompanha o crescimento do projeto com uma relação assente em confiança,
                proximidade e apoio contínuo à identidade da Lone Wolf.
            </p>
            <p data-i18n="aboutText2">
                Em conjunto valorizamos a presença local, a ligação à comunidade e a força de parcerias
                sólidas que ajudam a impulsionar o clube.
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
            <li data-i18n="highlight1">Reforço da presença local da marca</li>
            <li data-i18n="highlight2">Ligação a uma empresa de referência na região</li>
            <li data-i18n="highlight3">Apoio institucional e visibilidade conjunta</li>
        </ul>
    </div>
</section>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Predial Piedense | Lone Wolf",
        backPartners: "Voltar aos parceiros",
        partnerSince: "Parceria desde 2021",
        heroText: "Parceiro oficial do projeto desde 2021.",
        socialsLabel: "Redes e site",

        aboutTitle: "Sobre esta parceria",
        aboutSubtitle: "Como trabalhamos em conjunto",
        aboutText1: "A Predial Piedense acompanha o crescimento do projeto com uma relação assente em confiança, proximidade e apoio contínuo à identidade da Lone Wolf.",
        aboutText2: "Em conjunto valorizamos a presença local, a ligação à comunidade e a força de parcerias sólidas que ajudam a impulsionar o clube.",

        highlightsTitle: "Destaques",
        highlightsSubtitle: "O que esta colaboração traz ao projeto",
        highlight1: "Reforço da presença local da marca",
        highlight2: "Ligação a uma empresa de referência na região",
        highlight3: "Apoio institucional e visibilidade conjunta"
    },

    en: {
        pageTitle: "Predial Piedense | Lone Wolf",
        backPartners: "Back to partners",
        partnerSince: "Partnership since 2021",
        heroText: "Official project partner since 2021.",
        socialsLabel: "Social media and website",

        aboutTitle: "About this partnership",
        aboutSubtitle: "How we work together",
        aboutText1: "Predial Piedense supports the growth of the project through a relationship based on trust, proximity and continuous support for Lone Wolf's identity.",
        aboutText2: "Together, we value local presence, community connection and the strength of solid partnerships that help drive the club forward.",

        highlightsTitle: "Highlights",
        highlightsSubtitle: "What this collaboration brings to the project",
        highlight1: "Strengthening the brand's local presence",
        highlight2: "Connection to a reference company in the region",
        highlight3: "Institutional support and shared visibility"
    }
};</script>
<?php include 'footer.php'; ?>

</body>
</html>
