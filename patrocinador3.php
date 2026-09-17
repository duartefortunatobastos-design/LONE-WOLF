

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
                Onde o corpo aguenta o plano. Força e recuperação desde 2021.
            </p>

            <div class="redes-label" data-i18n="socialsLabel">Redes e site</div>
            <div class="footer-social-wrap reveal-page">
                <a href="https://www.instagram.com/lhginasio/" target="_blank" rel="noopener noreferrer" class="social-instagram" aria-label="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://lhginasio.com/" target="_blank" rel="noopener noreferrer" class="social-website" aria-label="Website">
                    <?php include __DIR__ . "/includes/icon-website.php"; ?>
                </a>
                <a href="https://www.google.com/maps/place/LH+Gin%C3%A1sio/" target="_blank" rel="noopener noreferrer" class="social-maps" aria-label="Google Maps">
                    <?php include __DIR__ . "/includes/icon-google-maps.php"; ?>
                </a>
                <a href="https://wa.me/351968742013" target="_blank" rel="noopener noreferrer" class="social-whatsapp" aria-label="WhatsApp">
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
            <p class="subtitulo" data-i18n="aboutSubtitle">Força, recuperação, consistência.</p>
            <div class="linha"></div>
        </header>
        <div class="parceiro-about-grid">
            <p data-i18n="aboutText1">O LH Ginásio entra no treino: força, mobilidade, recuperação. Sem teatro.</p>
            <p data-i18n="aboutText2">Volume na estrada. Trabalho na sala. A mesma regra: consistência.</p>
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
                <p data-i18n="highlight1">Preparação de força</p>
            </li>
            <li>
                <span class="parceiro-highlight-index">02</span>
                <p data-i18n="highlight2">Recuperação a sério</p>
            </li>
            <li>
                <span class="parceiro-highlight-index">03</span>
                <p data-i18n="highlight3">Cultura de treino, não de pose</p>
            </li>
        </ol>
    </div>
</section>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "LH Ginásio | Lone Wolf",
        backPartners: "Voltar aos parceiros",
        partnerSince: "Parceria desde 2021",
        heroText: "Onde o corpo aguenta o plano. Força e recuperação desde 2021.",
        socialsLabel: "Redes e site",

        aboutTitle: "Sobre esta parceria",
        aboutSubtitle: "Força, recuperação, consistência.",
        aboutText1: "O LH Ginásio entra no treino: força, mobilidade, recuperação. Sem teatro.",
        aboutText2: "Volume na estrada. Trabalho na sala. A mesma regra: consistência.",

        highlightsTitle: "Destaques",
        highlightsSubtitle: "O que esta colaboração traz ao projeto",
        highlight1: "Preparação de força",
        highlight2: "Recuperação a sério",
        highlight3: "Cultura de treino, não de pose"
    },

    en: {
        pageTitle: "LH Gym | Lone Wolf",
        backPartners: "Back to partners",
        partnerSince: "Partnership since 2021",
        heroText: "Where the body holds the plan. Strength and recovery since 2021.",
        socialsLabel: "Social media and website",

        aboutTitle: "About this partnership",
        aboutSubtitle: "Strength, recovery, consistency.",
        aboutText1: "LH Gym enters the training: strength, mobility, recovery. No theatre.",
        aboutText2: "Volume on the road. Work in the room. Same rule: consistency.",

        highlightsTitle: "Highlights",
        highlightsSubtitle: "What this collaboration brings to the project",
        highlight1: "Strength work",
        highlight2: "Recovery taken seriously",
        highlight3: "A training culture, not a pose"
    }
};</script>
<?php include 'footer.php'; ?>

</body>
</html>
