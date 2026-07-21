<?php
require_once "includes/init.php";

$pageTitle = 'Atleta | Lone Wolf';
$bodyClass = 'content-page';
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="atleta-page-main">
<section class="hero-atleta">
    <div class="hero-conteudo reveal-page">
        <div class="hero-mini" data-i18n="heroMini">Rui Bastos</div>
        <h1 data-i18n="heroTitle">Atleta</h1>
        <p class="hero-frase" data-i18n="heroPhrase">Disciplina, resistência e mentalidade de lobo solitário.</p>
    </div>
</section>

<section class="page-section atleta-page">
    <div class="container">

        <section class="intro-atleta">
            <div class="intro-imagem reveal-page">
                <img src="IMAGENS/PAI_3.jpeg" alt="Foto do atleta Rui Bastos" data-i18n-alt="athletePhotoAlt">
            </div>

            <div class="intro-texto reveal-page">
                <h2 data-i18n="statsTitle">Estatísticas</h2>
                <div class="linha-laranja"></div>

                <div class="stats-grid">
                    <div class="stat-card reveal-page">
                        <div class="stat-valor">35:59</div>
                        <div class="stat-label" data-i18n="best10k">Melhor 10 km</div>
                    </div>

                    <div class="stat-card reveal-page">
                        <div class="stat-valor">1:21:08</div>
                        <div class="stat-label" data-i18n="bestHalfMarathon">Melhor meia-maratona</div>
                    </div>

                    <div class="stat-card reveal-page">
                        <div class="stat-valor">2:52:55</div>
                        <div class="stat-label" data-i18n="bestMarathon">Melhor maratona</div>
                    </div>

                    <div class="stat-card reveal-page">
                        <div class="stat-valor">120 km</div>
                        <div class="stat-label" data-i18n="weeklyVolume">Volume semanal</div>
                    </div>

                    <div class="stat-card reveal-page">
                        <div class="stat-valor">12</div>
                        <div class="stat-label" data-i18n="wins">Vitórias</div>
                    </div>

                    <div class="stat-card reveal-page">
                        <div class="stat-valor">10+</div>
                        <div class="stat-label" data-i18n="careerYears">Anos de carreira</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="descricao-atleta reveal-page">
            <p data-i18n="desc1">Rui Bastos representa o espírito Lone Wolf: foco, consistência e capacidade de sofrer em silêncio até chegar ao objetivo.</p>
            <p data-i18n="desc2">Cada treino, cada prova e cada marca refletem uma mentalidade construída com disciplina, ambição e paixão pela corrida.</p>
        </section>

    </div>
</section>
</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Atleta | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Atleta",
        heroPhrase: "Disciplina, resistência e mentalidade de lobo solitário.",
        athletePhotoAlt: "Foto do atleta Rui Bastos",
        statsTitle: "Estatísticas",
        best10k: "Melhor 10 km",
        bestHalfMarathon: "Melhor meia-maratona",
        bestMarathon: "Melhor maratona",
        weeklyVolume: "Volume semanal",
        wins: "Vitórias",
        careerYears: "Anos de carreira",
        desc1: "Rui Bastos representa o espírito Lone Wolf: foco, consistência e capacidade de sofrer em silêncio até chegar ao objetivo.",
        desc2: "Cada treino, cada prova e cada marca refletem uma mentalidade construída com disciplina, ambição e paixão pela corrida."
    },
    en: {
        pageTitle: "Athlete | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Athlete",
        heroPhrase: "Discipline, endurance and a lone wolf mindset.",
        athletePhotoAlt: "Photo of athlete Rui Bastos",
        statsTitle: "Statistics",
        best10k: "Best 10 km",
        bestHalfMarathon: "Best half marathon",
        bestMarathon: "Best marathon",
        weeklyVolume: "Weekly volume",
        wins: "Wins",
        careerYears: "Years of career",
        desc1: "Rui Bastos represents the Lone Wolf spirit: focus, consistency and the ability to suffer in silence until reaching the goal.",
        desc2: "Every training session, every race and every record reflect a mindset built with discipline, ambition and passion for running."
    }
};</script>
<?php include "footer.php"; ?>

</body>
</html>
