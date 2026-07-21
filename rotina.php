

<?php
require_once "includes/init.php";

$pageTitle = 'Treinos | Lone Wolf';
$bodyClass = 'content-page';
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="rotina-page-main">
<section class="hero-rotina">
    <div class="hero-conteudo reveal-page">
        <div class="hero-mini" data-i18n="heroMini">Rui Bastos</div>

        <h1 data-i18n="heroTitle">Treinos</h1>

        <p class="hero-frase" data-i18n="heroPhrase">
            Disciplina, consistência e preparação para superar limites.
        </p>
    </div>
</section>

<section class="page-section rotina-page">
    <div class="container">

        <section class="intro-rotina">
            <div class="intro-imagem reveal-page">
                <img src="IMAGENS/EU_PAI.png"
                     alt="Foto do atleta em treino"
                     data-i18n-alt="trainingPhotoAlt">
            </div>

            <div class="intro-texto reveal-page">
                <h2 data-i18n="philosophyTitle">Filosofia de Treino</h2>

                <div class="linha-laranja"></div>

                <p data-i18n="philosophyDesc">
                    A preparação é baseada na consistência, no controlo do ritmo, no aumento da resistência aeróbica e na recuperação adequada.
                </p>

                <p data-i18n="philosophyDesc2">
                    O objetivo é criar uma base física forte para que o corpo esteja equilibrado, resistente e preparado para a distância de maratona.
                </p>

                <div class="destaque-treino reveal-page">
                    <p data-i18n="trainingGoalText1">
                        O objetivo dos treinos é treinar sempre mais lento, cerca de 1 minuto mais lento do pace realizado em competição.
                    </p>

                    <p data-i18n="trainingGoalText2">
                        Isto permite criar um volume significativo de resistência aeróbica, baixar o ritmo cardíaco e manter o corpo preparado para competir.
                    </p>
                </div>
            </div>
        </section>

        <section class="plano-semanal">
            <div class="titulo-plano reveal-page">
                <h2 data-i18n="weeklyPlan">Plano de Treino</h2>

                <div class="linha-laranja"></div>

                <p data-i18n="weeklyDesc">
                    Plano semanal de preparação para maratona
                </p>
                <a href="download-plano-treino.php" class="btn-principal" download data-i18n="downloadPlanBtn">
                    <i class="fa-solid fa-download"></i> Descarregar Plano
                </a>
            </div>

            <div class="lista-plano">

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="monday">Segunda-feira</span>
                        <div class="treino" data-i18n="mondayTraining">Treino de recuperação, 35 minutos de corrida leve/lenta e 30 minutos de exercícios de alongamentos.</div>
                    </div>
                    <span class="etiqueta" data-i18n="recoveryTag">Recuperação</span>
                </div>

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="tuesday">Terça-feira</span>
                        <div class="treino" data-i18n="tuesdayTraining">1h15m de corrida com Pace 4'35/km - 4'45/km<br>Alongamentos no final</div>
                    </div>
                    <span class="etiqueta" data-i18n="paceTag">Pace</span>
                </div>

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="wednesday">Quarta-feira</span>
                        <div class="treino" data-i18n="wednesdayTraining">1h15m de corrida com Pace 4'35/km - 4'45/km<br>Alongamentos no final</div>
                    </div>
                    <span class="etiqueta" data-i18n="paceTag">Pace</span>
                </div>

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="thursday">Quinta-feira</span>
                        <div class="treino" data-i18n="thursdayTraining">Descanso total<br>Exercícios de mobilidade e fortalecimento<br>Sessão de massagem de recuperação muscular</div>
                    </div>
                    <span class="etiqueta" data-i18n="totalRestTag">Descanso Total</span>
                </div>

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="friday">Sexta-feira</span>
                        <div class="treino" data-i18n="fridayTraining">1h15m de corrida com Pace 4'35/km - 4'45/km<br>Alongamentos no final</div>
                    </div>
                    <span class="etiqueta" data-i18n="paceTag">Pace</span>
                </div>

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="saturday">Sábado</span>
                        <div class="treino" data-i18n="saturdayTraining">50 minutos de corrida com Pace 4'35/km - 4'45/km<br>Alongamentos no final</div>
                    </div>
                    <span class="etiqueta" data-i18n="paceTag">Pace</span>
                </div>

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="sunday">Domingo</span>
                        <div class="treino" data-i18n="sundayTraining">Treino longo<br>1h35m de corrida com Pace 4'35/km - 4'45/km<br>Alongamentos no final</div>
                    </div>
                    <span class="etiqueta" data-i18n="longRunTag">Treino Longo</span>
                </div>

            </div>
        </section>

        <section class="plano-semanal plano-competicao">
            <div class="titulo-plano reveal-page">
                <h2 data-i18n="competitionWeekTitle">
                    Semana Anterior à Competição
                </h2>

                <div class="linha-laranja"></div>

                <p data-i18n="competitionWeekDesc">
                    Plano de redução de carga antes da prova
                </p>
            </div>

            <div class="lista-plano">

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="monday">Segunda-feira</span>
                        <div class="treino" data-i18n="competitionMondayTraining">Treino de recuperação, 35 minutos de corrida leve/lenta e 30 minutos de exercícios de alongamentos no final.</div>
                    </div>
                    <span class="etiqueta" data-i18n="recoveryTag">Recuperação</span>
                </div>

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="tuesday">Terça-feira</span>
                        <div class="treino" data-i18n="competitionTuesdayTraining">35 minutos de corrida com Pace 4'45/km - 5'05/km<br>Alongamentos no final</div>
                    </div>
                    <span class="etiqueta" data-i18n="paceTag">Pace</span>
                </div>

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="wednesday">Quarta-feira</span>
                        <div class="treino" data-i18n="competitionWednesdayTraining">35 minutos de corrida com Pace 4'45/km - 5'05/km<br>Alongamentos no final</div>
                    </div>
                    <span class="etiqueta" data-i18n="paceTag">Pace</span>
                </div>

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="thursday">Quinta-feira</span>
                        <div class="treino" data-i18n="competitionThursdayTraining">35 minutos de corrida com Pace 4'45/km - 5'05/km<br>Alongamentos no final</div>
                    </div>
                    <span class="etiqueta" data-i18n="paceTag">Pace</span>
                </div>

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="friday">Sexta-feira</span>
                        <div class="treino" data-i18n="competitionFridayTraining">35 minutos de corrida com Pace 4'45/km - 5'05/km<br>Alongamentos no final</div>
                    </div>
                    <span class="etiqueta" data-i18n="paceTag">Pace</span>
                </div>

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="saturday">Sábado</span>
                        <div class="treino" data-i18n="competitionSaturdayTraining">Descanso total<br>Exercícios de mobilidade e fortalecimento</div>
                    </div>
                    <span class="etiqueta" data-i18n="totalRestTag">Descanso Total</span>
                </div>

                <div class="item-plano reveal-page">
                    <div class="info-plano">
                        <span class="dia" data-i18n="sunday">Domingo</span>
                        <div class="treino" data-i18n="competitionSundayTraining">Prova — arriscar tudo</div>
                    </div>
                    <span class="etiqueta" data-i18n="raceTag">Prova</span>
                </div>

            </div>

            <div class="nota-plano reveal-page">
                <h3 data-i18n="trainingGoalTitle">Objetivo da Preparação</h3>

                <p data-i18n="trainingGoalText3">
                    Estes fatores são fundamentais para que o corpo se encontre equilibrado e resistente para a distância de maratona.
                </p>

                <p data-i18n="trainingGoalText4">
                    Na preparação de maratona são realizadas 2 meias-maratonas e 4 provas de 10 km, permitindo manter os níveis competitivos elevados e ritmos altos no pace.
                </p>
            </div>
        </section>

        <section class="plano-semanal plano-pos-maratona">
            <div class="titulo-plano reveal-page">
                <h2 data-i18n="postMarathonTitle">Depois de uma Maratona</h2>

                <div class="linha-laranja"></div>

                <p data-i18n="postMarathonSubtitle">
                    Recuperação, descanso e regresso gradual ao treino
                </p>
            </div>

            <div class="nota-plano reveal-page">
                <h3 data-i18n="postMarathonBoxTitle">Recuperação Pós-Maratona</h3>

                <p data-i18n="postMarathonText1">
                    Após uma maratona, é feito descanso total durante 4 dias. Num desses dias é realizada uma massagem de recuperação muscular.
                </p>

                <p data-i18n="postMarathonText2">
                    Depois desse período, o atleta retoma progressivamente o treino normal.
                </p>

                <p data-i18n="postMarathonText3">
                    Para um atleta com objetivos de tempos ou classificação, o rigor no cumprimento de um plano de treino é muito importante.
                </p>

                <p data-i18n="postMarathonText4">
                    Não existem resultados sem sacrifício.
                </p>
            </div>
        </section>

    </div>
</section>
</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Treinos | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Treinos",
        heroPhrase: "Disciplina, consistência e preparação para superar limites.",
        trainingPhotoAlt: "Foto do atleta em treino",

        philosophyTitle: "Filosofia de Treino",
        philosophyDesc: "A preparação é baseada na consistência, no controlo do ritmo, no aumento da resistência aeróbica e na recuperação adequada.",
        philosophyDesc2: "O objetivo é criar uma base física forte para que o corpo esteja equilibrado, resistente e preparado para a distância de maratona.",

        weeklyPlan: "Plano de Treino",
        weeklyDesc: "Plano semanal de preparação para maratona",
        downloadPlanBtn: "Descarregar Plano",

        monday: "Segunda-feira",
        tuesday: "Terça-feira",
        wednesday: "Quarta-feira",
        thursday: "Quinta-feira",
        friday: "Sexta-feira",
        saturday: "Sábado",
        sunday: "Domingo",

        mondayTraining: "Treino de recuperação, 35 minutos de corrida leve/lenta e 30 minutos de exercícios de alongamentos.",
        tuesdayTraining: "1h15m de corrida com Pace 4'35/km - 4'45/km<br>Alongamentos no final",
        wednesdayTraining: "1h15m de corrida com Pace 4'35/km - 4'45/km<br>Alongamentos no final",
        thursdayTraining: "Descanso total<br>Exercícios de mobilidade e fortalecimento<br>Sessão de massagem de recuperação muscular",
        fridayTraining: "1h15m de corrida com Pace 4'35/km - 4'45/km<br>Alongamentos no final",
        saturdayTraining: "50 minutos de corrida com Pace 4'35/km - 4'45/km<br>Alongamentos no final",
        sundayTraining: "Treino longo<br>1h35m de corrida com Pace 4'35/km - 4'45/km<br>Alongamentos no final",

        competitionWeekTitle: "Semana Anterior à Competição",
        competitionWeekDesc: "Plano de redução de carga antes da prova",
        competitionMondayTraining: "Treino de recuperação, 35 minutos de corrida leve/lenta e 30 minutos de exercícios de alongamentos no final.",
        competitionTuesdayTraining: "35 minutos de corrida com Pace 4'45/km - 5'05/km<br>Alongamentos no final",
        competitionWednesdayTraining: "35 minutos de corrida com Pace 4'45/km - 5'05/km<br>Alongamentos no final",
        competitionThursdayTraining: "35 minutos de corrida com Pace 4'45/km - 5'05/km<br>Alongamentos no final",
        competitionFridayTraining: "35 minutos de corrida com Pace 4'45/km - 5'05/km<br>Alongamentos no final",
        competitionSaturdayTraining: "Descanso total<br>Exercícios de mobilidade e fortalecimento",
        competitionSundayTraining: "Prova — arriscar tudo",

        trainingGoalTitle: "Objetivo da Preparação",
        trainingGoalText1: "O objetivo dos treinos é treinar sempre mais lento, cerca de 1 minuto mais lento do pace realizado em competição.",
        trainingGoalText2: "Isto permite criar um volume significativo de resistência aeróbica, baixar o ritmo cardíaco e manter o corpo preparado para competir.",
        trainingGoalText3: "Estes fatores são fundamentais para que o corpo se encontre equilibrado e resistente para a distância de maratona.",
        trainingGoalText4: "Na preparação de maratona são realizadas 2 meias-maratonas e 4 provas de 10 km, permitindo manter os níveis competitivos elevados e ritmos altos no pace.",

        postMarathonTitle: "Depois de uma Maratona",
        postMarathonSubtitle: "Recuperação, descanso e regresso gradual ao treino",
        postMarathonBoxTitle: "Recuperação Pós-Maratona",
        postMarathonText1: "Após uma maratona, é feito descanso total durante 4 dias. Num desses dias é realizada uma massagem de recuperação muscular.",
        postMarathonText2: "Depois desse período, o atleta retoma progressivamente o treino normal.",
        postMarathonText3: "Para um atleta com objetivos de tempos ou classificação, o rigor no cumprimento de um plano de treino é muito importante.",
        postMarathonText4: "Não existem resultados sem sacrifício.",

        recoveryTag: "Recuperação",
        paceTag: "Pace",
        restTag: "Descanso",
        longRunTag: "Treino Longo",
        totalRestTag: "Descanso Total",
        raceTag: "Prova"
    },

    en: {
        pageTitle: "Training | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Training",
        heroPhrase: "Discipline, consistency and preparation to overcome limits.",
        trainingPhotoAlt: "Photo of the athlete training",

        philosophyTitle: "Training Philosophy",
        philosophyDesc: "Preparation is based on consistency, pace control, aerobic endurance development and proper recovery.",
        philosophyDesc2: "The goal is to build a strong physical base so the body is balanced, resistant and prepared for the marathon distance.",

        weeklyPlan: "Training Plan",
        weeklyDesc: "Weekly marathon preparation plan",
        downloadPlanBtn: "Download Plan",

        monday: "Monday",
        tuesday: "Tuesday",
        wednesday: "Wednesday",
        thursday: "Thursday",
        friday: "Friday",
        saturday: "Saturday",
        sunday: "Sunday",

        mondayTraining: "Recovery session, 35 minutes easy/slow run and 30 minutes of stretching exercises.",
        tuesdayTraining: "1h15m run at 4'35/km - 4'45/km pace<br>Stretching afterwards",
        wednesdayTraining: "1h15m run at 4'35/km - 4'45/km pace<br>Stretching afterwards",
        thursdayTraining: "Total rest<br>Mobility and strengthening exercises<br>Muscle recovery massage session",
        fridayTraining: "1h15m run at 4'35/km - 4'45/km pace<br>Stretching afterwards",
        saturdayTraining: "50 minutes run at 4'35/km - 4'45/km pace<br>Stretching afterwards",
        sundayTraining: "Long run<br>1h35m run at 4'35/km - 4'45/km pace<br>Stretching afterwards",

        competitionWeekTitle: "Week Before Competition",
        competitionWeekDesc: "Reduced training load plan before race day",
        competitionMondayTraining: "Recovery session, 35 minutes easy/slow run and 30 minutes of stretching exercises afterwards.",
        competitionTuesdayTraining: "35 minutes run at 4'45/km - 5'05/km pace<br>Stretching afterwards",
        competitionWednesdayTraining: "35 minutes run at 4'45/km - 5'05/km pace<br>Stretching afterwards",
        competitionThursdayTraining: "35 minutes run at 4'45/km - 5'05/km pace<br>Stretching afterwards",
        competitionFridayTraining: "35 minutes run at 4'45/km - 5'05/km pace<br>Stretching afterwards",
        competitionSaturdayTraining: "Total rest<br>Mobility and strengthening exercises",
        competitionSundayTraining: "Race day — risk everything",

        trainingGoalTitle: "Preparation Goal",
        trainingGoalText1: "The goal of training is to always train slower, around 1 minute slower than the pace used in competition.",
        trainingGoalText2: "This helps build significant aerobic endurance, lower heart rate and keep the body prepared to compete.",
        trainingGoalText3: "These factors are essential for the body to remain balanced and resistant for the marathon distance.",
        trainingGoalText4: "During marathon preparation, 2 half marathons and 4 races over 10 km are completed, helping maintain high competitive levels and strong pace rhythm.",

        postMarathonTitle: "After a Marathon",
        postMarathonSubtitle: "Recovery, rest and gradual return to training",
        postMarathonBoxTitle: "Post-Marathon Recovery",
        postMarathonText1: "After a marathon, total rest is taken for 4 days. On one of those days, a muscle recovery massage is performed.",
        postMarathonText2: "After that period, the athlete gradually returns to normal training.",
        postMarathonText3: "For an athlete with time or ranking goals, strictly following a training plan is very important.",
        postMarathonText4: "There are no results without sacrifice.",

        recoveryTag: "Recovery",
        paceTag: "Pace",
        restTag: "Rest",
        longRunTag: "Long Run",
        totalRestTag: "Total Rest",
        raceTag: "Race"
    }
};</script>
<?php include "footer.php"; ?>

</body>
</html>
