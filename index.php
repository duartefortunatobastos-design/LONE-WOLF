<?php
require_once "includes/init.php";

$pageTitle = "Página Principal | Lone Wolf";
$pageDescription = "Website oficial do atleta Rui Bastos — Lone Wolf. Trail running, ultra trail, competições e loja.";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main>
    <section class="hero-home" id="inicio">
        <div class="hero-conteudo reveal-page">
            <h1>LONE <span class="destaque">WOLF</span></h1>
            <p data-i18n="heroPhrase">
                Cada quilómetro conta uma história. Cada meta é um novo começo.
            </p>
        </div>
    </section>

    <section class="ds-section home-explore" id="explorar">
        <div class="ds-container">
            <header class="home-block-head reveal-page">
                <h2 class="ds-title" data-i18n="exploreTitle">Explorar</h2>
                <p class="ds-text" data-i18n="exploreSubtitle">História, treinos, parceiros e mais sobre o projeto Lone Wolf</p>
            </header>

            <div class="home-explore-grid">
                <a href="historia.php" class="home-explore-card home-explore-card--brand reveal-page">
                    <img src="IMAGENS/logo_historia.png" alt="A Minha História — Lone Wolf" class="home-explore-card-media" loading="lazy">
                    <span class="home-explore-card-shade" aria-hidden="true"></span>
                    <span class="home-explore-card-copy">
                        <span class="ds-title home-explore-card-title" data-i18n="historyBtn">A Minha História</span>
                        <span class="home-explore-card-text" data-i18n="exploreHistory">A jornada, os desafios e a evolução do atleta.</span>
                    </span>
                </a>

                <a href="rotina.php" class="home-explore-card home-explore-card--brand reveal-page">
                    <img src="IMAGENS/logo_treinos.png" alt="Treinos Lone Wolf" class="home-explore-card-media" loading="lazy">
                    <span class="home-explore-card-shade" aria-hidden="true"></span>
                    <span class="home-explore-card-copy">
                        <span class="ds-title home-explore-card-title" data-i18n="exploreTraining">Treinos</span>
                        <span class="home-explore-card-text" data-i18n="exploreTrainingText">Rotina, preparação e método de trabalho.</span>
                    </span>
                </a>

                <a href="patrocinadores.php" class="home-explore-card home-explore-card--brand reveal-page">
                    <img src="IMAGENS/logo_parceiros.png" alt="Parceiros Lone Wolf" class="home-explore-card-media" loading="lazy">
                    <span class="home-explore-card-shade" aria-hidden="true"></span>
                    <span class="home-explore-card-copy">
                        <span class="ds-title home-explore-card-title" data-i18n="partnersBtn">Parceiros</span>
                        <span class="home-explore-card-text" data-i18n="explorePartners">Marcas e apoios que fazem parte desta caminhada.</span>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <section class="ds-section ds-section--alt home-results">
        <div class="ds-container">
            <header class="home-block-head reveal-page">
                <h2 class="ds-title" data-i18n="latestResultsTitle">Últimos Resultados</h2>
                <p class="ds-text" data-i18n="latestResultsSubtitle">Provas recentes e conquistas</p>
            </header>

            <div class="home-results-grid">
                <article class="home-result-card reveal-page">
                    <div class="home-result-meta">
                        <span class="home-result-badge" data-i18n="ranking11">11.º Lugar</span>
                        <span class="home-result-date" data-i18n="portoDate">Nov 2025</span>
                    </div>
                    <h3 class="home-result-name" data-i18n="portoMarathon">Maratona do Porto</h3>
                    <p class="ds-stat home-result-time">02:52:55</p>
                </article>

                <article class="home-result-card home-result-card--win reveal-page">
                    <div class="home-result-meta">
                        <span class="home-result-badge home-result-badge--gold" data-i18n="ranking1">1.º Lugar</span>
                        <span class="home-result-date" data-i18n="lagosDate">Nov 2025</span>
                    </div>
                    <h3 class="home-result-name" data-i18n="lagosHalf">Meia Internacional de Lagos</h3>
                    <p class="ds-stat home-result-time">01:21:45</p>
                </article>

                <article class="home-result-card reveal-page">
                    <div class="home-result-meta">
                        <span class="home-result-badge" data-i18n="ranking14">14.º Lugar</span>
                        <span class="home-result-date" data-i18n="seixalDate">Dez 2025</span>
                    </div>
                    <h3 class="home-result-name" data-i18n="seixal10k">10 km São Silvestre Seixal</h3>
                    <p class="ds-stat home-result-time">35:59</p>
                </article>
            </div>

            <div class="home-results-link reveal-page">
                <a href="provas.php" class="ds-btn ds-btn-secondary" data-i18n="seeAllCompetitions">Ver todas as competições</a>
            </div>
        </div>
    </section>

    <section class="ds-section home-collab">
        <div class="ds-container home-collab-inner reveal-page">
            <h2 class="ds-title" data-i18n="collabTitle">Interessado em colaborar?</h2>
            <p class="ds-text" data-i18n="collabText">Patrocínio, imprensa e parcerias com o projecto Lone Wolf.</p>
            <a href="contatos.php" class="ds-btn ds-btn-primary" data-i18n="collabCta">Contactar</a>
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
        ranking11: "11.º Lugar",
        ranking1: "1.º Lugar",
        ranking14: "14.º Lugar",
        portoMarathon: "Maratona do Porto",
        portoDate: "Nov 2025",
        lagosHalf: "Meia Internacional de Lagos",
        lagosDate: "Nov 2025",
        seixal10k: "10 km São Silvestre Seixal",
        seixalDate: "Dez 2025",
        seeAllCompetitions: "Ver todas as competições",
        collabTitle: "Interessado em colaborar?",
        collabText: "Patrocínio, imprensa e parcerias com o projecto Lone Wolf.",
        collabCta: "Contactar"
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
        ranking11: "11th Place",
        ranking1: "1st Place",
        ranking14: "14th Place",
        portoMarathon: "Porto Marathon",
        portoDate: "Nov 2025",
        lagosHalf: "Lagos International Half Marathon",
        lagosDate: "Nov 2025",
        seixal10k: "10 km São Silvestre Seixal",
        seixalDate: "Dec 2025",
        seeAllCompetitions: "See all competitions",
        collabTitle: "Interested in collaborating?",
        collabText: "Sponsorship, press and partnerships with the Lone Wolf project.",
        collabCta: "Contact"
    }
};
</script>

<?php include "footer.php"; ?>

</body>
</html>
