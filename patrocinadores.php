<?php
require_once "includes/init.php";

$pageTitle = 'Patrocinadores | Lone Wolf';
$bodyClass = 'content-page patrocinadores-page';
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main>

<section class="hero">
    <div class="hero-conteudo reveal-page">
        <div class="hero-mini" data-i18n="heroMini">Rui Bastos</div>
        <h1 data-i18n="heroTitle">Parceiros</h1>
        <p class="hero-frase" data-i18n="heroPhrase">
            Marcas que acreditam na disciplina, na superação e na mentalidade Lone Wolf.
        </p>
    </div>
</section>

<section class="section">
<div class="container">

<div class="title reveal-page">
    <h2 data-i18n="sponsorsTitle">Parceiros</h2>
    <p data-i18n="sponsorsSubtitle">Orgulhoso em trabalhar com marcas que partilham a nossa visão de excelência</p>
    <div class="line"></div>
</div>

<div class="grid">

    <div class="card reveal-page">
        <div class="card-bg" style="background-image:url('IMAGENS/PREDIAL_PIEDENSE.jpeg');"></div>

        <div class="card-content">
            <h3>Predial Piedense</h3>
            <p data-i18n="predialText">
                Imobiliária de referência. Território, confiança e retaguarda desde 2021.
            </p>
            <a href="patrocinador1.php" class="btn" data-i18n="seePartnership">Ver parceria</a>
        </div>
    </div>

    <div class="card reveal-page">
        <div class="card-bg" style="background-image:url('IMAGENS/FILIPE_PAIVA.png');"></div>

        <div class="card-content">
            <h3>Filipe P. Transportes</h3>
            <p data-i18n="filipeText">
                Transporte rodoviário. Estrada, prazo e palavra.
            </p>
            <a href="patrocinador2.php" class="btn" data-i18n="seePartnership">Ver parceria</a>
        </div>
    </div>

    <div class="card reveal-page">
        <div class="card-bg" style="background-image:url('IMAGENS/LH_GINASIO.jpeg');"></div>

        <div class="card-content">
            <h3>LH Ginásio</h3>
            <p data-i18n="lhText">
                Ginásio. Força, recuperação e consistência de treino.
            </p>
            <a href="patrocinador3.php" class="btn" data-i18n="seePartnership">Ver parceria</a>
        </div>
    </div>

    <div class="card reveal-page">
        <div class="card-bg" style="background-image:url('IMAGENS/IMPERATRIZ.png');"></div>

        <div class="card-content">
            <h3>Restaurante Imperatriz</h3>
            <p data-i18n="imperatrizText">
                Grelhados no carvão. Casa e comunidade no Seixal.
            </p>
            <a href="patrocinador4.php" class="btn" data-i18n="seePartnership">Ver parceria</a>
        </div>
    </div>

</div>

</div>
</section>

</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Patrocinadores | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Parceiros",
        heroPhrase: "Marcas que acreditam na disciplina, na superação e na mentalidade Lone Wolf.",

        sponsorsTitle: "Parceiros",
        sponsorsSubtitle: "Orgulhoso em trabalhar com marcas que partilham a nossa visão de excelência",

        predialText: "Imobiliária de referência. Território, confiança e retaguarda desde 2021.",
        filipeText: "Transporte rodoviário. Estrada, prazo e palavra.",
        lhText: "Ginásio. Força, recuperação e consistência de treino.",
        imperatrizText: "Grelhados no carvão. Casa e comunidade no Seixal.",

        seePartnership: "Ver parceria"
    },

    en: {
        pageTitle: "Partners | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Partners",
        heroPhrase: "Brands that believe in discipline, resilience and the Lone Wolf mindset.",

        sponsorsTitle: "Partners",
        sponsorsSubtitle: "Proud to work with brands that share our vision of excellence",

        predialText: "A reference estate agency. Territory, trust and backing since 2021.",
        filipeText: "Road transport. Road, deadline, word.",
        lhText: "Gym. Strength, recovery and training consistency.",
        imperatrizText: "Charcoal grilling. Home and community in Seixal.",

        seePartnership: "View partnership"
    }
};</script>
<?php include 'footer.php'; ?>

</body>
</html>
