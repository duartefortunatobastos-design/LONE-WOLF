

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

<section class="page-section historia-page">
    <div class="container">

        <section class="intro-historia">
            <div class="intro-imagem reveal-page">
                <img src="IMAGENS/PAI_4.jpeg" alt="Atleta Lone Wolf" data-i18n-alt="historyPhotoAlt">
            </div>

            <div class="intro-texto reveal-page">
                <h2 data-i18n="introTitle">Nascido para correr</h2>

                <p data-i18n="introP1">
                    A jornada da Lone Wolf começou com uma paixão real pelo desporto, pela superação e pela vontade constante de evoluir. 
                    Cada treino, cada desafio e cada obstáculo ajudaram a construir uma mentalidade focada na disciplina, no trabalho e no progresso diário.
                </p>

                <p data-i18n="introP2">
                    Muito antes de existir a marca, já existia o espírito. Um espírito competitivo, resiliente e determinado, moldado pelo atletismo, 
                    pelo futebol, pelo ciclismo e pelo taekwondo. Foi essa base que deu origem a uma identidade forte e autêntica.
                </p>

                <p data-i18n="introP3">
                    Hoje, a Lone Wolf representa mais do que roupa ou imagem. Representa uma forma de estar no desporto e na vida: seguir o próprio caminho, 
                    manter o foco e continuar a crescer, mesmo quando ninguém está a ver.
                </p>
            </div>
        </section>

        <section class="cronologia">
            <div class="secao-titulo reveal-page">
                <h3 data-i18n="timelineTitle">Cronologia</h3>
                <p data-i18n="timelineSubtitle">Marcos importantes na jornada</p>
                <div class="secao-linha"></div>
            </div>

            <div class="timeline">
                <div class="timeline-item esquerda reveal-page">
                    <div class="timeline-ano">01</div>
                    <h4 data-i18n="t1Title">O Início</h4>
                    <p data-i18n="t1Text">Tudo começou na Escola do Fogueteiro. Atualmente Escola Secundária Manuel Cargaleiro, onde Rui Bastos iniciou a prática do atletismo, participando em vários corta-matos e provas de pista a nível concelhio e distrital, obtendo alguns lugares no pódio.</p>
                </div>

                <div class="timeline-item direita reveal-page">
                    <div class="timeline-ano">02</div>
                    <h4 data-i18n="t2Title">Mundo do Futebol</h4>
                    <p data-i18n="t2Text">Seguiu o seu percurso no futebol, passando por três clubes, incluindo o histórico Belenenses, onde desenvolveu disciplina, responsabilidade e espírito de equipa.</p>
                </div>

                <div class="timeline-item esquerda reveal-page">
                    <div class="timeline-ano">03</div>
                    <h4 data-i18n="t3Title">Loucura pelas Bikes</h4>
                    <p data-i18n="t3Text">Após sair do futebol começou a ganhar gosto pelo mundo das bicicletas. Com o passar dos anos decidiu entrar no mundo da competição, participando em várias provas de BTT e ciclismo por Portugal e Espanha.</p>
                </div>

                <div class="timeline-item direita reveal-page">
                    <div class="timeline-ano">04</div>
                    <h4 data-i18n="t4Title">Conhecimento pela Coreia</h4>
                    <p data-i18n="t4Text">Começou a praticar Taekwondo arte marcial descendente da Coreia do Sul, em 2012 juntamente com o seu filho (Duarte Bastos). Ao longo dos anos foi evoluindo e adquirindo conhecimentos na área da defesa pessoal. No dia 23/01/2022 conquistou o tão desejado cinturão negro juntamente com o seu filho, alcançando assim o 1º Dan de Taekwondo.</p>
                </div>

                <div class="timeline-item esquerda reveal-page">
                    <div class="timeline-ano">05</div>
                    <h4 data-i18n="t5Title">De volta às Origens</h4>
                    <p data-i18n="t5Text">O regresso ao atletismo aconteceu através do TAS – Troféu de Atletismo do Seixal, participando posteriormente em provas de estrada, 10 km, meias-maratonas e maratonas. A estreia em maratonas aconteceu a 23 de abril de 2023 na Maratona da Europa, em Aveiro.</p>
                </div>
            </div>
        </section>

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
        introP1: "A jornada Lone Wolf começou com uma paixão real pelo desporto, pela superação e pela vontade constante de evoluir. Cada treino, cada desafio e cada obstáculo ajudaram a construir uma mentalidade focada na disciplina, no trabalho e no progresso diário.",
        introP2: "Muito antes de existir a marca, já existia o espírito. Um espírito competitivo, resiliente e determinado, moldado pelo atletismo, pelo futebol, pelo ciclismo e pelo taekwondo. Foi essa base que deu origem a uma identidade forte e autêntica.",
        introP3: "Hoje, Lone Wolf representa mais do que roupa ou imagem. Representa uma forma de estar no desporto e na vida: seguir o próprio caminho, manter o foco e continuar a crescer, mesmo quando ninguém está a ver.",

        timelineTitle: "Cronologia",
        timelineSubtitle: "Marcos importantes na jornada",

        t1Title: "O Início",
        t1Text: "Tudo começou na Escola do Fogueteiro. Atualmente Escola Secundária Manuel Cargaleiro, onde Rui Bastos iniciou a prática do atletismo, participando em vários corta-matos e provas de pista a nível concelhio e distrital, obtendo alguns lugares no pódio.",

        t2Title: "Mundo do Futebol",
        t2Text: "Seguiu o seu percurso no futebol, passando por três clubes, incluindo o histórico Belenenses, onde desenvolveu disciplina, responsabilidade e espírito de equipa.",

        t3Title: "Loucura pelas Bikes",
        t3Text: "Após sair do futebol começou a ganhar gosto pelo mundo das bicicletas. Com o passar dos anos decidiu entrar no mundo da competição, participando em várias provas de BTT e ciclismo por Portugal e Espanha.",

        t4Title: "Conhecimento pela Coreia",
        t4Text: "Começou a praticar Taekwondo, arte marcial descendente da Coreia do Sul, em 2012 juntamente com o seu filho, Duarte Bastos. Ao longo dos anos foi evoluindo e adquirindo conhecimentos na área da defesa pessoal. No dia 23/01/2022 conquistou o tão desejado cinturão negro juntamente com o seu filho, alcançando assim o 1º Dan de Taekwondo.",

        t5Title: "De volta às Origens",
        t5Text: "O regresso ao atletismo aconteceu através do TAS – Troféu de Atletismo do Seixal, participando posteriormente em provas de estrada, 10 km, meias-maratonas e maratonas. A estreia em maratonas aconteceu a 23 de abril de 2023 na Maratona da Europa, em Aveiro."
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

        timelineTitle: "Timeline",
        timelineSubtitle: "Important milestones in the journey",

        t1Title: "The Beginning",
        t1Text: "It all started at Escola do Fogueteiro, now Escola Secundária Manuel Cargaleiro, where Rui Bastos began athletics, taking part in several cross-country and track events at local and district level, earning some podium finishes.",

        t2Title: "The Football World",
        t2Text: "He continued his path in football, playing for three clubs, including the historic Belenenses, where he developed discipline, responsibility and team spirit.",

        t3Title: "Passion for Bikes",
        t3Text: "After leaving football, he developed a taste for cycling. Over the years, he decided to enter the competitive world, taking part in several MTB and road cycling races across Portugal and Spain.",

        t4Title: "Connection with Korea",
        t4Text: "He began practicing Taekwondo, a martial art from South Korea, in 2012 alongside his son, Duarte Bastos. Over the years, he evolved and gained knowledge in self-defense. On 23/01/2022, he achieved the long-desired black belt together with his son, reaching the 1st Dan in Taekwondo.",

        t5Title: "Back to the Roots",
        t5Text: "The return to athletics came through TAS – Troféu de Atletismo do Seixal, later taking part in road races, 10 km events, half marathons and marathons. His marathon debut took place on April 23, 2023, at the Maratona da Europa in Aveiro."
    }
};</script>
<?php include "footer.php"; ?>

</body>
</html>
