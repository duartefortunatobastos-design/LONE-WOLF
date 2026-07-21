

<?php
require_once "includes/init.php";

$pageTitle = 'LH Ginásio | Lone Wolf';
$bodyClass = 'parceiro-page';
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<section class="parceiro-hero" style="--parceiro-bg: url('IMAGENS/LH_GINASIO.jpeg')">
    <div class="hero-wrap reveal-page">
        <div class="hero-texto">
            <a href="patrocinadores.php" class="voltar-link">
                <i class="fa-solid fa-arrow-left"></i>
                <span data-i18n="backPartners">Voltar aos parceiros</span>
            </a>

            <div class="parceria-label" data-i18n="partnerSince">Parceria desde 2021</div>
            <h1>LH Ginásio</h1>
            <p data-i18n="heroText">
                Parceiro oficial do projeto desde 2021.
            </p>

            <div class="redes-label" data-i18n="socialsLabel">Redes e site</div>
            <div class="footer-social-wrap reveal-page">
                <a href="https://www.instagram.com/lhginasio/" target="_blank" rel="noopener noreferrer" class="social-instagram" aria-label="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://www.google.com/maps/place/LH+Gin%C3%A1sio/" target="_blank" rel="noopener noreferrer" class="social-maps" aria-label="Localização">
                    <i class="fa-solid fa-location-dot"></i>
                </a>
                <a href="tel:+351968742013" class="social-phone" aria-label="Telefone">
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
                O LH Ginásio integra-se no projeto como parceiro ligado à preparação física,
                disciplina, recuperação e desenvolvimento do atleta.
            </p>
            <p data-i18n="aboutText2">
                Em conjunto promovemos uma cultura de treino, compromisso e superação,
                alinhada com a identidade competitiva da Lone Wolf.
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
            <li data-i18n="highlight1">Apoio à preparação física dos atletas</li>
            <li data-i18n="highlight2">Ligação ao treino, rendimento e recuperação</li>
            <li data-i18n="highlight3">Promoção de disciplina e evolução constante</li>
        </ul>
    </div>
</section>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "LH Ginásio | Lone Wolf",
        backPartners: "Voltar aos parceiros",
        partnerSince: "Parceria desde 2021",
        heroText: "Parceiro oficial do projeto desde 2021.",
        socialsLabel: "Redes e site",

        aboutTitle: "Sobre esta parceria",
        aboutSubtitle: "Como trabalhamos em conjunto",
        aboutText1: "O LH Ginásio integra-se no projeto como parceiro ligado à preparação física, disciplina, recuperação e desenvolvimento do atleta.",
        aboutText2: "Em conjunto promovemos uma cultura de treino, compromisso e superação, alinhada com a identidade competitiva da Lone Wolf.",

        highlightsTitle: "Destaques",
        highlightsSubtitle: "O que esta colaboração traz ao projeto",
        highlight1: "Apoio à preparação física dos atletas",
        highlight2: "Ligação ao treino, rendimento e recuperação",
        highlight3: "Promoção de disciplina e evolução constante"
    },

    en: {
        pageTitle: "LH Gym | Lone Wolf",
        backPartners: "Back to partners",
        partnerSince: "Partnership since 2021",
        heroText: "Official project partner since 2021.",
        socialsLabel: "Social media and website",

        aboutTitle: "About this partnership",
        aboutSubtitle: "How we work together",
        aboutText1: "LH Gym is part of the project as a partner connected to physical preparation, discipline, recovery and athlete development.",
        aboutText2: "Together, we promote a culture of training, commitment and self-improvement, aligned with Lone Wolf's competitive identity.",

        highlightsTitle: "Highlights",
        highlightsSubtitle: "What this collaboration brings to the project",
        highlight1: "Support for the athletes' physical preparation",
        highlight2: "Connection to training, performance and recovery",
        highlight3: "Promotion of discipline and constant progress"
    }
};</script>
<?php include 'footer.php'; ?>

</body>
</html>
