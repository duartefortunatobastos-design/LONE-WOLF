<?php
require_once "includes/init.php";

$pageTitle = 'Treinos | Lone Wolf';
$pageDescription = 'Rotina de treino de Rui Bastos — Lone Wolf. Volume, pace e recuperação.';
$bodyClass = 'content-page';
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="train-page">
    <section class="hero-rotina">
        <div class="hero-conteudo reveal-page">
            <div class="hero-mini" data-i18n="heroMini">Rui Bastos</div>
            <h1 data-i18n="heroTitle">Treinos</h1>
            <p class="hero-frase" data-i18n="heroPhrase">
                Disciplina, consistência e preparação para superar limites.
            </p>
        </div>
    </section>

    <section class="ds-section">
        <div class="ds-container train-philosophy">
            <h2 class="ds-title reveal-page" data-i18n="philosophyTitle">Filosofia</h2>
            <p class="ds-text reveal-page" data-i18n="philosophyDesc">Consistência. Ritmo controlado. Recuperação a sério. Treinar cerca de 1 minuto mais lento do que o pace de prova para construir aeróbica e baixar o pulso.</p>
            <div class="train-volume reveal-page">
                <span class="ds-stat train-volume-value">120 km</span>
                <span class="athlete-stat-label" data-i18n="weeklyVolume">Volume semanal</span>
            </div>
        </div>
    </section>

    <section class="ds-section ds-section--alt">
        <div class="ds-container">
            <header class="home-block-head reveal-page">
                <h2 class="ds-title" data-i18n="typesTitle">Tipos de treino</h2>
            </header>
            <div class="train-types">
                <article class="train-type-card reveal-page">
                    <i class="fa-solid fa-person-running" aria-hidden="true"></i>
                    <h3 data-i18n="typeEasy">Rodagem</h3>
                    <p class="ds-text" data-i18n="typeEasyText">Volume fácil. O corpo aprende a durar.</p>
                </article>
                <article class="train-type-card reveal-page">
                    <i class="fa-solid fa-gauge-high" aria-hidden="true"></i>
                    <h3 data-i18n="typePace">Pace</h3>
                    <p class="ds-text" data-i18n="typePaceText">4'35–4'45/km. Trabalho, não teatro.</p>
                </article>
                <article class="train-type-card reveal-page">
                    <i class="fa-solid fa-mountain" aria-hidden="true"></i>
                    <h3 data-i18n="typeLong">Longo</h3>
                    <p class="ds-text" data-i18n="typeLongText">O domingo manda. Distância e cabeça.</p>
                </article>
                <article class="train-type-card reveal-page">
                    <i class="fa-solid fa-dumbbell" aria-hidden="true"></i>
                    <h3 data-i18n="typeGym">Força</h3>
                    <p class="ds-text" data-i18n="typeGymText">Mobilidade, ginásio, massagem. O corpo tem de aguentar.</p>
                </article>
                <article class="train-type-card reveal-page">
                    <i class="fa-solid fa-moon" aria-hidden="true"></i>
                    <h3 data-i18n="typeRest">Descanso</h3>
                    <p class="ds-text" data-i18n="typeRestText">Parar também é treino. Quinta é sagrada.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="ds-section">
        <div class="ds-container">
            <header class="home-block-head reveal-page">
                <h2 class="ds-title" data-i18n="weeklyPlan">Semana tipo</h2>
                <p class="ds-text" data-i18n="weeklyDesc">Preparação de maratona. Pace de treino abaixo do de prova.</p>
                <a href="download-plano-treino.php" class="ds-btn ds-btn-primary" download data-i18n="downloadPlanBtn">Descarregar plano</a>
            </header>

            <div class="train-week reveal-page">
                <article class="train-cell">
                    <span class="train-day" data-i18n="monShort">Seg</span>
                    <span class="train-kind" data-i18n="recoveryTag">Recuperação</span>
                    <span class="ds-stat train-num">35 min</span>
                </article>
                <article class="train-cell">
                    <span class="train-day" data-i18n="tueShort">Ter</span>
                    <span class="train-kind" data-i18n="paceTag">Pace</span>
                    <span class="ds-stat train-num">1h15</span>
                </article>
                <article class="train-cell">
                    <span class="train-day" data-i18n="wedShort">Qua</span>
                    <span class="train-kind" data-i18n="paceTag">Pace</span>
                    <span class="ds-stat train-num">1h15</span>
                </article>
                <article class="train-cell train-cell--rest">
                    <span class="train-day" data-i18n="thuShort">Qui</span>
                    <span class="train-kind" data-i18n="totalRestTag">Descanso</span>
                    <span class="ds-stat train-num">0 km</span>
                </article>
                <article class="train-cell">
                    <span class="train-day" data-i18n="friShort">Sex</span>
                    <span class="train-kind" data-i18n="paceTag">Pace</span>
                    <span class="ds-stat train-num">1h15</span>
                </article>
                <article class="train-cell">
                    <span class="train-day" data-i18n="satShort">Sáb</span>
                    <span class="train-kind" data-i18n="paceTag">Pace</span>
                    <span class="ds-stat train-num">50 min</span>
                </article>
                <article class="train-cell train-cell--long">
                    <span class="train-day" data-i18n="sunShort">Dom</span>
                    <span class="train-kind" data-i18n="longRunTag">Longo</span>
                    <span class="ds-stat train-num">1h35</span>
                </article>
            </div>

            <header class="home-block-head train-week-head reveal-page">
                <h2 class="ds-title" data-i18n="competitionWeekTitle">Semana de prova</h2>
                <p class="ds-text" data-i18n="competitionWeekDesc">Carga a descer. Domingo: arriscar tudo.</p>
            </header>

            <div class="train-week reveal-page">
                <article class="train-cell">
                    <span class="train-day" data-i18n="monShort">Seg</span>
                    <span class="train-kind" data-i18n="recoveryTag">Recuperação</span>
                    <span class="ds-stat train-num">35 min</span>
                </article>
                <article class="train-cell">
                    <span class="train-day" data-i18n="tueShort">Ter</span>
                    <span class="train-kind" data-i18n="paceTag">Pace</span>
                    <span class="ds-stat train-num">35 min</span>
                </article>
                <article class="train-cell">
                    <span class="train-day" data-i18n="wedShort">Qua</span>
                    <span class="train-kind" data-i18n="paceTag">Pace</span>
                    <span class="ds-stat train-num">35 min</span>
                </article>
                <article class="train-cell">
                    <span class="train-day" data-i18n="thuShort">Qui</span>
                    <span class="train-kind" data-i18n="paceTag">Pace</span>
                    <span class="ds-stat train-num">35 min</span>
                </article>
                <article class="train-cell">
                    <span class="train-day" data-i18n="friShort">Sex</span>
                    <span class="train-kind" data-i18n="paceTag">Pace</span>
                    <span class="ds-stat train-num">35 min</span>
                </article>
                <article class="train-cell train-cell--rest">
                    <span class="train-day" data-i18n="satShort">Sáb</span>
                    <span class="train-kind" data-i18n="totalRestTag">Descanso</span>
                    <span class="ds-stat train-num">0 km</span>
                </article>
                <article class="train-cell train-cell--race">
                    <span class="train-day" data-i18n="sunShort">Dom</span>
                    <span class="train-kind" data-i18n="raceTag">Prova</span>
                    <span class="ds-stat train-num">Race</span>
                </article>
            </div>
        </div>
    </section>

    <section class="ds-section ds-section--alt">
        <div class="ds-container train-note">
            <h2 class="ds-title reveal-page" data-i18n="postMarathonBoxTitle">Depois da maratona</h2>
            <p class="ds-text reveal-page" data-i18n="postMarathonText1">Quatro dias a zeros. Um deles com massagem. Depois, regresso lento ao plano.</p>
            <p class="ds-text reveal-page" data-i18n="postMarathonText4">Não há resultado sem sacrifício.</p>
            <a href="patrocinadores.php" class="ds-btn ds-btn-secondary" data-i18n="gearCta">Equipamento e parceiros</a>
        </div>
    </section>
</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Treinos | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Treinos",
        heroPhrase: "Disciplina, consistência e preparação para superar limites.",
        philosophyTitle: "Filosofia",
        philosophyDesc: "Consistência. Ritmo controlado. Recuperação a sério. Treinar cerca de 1 minuto mais lento do que o pace de prova para construir aeróbica e baixar o pulso.",
        weeklyVolume: "Volume semanal",
        typesTitle: "Tipos de treino",
        typeEasy: "Rodagem",
        typeEasyText: "Volume fácil. O corpo aprende a durar.",
        typePace: "Pace",
        typePaceText: "4'35–4'45/km. Trabalho, não teatro.",
        typeLong: "Longo",
        typeLongText: "O domingo manda. Distância e cabeça.",
        typeGym: "Força",
        typeGymText: "Mobilidade, ginásio, massagem. O corpo tem de aguentar.",
        typeRest: "Descanso",
        typeRestText: "Parar também é treino. Quinta é sagrada.",
        weeklyPlan: "Semana tipo",
        weeklyDesc: "Preparação de maratona. Pace de treino abaixo do de prova.",
        downloadPlanBtn: "Descarregar plano",
        competitionWeekTitle: "Semana de prova",
        competitionWeekDesc: "Carga a descer. Domingo: arriscar tudo.",
        postMarathonBoxTitle: "Depois da maratona",
        postMarathonText1: "Quatro dias a zeros. Um deles com massagem. Depois, regresso lento ao plano.",
        postMarathonText4: "Não há resultado sem sacrifício.",
        gearCta: "Equipamento e parceiros",
        monShort: "Seg", tueShort: "Ter", wedShort: "Qua", thuShort: "Qui", friShort: "Sex", satShort: "Sáb", sunShort: "Dom",
        recoveryTag: "Recuperação", paceTag: "Pace", totalRestTag: "Descanso", longRunTag: "Longo", raceTag: "Prova"
    },
    en: {
        pageTitle: "Training | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Training",
        heroPhrase: "Discipline, consistency and preparation to overcome limits.",
        philosophyTitle: "Philosophy",
        philosophyDesc: "Consistency. Controlled pace. Real recovery. Train about 1 minute slower than race pace to build aerobic base and drop heart rate.",
        weeklyVolume: "Weekly volume",
        typesTitle: "Session types",
        typeEasy: "Easy run",
        typeEasyText: "Easy volume. The body learns to last.",
        typePace: "Pace",
        typePaceText: "4'35–4'45/km. Work, not theatre.",
        typeLong: "Long run",
        typeLongText: "Sunday decides. Distance and head.",
        typeGym: "Strength",
        typeGymText: "Mobility, gym, massage. The body has to hold.",
        typeRest: "Rest",
        typeRestText: "Stopping is also training. Thursday is sacred.",
        weeklyPlan: "Typical week",
        weeklyDesc: "Marathon prep. Training pace below race pace.",
        downloadPlanBtn: "Download plan",
        competitionWeekTitle: "Race week",
        competitionWeekDesc: "Load coming down. Sunday: risk everything.",
        postMarathonBoxTitle: "After the marathon",
        postMarathonText1: "Four days at zero. One of them with massage. Then a slow return to the plan.",
        postMarathonText4: "No result without sacrifice.",
        gearCta: "Gear and partners",
        monShort: "Mon", tueShort: "Tue", wedShort: "Wed", thuShort: "Thu", friShort: "Fri", satShort: "Sat", sunShort: "Sun",
        recoveryTag: "Recovery", paceTag: "Pace", totalRestTag: "Rest", longRunTag: "Long", raceTag: "Race"
    }
};</script>
<?php include "footer.php"; ?>
</body>
</html>
