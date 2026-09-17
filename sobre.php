<?php
require_once "includes/init.php";

$pageTitle = 'Atleta | Lone Wolf';
$pageDescription = 'Rui Bastos — Lone Wolf. Atleta de trail e ultra trail. Estatísticas, percurso e mentalidade.';
$bodyClass = 'content-page';
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="athlete-page">
    <section class="hero-atleta">
        <div class="hero-conteudo reveal-page">
            <div class="hero-mini" data-i18n="heroMini">Rui Bastos</div>
            <h1 data-i18n="heroTitle">Atleta</h1>
            <p class="hero-frase" data-i18n="heroPhrase">Disciplina, resistência e mentalidade de lobo solitário.</p>
        </div>
    </section>

    <section class="ds-section athlete-bio">
        <div class="ds-container athlete-bio-grid">
            <div class="athlete-bio-photo reveal-page">
                <img src="IMAGENS/PAI_3.jpeg" alt="Rui Bastos, atleta Lone Wolf" data-i18n-alt="athletePhotoAlt">
            </div>
            <div class="athlete-bio-copy reveal-page">
                <h2 class="ds-title" data-i18n="bioTitle">Porquê correr</h2>
                <p class="ds-text" data-i18n="bio1">Há um momento em que a estrada acaba. Fica o trilho, a noite, o quilómetro que ninguém vê.</p>
                <p class="ds-text" data-i18n="bio2">Rui Bastos por aí. Sozinho. Sem atalho e sem plateia.</p>
                <p class="ds-text" data-i18n="bio3">Lone Wolf não é slogan. É método: volume, consistência, e a capacidade de sofrer em silêncio até à meta.</p>
            </div>
        </div>
    </section>

    <section class="ds-section ds-section--alt athlete-stats">
        <div class="ds-container">
            <header class="home-block-head reveal-page">
                <h2 class="ds-title" data-i18n="statsTitle">Estatísticas</h2>
                <p class="ds-text" data-i18n="statsSubtitle">Números que não pedem desculpa.</p>
            </header>

            <div class="athlete-stats-grid">
                <article class="athlete-stat-card reveal-page">
                    <span class="ds-stat athlete-stat-value js-countup" data-count-type="time" data-count-value="35:59">0:00</span>
                    <span class="athlete-stat-label" data-i18n="best10k">Melhor 10 km</span>
                </article>
                <article class="athlete-stat-card reveal-page">
                    <span class="ds-stat athlete-stat-value js-countup" data-count-type="time" data-count-value="1:21:08">0:00:00</span>
                    <span class="athlete-stat-label" data-i18n="bestHalfMarathon">Melhor meia-maratona</span>
                </article>
                <article class="athlete-stat-card reveal-page">
                    <span class="ds-stat athlete-stat-value js-countup" data-count-type="time" data-count-value="2:52:55">0:00:00</span>
                    <span class="athlete-stat-label" data-i18n="bestMarathon">Melhor maratona</span>
                </article>
                <article class="athlete-stat-card reveal-page">
                    <span class="ds-stat athlete-stat-value js-countup" data-count-type="number" data-count-value="120" data-count-suffix=" km">0 km</span>
                    <span class="athlete-stat-label" data-i18n="weeklyVolume">Volume semanal</span>
                </article>
                <article class="athlete-stat-card reveal-page">
                    <span class="ds-stat athlete-stat-value js-countup" data-count-type="number" data-count-value="12">0</span>
                    <span class="athlete-stat-label" data-i18n="wins">Vitórias</span>
                </article>
                <article class="athlete-stat-card reveal-page">
                    <span class="ds-stat athlete-stat-value js-countup" data-count-type="number" data-count-value="40" data-count-suffix="+">0+</span>
                    <span class="athlete-stat-label" data-i18n="careerYears">Anos dedicado ao desporto</span>
                </article>
            </div>
        </div>
    </section>
</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Atleta | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Atleta",
        heroPhrase: "Disciplina, resistência e mentalidade de lobo solitário.",
        athletePhotoAlt: "Rui Bastos, atleta Lone Wolf",
        bioTitle: "Porquê correr",
        bio1: "Há um momento em que a estrada acaba. Fica o trilho, a noite, o quilómetro que ninguém vê.",
        bio2: "Rui Bastos por aí. Sozinho. Sem atalho e sem plateia.",
        bio3: "Lone Wolf não é slogan. É método: volume, consistência, e a capacidade de sofrer em silêncio até à meta.",
        statsTitle: "Estatísticas",
        statsSubtitle: "Números que não pedem desculpa.",
        best10k: "Melhor 10 km",
        bestHalfMarathon: "Melhor meia-maratona",
        bestMarathon: "Melhor maratona",
        weeklyVolume: "Volume semanal",
        wins: "Vitórias",
        careerYears: "Anos dedicado ao desporto"
    },
    en: {
        pageTitle: "Athlete | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Athlete",
        heroPhrase: "Discipline, endurance and a lone wolf mindset.",
        athletePhotoAlt: "Rui Bastos, Lone Wolf athlete",
        bioTitle: "Why he runs",
        bio1: "There is a point where the road ends. What remains is the trail, the night, the kilometre nobody sees.",
        bio2: "That is where Rui Bastos runs. Alone. No shortcut. No crowd.",
        bio3: "Lone Wolf is not a slogan. It is a method: volume, consistency, and the ability to suffer in silence until the line.",
        statsTitle: "Statistics",
        statsSubtitle: "Numbers that do not apologise.",
        best10k: "Best 10 km",
        bestHalfMarathon: "Best half marathon",
        bestMarathon: "Best marathon",
        weeklyVolume: "Weekly volume",
        wins: "Wins",
        careerYears: "Years dedicated to sport"
    }
};</script>
<?php include "footer.php"; ?>

</body>
</html>
