
<?php
require_once "includes/init.php";

$pageTitle = 'História | Lone Wolf';
$bodyClass = 'content-page';
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="historia-page-main">
<section class="hero-historia">
    <div class="hero-conteudo reveal-page">
        <div class="hero-mini" data-i18n="heroMini">Rui Bastos</div>
        <h1 data-i18n="heroTitle">História</h1>
        <p class="hero-frase" data-i18n="heroPhrase">
            Uma jornada construída com disciplina, superação e mentalidade Lone Wolf.
        </p>
    </div>
</section>

    <section class="ds-section ds-section--alt historia-intro">
        <div class="ds-container">
            <article class="intro-historia">
                <div class="intro-imagem reveal-page">
                    <img src="IMAGENS/PAI_4.jpeg" alt="Atleta Lone Wolf" data-i18n-alt="historyPhotoAlt">
                </div>

                <div class="intro-texto reveal-page">
                    <h2 class="ds-title" data-i18n="introTitle">Nascido para correr</h2>

                    <p class="ds-text" data-i18n="introP1">
                        A jornada da Lone Wolf começou com uma paixão real pelo desporto, pela superação e pela vontade constante de evoluir.
                        Cada treino, cada desafio e cada obstáculo ajudaram a construir uma mentalidade focada na disciplina, no trabalho e no progresso diário.
                    </p>

                    <p class="ds-text" data-i18n="introP2">
                        Muito antes de existir a marca, já existia o espírito. Um espírito competitivo, resiliente e determinado, moldado pelo atletismo,
                        pelo futebol, pelo ciclismo e pelo taekwondo. Foi essa base que deu origem a uma identidade forte e autêntica.
                    </p>

                    <p class="ds-text" data-i18n="introP3">
                        Hoje, a Lone Wolf representa mais do que roupa ou imagem. Representa uma forma de estar no desporto e na vida: seguir o próprio caminho,
                        manter o foco e continuar a crescer, mesmo quando ninguém está a ver.
                    </p>
                </div>
            </article>
        </div>
    </section>

    <section class="ds-section athlete-timeline">
        <div class="ds-container">
            <header class="home-block-head reveal-page">
                <h2 class="ds-title" data-i18n="timelineTitle">Percurso</h2>
                <p class="ds-text" data-i18n="timelineSubtitle">Marcos que construíram o lobo.</p>
            </header>

            <ol class="athlete-timeline-list">
                <li class="athlete-timeline-item reveal-page">
                    <span class="athlete-timeline-year">Início</span>
                    <div class="athlete-timeline-body">
                        <h3 class="athlete-timeline-title" data-i18n="t1Title">Atletismo na escola</h3>
                        <p class="ds-text" data-i18n="t1Text">Escola do Fogueteiro. Corta-matos, pista, primeiros pódios. O gosto pela dor útil começou aqui.</p>
                    </div>
                </li>
                <li class="athlete-timeline-item reveal-page">
                    <span class="athlete-timeline-year">Futebol</span>
                    <div class="athlete-timeline-body">
                        <h3 class="athlete-timeline-title" data-i18n="t2Title">Vida de Futebolista</h3>
                        <p class="ds-text" data-i18n="t2Text">Três clubes, AC Arrentela, Amora e Belenenses. Disciplina de balneário. Responsabilidade, Vontade de vencer.</p>
                    </div>
                </li>
                <li class="athlete-timeline-item reveal-page">
                    <span class="athlete-timeline-year">BTT</span>
                    <div class="athlete-timeline-body">
                        <h3 class="athlete-timeline-title" data-i18n="t3Title">Bikes & Aventuras</h3>
                        <p class="ds-text" data-i18n="t3Text">Provas de BTT e estrada. Horas de sela, subidas longas, a mesma lógica: aguentar quando o corpo pede para sair.</p>
                    </div>
                </li>
                <li class="athlete-timeline-item reveal-page">
                    <span class="athlete-timeline-year">2012–2022</span>
                    <div class="athlete-timeline-body">
                        <h3 class="athlete-timeline-title" data-i18n="t4Title">Taekwondo. 1.º Dan.</h3>
                        <p class="ds-text" data-i18n="t4Text">Começou com o filho, Duarte. Uma década. Cinturão negro a 23 de janeiro de 2022. Conhecimento em Defesa Pessoal, Controlo e Precisão.</p>
                    </div>
                </li>
                <li class="athlete-timeline-item reveal-page">
                    <span class="athlete-timeline-year">2023</span>
                    <div class="athlete-timeline-body">
                        <h3 class="athlete-timeline-title" data-i18n="t5Title">Regresso. Primeira Maratona.</h3>
                        <p class="ds-text" data-i18n="t5Text">Estreia em maratona a 23 de abril, na Maratona Internacional de Aveiro. O relógio passou a mandar.</p>
                    </div>
                </li>
                <li class="athlete-timeline-item reveal-page">
                    <span class="athlete-timeline-year">2025</span>
                    <div class="athlete-timeline-body">
                        <h3 class="athlete-timeline-title" data-i18n="t6Title">Recordes à Vista</h3>
                        <p class="ds-text" data-i18n="t6Text">Maratona do Porto em 02:52:55. Meia Internacional de Lagos em Primeiro Lugar. O trabalho ficou visível.</p>
                    </div>
                </li>
            </ol>
        </div>
    </section>
</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "História | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "História",
        heroPhrase: "Uma jornada construída com disciplina, superação e mentalidade Lone Wolf.",
        historyPhotoAlt: "Atleta Lone Wolf",

        introTitle: "Nascido para correr",
        introP1: "A jornada da Lone Wolf começou com uma paixão real pelo desporto, pela superação e pela vontade constante de evoluir. Cada treino, cada desafio e cada obstáculo ajudaram a construir uma mentalidade focada na disciplina, no trabalho e no progresso diário.",
        introP2: "Muito antes de existir a marca, já existia o espírito. Um espírito competitivo, resiliente e determinado, moldado pelo atletismo, pelo futebol, pelo ciclismo e pelo taekwondo. Foi essa base que deu origem a uma identidade forte e autêntica.",
        introP3: "Hoje, a Lone Wolf representa mais do que roupa ou imagem. Representa uma forma de estar no desporto e na vida: seguir o próprio caminho, manter o foco e continuar a crescer, mesmo quando ninguém está a ver.",

        timelineTitle: "Percurso",
        timelineSubtitle: "Marcos que construíram o lobo.",

        t1Title: "Atletismo na escola",
        t1Text: "Escola do Fogueteiro. Corta-matos, pista, primeiros pódios. O gosto pela dor útil começou aqui.",

        t2Title: "Vida de Futebolista",
        t2Text: "Três clubes, AC Arrentela, Amora e Belenenses. Disciplina de balneário. Responsabilidade, Vontade de vencer.",

        t3Title: "Bikes & Aventuras",
        t3Text: "Provas de BTT e estrada. Horas de sela, subidas longas, a mesma lógica: aguentar quando o corpo pede para sair.",

        t4Title: "Taekwondo. 1.º Dan.",
        t4Text: "Começou com o filho, Duarte. Uma década. Cinturão negro a 23 de janeiro de 2022. Conhecimento em Defesa Pessoal, Controlo e Precisão.",

        t5Title: "Regresso. Primeira Maratona.",
        t5Text: "Estreia em maratona a 23 de abril, na Maratona Internacional de Aveiro. O relógio passou a mandar.",

        t6Title: "Recordes à Vista",
        t6Text: "Maratona do Porto em 02:52:55. Meia Internacional de Lagos em Primeiro Lugar. O trabalho ficou visível."
    },

    en: {
        pageTitle: "History | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "History",
        heroPhrase: "A journey built through discipline, resilience and the Lone Wolf mindset.",
        historyPhotoAlt: "Lone Wolf athlete",

        introTitle: "Born to run",
        introP1: "The Lone Wolf journey began with a real passion for sport, self-improvement and the constant desire to evolve. Every training session, every challenge and every obstacle helped build a mindset focused on discipline, work and daily progress.",
        introP2: "Long before the brand existed, the spirit was already there. A competitive, resilient and determined spirit, shaped by athletics, football, cycling and taekwondo. That foundation gave birth to a strong and authentic identity.",
        introP3: "Today, Lone Wolf represents more than clothing or image. It represents a way of living sport and life: following your own path, staying focused and continuing to grow, even when nobody is watching.",

        timelineTitle: "Path",
        timelineSubtitle: "Milestones that built the wolf.",

        t1Title: "School athletics",
        t1Text: "Escola do Fogueteiro. Cross-country, track, first podiums. The taste for useful pain started here.",

        t2Title: "Life as a footballer",
        t2Text: "Three clubs: AC Arrentela, Amora and Belenenses. Dressing-room discipline. Responsibility, will to win.",

        t3Title: "Bikes & Adventures",
        t3Text: "MTB and road races. Long climbs, long hours. Same logic: stay when the body asks to leave.",

        t4Title: "Taekwondo. 1st Dan.",
        t4Text: "Started with his son, Duarte. A decade. Black belt on 23 January 2022. Knowledge of self-defence, control and precision.",

        t5Title: "Return. First Marathon.",
        t5Text: "Marathon debut on 23 April, at the Aveiro International Marathon. The clock started calling the shots.",

        t6Title: "Records in sight",
        t6Text: "Porto Marathon in 02:52:55. Lagos International Half in first place. The work became visible."
    }
};</script>
<?php include "footer.php"; ?>

</body>
</html>
