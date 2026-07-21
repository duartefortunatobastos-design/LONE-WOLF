<?php
require_once "includes/init.php";

$provas10km = [
    ["prova" => "Campeonato Nacional de Estrada Tomar", "data" => "Jan 2024", "tempo" => "38:20", "classificacao" => "50.º"],
    ["prova" => "2.ª Corrida da Próstata", "data" => "Out 2024", "tempo" => "38:25", "classificacao" => "2.º"],
    ["prova" => "1.ª Corrida Solidária ISCPSI", "data" => "Mai 2025", "tempo" => "37:38", "classificacao" => "2.º"],
    ["prova" => "36.º Festa do Avante", "data" => "Set 2025", "tempo" => "38:28", "classificacao" => "11.º"],
    ["prova" => "São Silvestre Seixal", "data" => "Dez 2025", "tempo" => "35:59", "classificacao" => "14.º"]
];

$provas21km = [
    ["prova" => "Meia dos Descobrimentos", "data" => "Dez 2025", "tempo" => "01:21:45", "classificacao" => "15.º"],
    ["prova" => "Meia de Cascais", "data" => "Fev 2025", "tempo" => "01:22:45", "classificacao" => "14.º"],
    ["prova" => "Meia de Odivelas-Loures-Odivelas", "data" => "Set 2025", "tempo" => "01:21:08", "classificacao" => "4.º"],
    ["prova" => "Meia Internacional de Lagos", "data" => "Nov 2025", "tempo" => "01:21:45", "classificacao" => "1.º"]
];

$provas42km = [
    ["prova" => "Maratona da Europa Aveiro", "data" => "Abr 2023", "tempo" => "03:34:15", "classificacao" => "86.º"],
    ["prova" => "Maratona de Lisboa", "data" => "Out 2023", "tempo" => "03:09:15", "classificacao" => "25.º"],
    ["prova" => "Maratona da Europa Aveiro", "data" => "Abr 2024", "tempo" => "03:08:09", "classificacao" => "18.º"],
    ["prova" => "Maratona de Bilbau", "data" => "Out 2025", "tempo" => "03:06:40", "classificacao" => "15.º"],
    ["prova" => "Maratona de Madrid", "data" => "Abr 2025", "tempo" => "02:57:20", "classificacao" => "3.º PT"],
    ["prova" => "Maratona do Porto", "data" => "Nov 2025", "tempo" => "02:52:55", "classificacao" => "11.º"]
];

function contarProvas($lista) {
    return count($lista);
}

$pageTitle = 'Competições | Lone Wolf';
$bodyClass = 'content-page';
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="provas-page">
    <section class="provas-hero">
        <div class="hero-conteudo reveal-page">
            <div class="hero-mini" data-i18n="heroMini">Rui Bastos</div>
            <h1 data-i18n="heroTitle">Competições</h1>
            <p class="hero-frase" data-i18n="heroPhrase">
                Resultados, evolução e provas que constroem a mentalidade.
            </p>
        </div>
    </section>

    <section class="provas-wrapper">
        <section class="intro-provas">
            <div class="intro-imagem reveal-page">
                <img src="IMAGENS/FOTO_PORTO.jpg" alt="Foto do atleta em competição" data-i18n-alt="competitionPhotoAlt">
            </div>

            <div class="intro-texto reveal-page">
                <h2 data-i18n="competitionsTitle">Competições</h2>
                <div class="linha-laranja"></div>

                <p data-i18n="competitionsIntro">
                    Esta secção reúne os principais registos competitivos do atleta nas distâncias de 10 km,
                    21 km e 42 km, apresentando os seus tempos e classificações.
                </p>

                <div class="stats-grid">
                    <div class="stat-card reveal-page">
                        <div class="stat-valor">35:59</div>
                        <div class="stat-label" data-i18n="best10k">Melhor 10 km</div>
                    </div>

                    <div class="stat-card reveal-page">
                        <div class="stat-valor">01:21:08</div>
                        <div class="stat-label" data-i18n="bestHalfMarathon">Melhor meia-maratona</div>
                    </div>

                    <div class="stat-card reveal-page">
                        <div class="stat-valor">02:52:55</div>
                        <div class="stat-label" data-i18n="bestMarathon">Melhor maratona</div>
                    </div>

                    <div class="stat-card reveal-page">
                        <div class="stat-valor"><?php echo contarProvas($provas10km); ?></div>
                        <div class="stat-label" data-i18n="races10k">Provas 10 km</div>
                    </div>

                    <div class="stat-card reveal-page">
                        <div class="stat-valor"><?php echo contarProvas($provas21km); ?></div>
                        <div class="stat-label" data-i18n="halfMarathons">Meias-maratonas</div>
                    </div>

                    <div class="stat-card reveal-page">
                        <div class="stat-valor"><?php echo contarProvas($provas42km); ?></div>
                        <div class="stat-label" data-i18n="marathons">Maratonas</div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        $blocos = [
            ["titulo" => "Provas de 10 km", "key" => "races10kTitle", "lista" => $provas10km],
            ["titulo" => "21 km — Meia-Maratona", "key" => "halfMarathonTitle", "lista" => $provas21km],
            ["titulo" => "42 km — Maratona", "key" => "marathonTitle", "lista" => $provas42km]
        ];
        ?>

        <?php foreach ($blocos as $bloco): ?>
            <article class="provas-bloco reveal-page">
                <div class="provas-titulo">
                    <span class="linha"></span>
                    <h2 data-i18n="<?php echo htmlspecialchars($bloco["key"]); ?>">
                        <?php echo htmlspecialchars($bloco["titulo"]); ?>
                    </h2>
                </div>

                <div class="provas-tabela-wrap">
                    <table class="provas-tabela">
                        <thead>
                            <tr>
                                <th data-i18n="race">Prova</th>
                                <th data-i18n="date">Data</th>
                                <th data-i18n="time">Tempo</th>
                                <th data-i18n="ranking">Classificação</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($bloco["lista"] as $prova): ?>
                                <tr>
                                    <td data-label="Prova" data-label-key="race">
                                        <?php echo htmlspecialchars($prova["prova"]); ?>
                                    </td>

                                    <td data-label="Data" data-label-key="date">
                                        <?php echo htmlspecialchars($prova["data"]); ?>
                                    </td>

                                    <td data-label="Tempo" data-label-key="time" class="tempo">
                                        <?php echo htmlspecialchars($prova["tempo"]); ?>
                                    </td>

                                    <td data-label="Classificação" data-label-key="ranking" class="classificacao">
                                        <?php if ($prova["classificacao"] === "Desconhecido"): ?>
                                            <span data-i18n="unknown">Desconhecido</span>
                                        <?php else: ?>
                                            <?php echo htmlspecialchars($prova["classificacao"]); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Competições | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Competições",
        heroPhrase: "Resultados, evolução e provas que constroem a mentalidade.",
        competitionPhotoAlt: "Foto do atleta em competição",
        competitionsTitle: "Competições",
        competitionsIntro: "Esta secção reúne os principais registos competitivos do atleta nas distâncias de 10 km, 21 km e 42 km, apresentando os seus tempos e classificações.",
        best10k: "Melhor 10 km",
        bestHalfMarathon: "Melhor meia-maratona",
        bestMarathon: "Melhor maratona",
        races10k: "Provas 10 km",
        halfMarathons: "Meias-maratonas",
        marathons: "Maratonas",
        races10kTitle: "Provas de 10 km",
        halfMarathonTitle: "21 km — Meia-Maratona",
        marathonTitle: "42 km — Maratona",
        race: "Prova",
        date: "Data",
        time: "Tempo",
        ranking: "Classificação",
        unknown: "Desconhecido"
    },
    en: {
        pageTitle: "Competitions | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Competitions",
        heroPhrase: "Results, progress and races that build the mindset.",
        competitionPhotoAlt: "Athlete competition photo",
        competitionsTitle: "Competitions",
        competitionsIntro: "This section brings together the athlete's main race results over 10 km, 21 km and 42 km, showing times and rankings.",
        best10k: "Best 10 km",
        bestHalfMarathon: "Best half marathon",
        bestMarathon: "Best marathon",
        races10k: "10 km races",
        halfMarathons: "Half marathons",
        marathons: "Marathons",
        races10kTitle: "10 km races",
        halfMarathonTitle: "21 km — Half Marathon",
        marathonTitle: "42 km — Marathon",
        race: "Race",
        date: "Date",
        time: "Time",
        ranking: "Ranking",
        unknown: "Unknown"
    }
};</script>
<?php include "footer.php"; ?>

</body>
</html>
