<?php
require_once "includes/init.php";

$pageTitle = "Página Principal | Lone Wolf";
$pageDescription = "Website oficial do atleta Rui Bastos — Lone Wolf. Trail running, ultra trail, competições e loja.";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main>
    <section class="hero-home">
        <div class="hero-conteudo reveal-page">
            <h1>LONE <span class="destaque">WOLF</span></h1>
            <p data-i18n="heroPhrase">
                Cada quilómetro conta uma história. Cada meta é um novo começo.
            </p>
        </div>
    </section>

    <section class="home-explorar">
        <div class="container">
            <div class="titulo-secao reveal-page">
                <h2 data-i18n="exploreTitle">Explorar</h2>
                <p data-i18n="exploreSubtitle">História, treinos, parceiros e mais sobre o projeto Lone Wolf</p>
                <div class="linha"></div>
            </div>

            <div class="home-explorar-grid">
                <a href="historia.php" class="home-explorar-card reveal-page">
                    <span class="home-explorar-icone"><i class="fa-solid fa-book-open"></i></span>
                    <span class="home-explorar-titulo" data-i18n="historyBtn">A Minha História</span>
                    <span class="home-explorar-texto" data-i18n="exploreHistory">A jornada, os desafios e a evolução do atleta.</span>
                </a>

                <a href="rotina.php" class="home-explorar-card reveal-page">
                    <span class="home-explorar-icone"><i class="fa-solid fa-dumbbell"></i></span>
                    <span class="home-explorar-titulo" data-i18n="exploreTraining">Treinos</span>
                    <span class="home-explorar-texto" data-i18n="exploreTrainingText">Rotina, preparação e método de trabalho.</span>
                </a>

                <a href="patrocinadores.php" class="home-explorar-card reveal-page">
                    <span class="home-explorar-icone"><i class="fa-solid fa-handshake"></i></span>
                    <span class="home-explorar-titulo" data-i18n="partnersBtn">Parceiros</span>
                    <span class="home-explorar-texto" data-i18n="explorePartners">Marcas e apoios que fazem parte desta caminhada.</span>
                </a>
            </div>
        </div>
    </section>

    <section class="secao secao-resultados">
        <div class="container">
            <div class="titulo-secao reveal-page">
                <h2 data-i18n="latestResultsTitle">Últimos Resultados</h2>
                <p data-i18n="latestResultsSubtitle">Provas recentes e conquistas</p>
                <div class="linha"></div>
            </div>

            <div class="cards-resultados">
                <div class="resultado-card reveal-page">
                    <div class="resultado-topo" data-i18n="ranking11">Classificação: 11.º</div>
                    <div class="resultado-prova" data-i18n="portoMarathon">Maratona do Porto</div>
                    <div class="resultado-tempo">02:52:55</div>
                </div>

                <div class="resultado-card reveal-page">
                    <div class="resultado-topo" data-i18n="ranking1">Classificação: 1.º</div>
                    <div class="resultado-prova" data-i18n="lagosHalf">Meia Internacional de Lagos</div>
                    <div class="resultado-tempo">01:21:45</div>
                </div>

                <div class="resultado-card reveal-page">
                    <div class="resultado-topo" data-i18n="ranking14">Classificação: 14.º</div>
                    <div class="resultado-prova" data-i18n="seixal10k">10 km São Silvestre Seixal</div>
                    <div class="resultado-tempo">35:59</div>
                </div>
            </div>

            <div class="link-resultados reveal-page">
                <a href="provas.php" data-i18n="seeAllCompetitions">Ver todas as competições →</a>
            </div>
        </div>
    </section>
</main>

<script>
window.pageTranslations = {
    pt: {
        pageTitle: "Página Principal | Lone Wolf",
        heroPhrase: "Cada quilómetro conta uma história. Cada meta é um novo começo.",
        historyBtn: "A Minha História",
        partnersBtn: "Parceiros",
        exploreTitle: "Explorar",
        exploreSubtitle: "História, treinos, parceiros e mais sobre o projeto Lone Wolf",
        exploreHistory: "A jornada, os desafios e a evolução do atleta.",
        exploreTraining: "Treinos",
        exploreTrainingText: "Rotina, preparação e método de trabalho.",
        explorePartners: "Marcas e apoios que fazem parte desta caminhada.",
        latestResultsTitle: "Últimos Resultados",
        latestResultsSubtitle: "Provas recentes e conquistas",
        ranking11: "Classificação: 11.º",
        ranking1: "Classificação: 1.º",
        ranking14: "Classificação: 14.º",
        portoMarathon: "Maratona do Porto",
        lagosHalf: "Meia Internacional de Lagos",
        seixal10k: "10 km São Silvestre Seixal",
        seeAllCompetitions: "Ver todas as competições →"
    },
    en: {
        pageTitle: "Home | Lone Wolf",
        heroPhrase: "Every kilometre tells a story. Every finish line is a new beginning.",
        historyBtn: "My Story",
        partnersBtn: "Partners",
        exploreTitle: "Explore",
        exploreSubtitle: "History, training, partners and more about the Lone Wolf project",
        exploreHistory: "The journey, challenges and evolution of the athlete.",
        exploreTraining: "Training",
        exploreTrainingText: "Routine, preparation and training method.",
        explorePartners: "Brands and supporters that are part of this path.",
        latestResultsTitle: "Latest Results",
        latestResultsSubtitle: "Recent races and achievements",
        ranking11: "Ranking: 11th",
        ranking1: "Ranking: 1st",
        ranking14: "Ranking: 14th",
        portoMarathon: "Porto Marathon",
        lagosHalf: "Lagos International Half Marathon",
        seixal10k: "10 km São Silvestre Seixal",
        seeAllCompetitions: "See all competitions →"
    }
};
</script>

<?php include "footer.php"; ?>

</body>
</html>
