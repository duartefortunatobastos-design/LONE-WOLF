<?php
require_once "includes/init.php";

$provas = [
    ["nome" => "Maratona do Porto", "nome_en" => "Porto Marathon", "data" => "Nov 2025", "ano" => "2025", "distancia" => "42", "tipo" => "estrada", "tempo" => "02:52:55", "classificacao" => "11.º", "imagem" => "IMAGENS/logo_maratona.png"],
    ["nome" => "Meia Internacional de Lagos", "nome_en" => "Lagos International Half", "data" => "Nov 2025", "ano" => "2025", "distancia" => "21", "tipo" => "estrada", "tempo" => "01:21:45", "classificacao" => "1.º", "imagem" => "IMAGENS/logo_meiamaratona.png"],
    ["nome" => "São Silvestre Seixal", "nome_en" => "São Silvestre Seixal", "data" => "Dez 2025", "ano" => "2025", "distancia" => "10", "tipo" => "estrada", "tempo" => "35:59", "classificacao" => "14.º", "imagem" => "IMAGENS/logo_10km.png"],
    ["nome" => "Meia dos Descobrimentos", "nome_en" => "Descobrimentos Half", "data" => "Dez 2025", "ano" => "2025", "distancia" => "21", "tipo" => "estrada", "tempo" => "01:21:45", "classificacao" => "15.º", "imagem" => "IMAGENS/logo_meiamaratona.png"],
    ["nome" => "Maratona de Madrid", "nome_en" => "Madrid Marathon", "data" => "Abr 2025", "ano" => "2025", "distancia" => "42", "tipo" => "estrada", "tempo" => "02:57:20", "classificacao" => "3.º PT", "imagem" => "IMAGENS/logo_maratona.png"],
    ["nome" => "Maratona de Bilbau", "nome_en" => "Bilbao Marathon", "data" => "Out 2025", "ano" => "2025", "distancia" => "42", "tipo" => "estrada", "tempo" => "03:06:40", "classificacao" => "15.º", "imagem" => "IMAGENS/logo_maratona.png"],
    ["nome" => "Meia de Odivelas-Loures-Odivelas", "nome_en" => "Odivelas-Loures Half", "data" => "Set 2025", "ano" => "2025", "distancia" => "21", "tipo" => "estrada", "tempo" => "01:21:08", "classificacao" => "4.º", "imagem" => "IMAGENS/logo_meiamaratona.png"],
    ["nome" => "36.º Festa do Avante", "nome_en" => "Festa do Avante", "data" => "Set 2025", "ano" => "2025", "distancia" => "10", "tipo" => "estrada", "tempo" => "38:28", "classificacao" => "11.º", "imagem" => "IMAGENS/logo_10km.png"],
    ["nome" => "1.ª Corrida Solidária ISCPSI", "nome_en" => "ISCPSI Race", "data" => "Mai 2025", "ano" => "2025", "distancia" => "10", "tipo" => "estrada", "tempo" => "37:38", "classificacao" => "2.º", "imagem" => "IMAGENS/logo_10km.png"],
    ["nome" => "Meia de Cascais", "nome_en" => "Cascais Half", "data" => "Fev 2025", "ano" => "2025", "distancia" => "21", "tipo" => "estrada", "tempo" => "01:22:45", "classificacao" => "14.º", "imagem" => "IMAGENS/logo_meiamaratona.png"],
    ["nome" => "Maratona da Europa Aveiro", "nome_en" => "Europe Marathon Aveiro", "data" => "Abr 2024", "ano" => "2024", "distancia" => "42", "tipo" => "estrada", "tempo" => "03:08:09", "classificacao" => "18.º", "imagem" => "IMAGENS/logo_maratona.png"],
    ["nome" => "2.ª Corrida da Próstata", "nome_en" => "Prostate Race", "data" => "Out 2024", "ano" => "2024", "distancia" => "10", "tipo" => "estrada", "tempo" => "38:25", "classificacao" => "2.º", "imagem" => "IMAGENS/logo_10km.png"],
    ["nome" => "Campeonato Nacional de Estrada Tomar", "nome_en" => "National Road Champs Tomar", "data" => "Jan 2024", "ano" => "2024", "distancia" => "10", "tipo" => "estrada", "tempo" => "38:20", "classificacao" => "50.º", "imagem" => "IMAGENS/logo_10km.png"],
    ["nome" => "Maratona de Lisboa", "nome_en" => "Lisbon Marathon", "data" => "Out 2023", "ano" => "2023", "distancia" => "42", "tipo" => "estrada", "tempo" => "03:09:15", "classificacao" => "25.º", "imagem" => "IMAGENS/logo_maratona.png"],
    ["nome" => "Maratona da Europa Aveiro", "nome_en" => "Europe Marathon Aveiro", "data" => "Abr 2023", "ano" => "2023", "distancia" => "42", "tipo" => "estrada", "tempo" => "03:34:15", "classificacao" => "86.º", "imagem" => "IMAGENS/logo_maratona.png"],
];

$pageTitle = 'Competições | Lone Wolf';
$pageDescription = 'Resultados de Rui Bastos — Lone Wolf. 10 km, meias-maratonas e maratonas.';
$bodyClass = 'content-page';
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="races-page">
    <section class="provas-hero">
        <div class="hero-conteudo reveal-page">
            <div class="hero-mini" data-i18n="heroMini">Rui Bastos</div>
            <h1 data-i18n="heroTitle">Competições</h1>
            <p class="hero-frase" data-i18n="heroPhrase">
                Resultados, evolução e provas que constroem a mentalidade.
            </p>
        </div>
    </section>

    <section class="ds-section">
        <div class="ds-container">
            <div class="races-filters" id="races-filters" role="group" aria-label="Filtrar provas">
                <button type="button" class="races-filter is-active" data-filter="all" data-i18n="filterAll" aria-pressed="true">Todas</button>
                <button type="button" class="races-filter" data-filter="10" data-i18n="filter10" aria-pressed="false">10 km</button>
                <button type="button" class="races-filter" data-filter="21" data-i18n="filter21" aria-pressed="false">21 km</button>
                <button type="button" class="races-filter" data-filter="42" data-i18n="filter42" aria-pressed="false">42 km</button>
                <button type="button" class="races-filter" data-filter="2025" aria-pressed="false">2025</button>
                <button type="button" class="races-filter" data-filter="2024" aria-pressed="false">2024</button>
                <button type="button" class="races-filter" data-filter="2023" aria-pressed="false">2023</button>
            </div>

            <div class="races-grid" id="races-grid">
                <?php foreach ($provas as $prova): ?>
                    <article
                        class="race-card reveal-page"
                        data-distancia="<?= htmlspecialchars($prova["distancia"]) ?>"
                        data-ano="<?= htmlspecialchars($prova["ano"]) ?>"
                        data-tipo="<?= htmlspecialchars($prova["tipo"]) ?>"
                    >
                        <div class="race-card-media race-card-media--logo">
                            <img src="<?= htmlspecialchars($prova["imagem"]) ?>" alt="<?= htmlspecialchars($prova["nome"]) ?>" loading="lazy">
                        </div>
                        <div class="race-card-body">
                            <div class="race-card-top">
                                <span><?= htmlspecialchars($prova["data"]) ?></span>
                                <span><?= htmlspecialchars($prova["distancia"]) ?> km</span>
                            </div>
                            <h3 class="race-card-name" data-pt="<?= htmlspecialchars($prova["nome"]) ?>" data-en="<?= htmlspecialchars($prova["nome_en"]) ?>"><?= htmlspecialchars($prova["nome"]) ?></h3>
                            <p class="ds-stat race-card-time"><?= htmlspecialchars($prova["tempo"]) ?></p>
                            <span class="race-card-rank"><?= htmlspecialchars($prova["classificacao"]) ?> <span data-i18n="placeLabel">Lugar</span></span>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <p class="races-empty" id="races-empty" hidden data-i18n="filterEmpty">Nenhuma prova neste filtro.</p>
        </div>
    </section>
</main>
<script>
(function () {
    var nav = document.getElementById("races-filters");
    var grid = document.getElementById("races-grid");
    var empty = document.getElementById("races-empty");
    if (!nav || !grid || nav.getAttribute("data-bound") === "1") return;

    nav.setAttribute("data-bound", "1");

    function apply(key) {
        var visible = 0;
        grid.querySelectorAll(".race-card").forEach(function (card) {
            var show = key === "all"
                || card.getAttribute("data-distancia") === key
                || card.getAttribute("data-ano") === key;
            card.classList.toggle("is-hidden", !show);
            card.hidden = !show;
            if (show) visible += 1;
        });
        if (empty) empty.hidden = visible > 0;
    }

    nav.addEventListener("click", function (event) {
        var button = event.target.closest(".races-filter");
        if (!button || !nav.contains(button)) return;

        var key = button.getAttribute("data-filter") || "all";
        nav.querySelectorAll(".races-filter").forEach(function (item) {
            var on = item === button;
            item.classList.toggle("is-active", on);
            item.setAttribute("aria-pressed", on ? "true" : "false");
        });
        apply(key);
    });
})();
</script>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Competições | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Competições",
        heroPhrase: "Resultados, evolução e provas que constroem a mentalidade.",
        filterAll: "Todas",
        filter10: "10 km",
        filter21: "21 km",
        filter42: "42 km",
        filterEmpty: "Nenhuma prova neste filtro.",
        placeLabel: "Lugar"
    },
    en: {
        pageTitle: "Competitions | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Competitions",
        heroPhrase: "Results, progress and races that build the mindset.",
        filterAll: "All",
        filter10: "10 km",
        filter21: "21 km",
        filter42: "42 km",
        filterEmpty: "No races in this filter.",
        placeLabel: "Place"
    }
};</script>
<?php include "footer.php"; ?>

</body>
</html>
