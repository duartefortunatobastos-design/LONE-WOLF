<?php
require_once "includes/init.php";
require_once __DIR__ . "/includes/galeria-layout.php";

$galeriaItens = require __DIR__ . "/includes/galeria-data.php";
$filtroInicial = $_GET["categoria"] ?? "todos";
if (!in_array($filtroInicial, ["todos", "competicao", "treino", "equipamento"], true)) {
    $filtroInicial = "todos";
}

$categorias = [
    "todos" => ["pt" => "Todos", "en" => "All"],
    "competicao" => ["pt" => "Competição", "en" => "Competition"],
    "treino" => ["pt" => "Treino", "en" => "Training"],
    "equipamento" => ["pt" => "Equipamento", "en" => "Gear"],
];

$pageTitle = 'Galeria | Lone Wolf';
$bodyClass = 'content-page pagina-galeria';
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="galeria-page-main">
<section class="hero-galeria" id="galeria-topo">
    <div class="hero-conteudo reveal-page">
        <div class="hero-mini" data-i18n="heroMini">Rui Bastos</div>
        <h1 data-i18n="heroTitle">Galeria</h1>
        <p class="hero-frase" data-i18n="heroPhrase">Momentos de treino, competição e superação. Cada imagem conta uma parte da caminhada.</p>
    </div>
    <a href="#galeria-inicio" class="galeria-hero-scroll" aria-label="Explorar galeria">
        <span data-i18n="scrollGallery">Explorar</span>
        <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
    </a>
</section>

<section class="page-section galeria-page" id="galeria-inicio">
    <div class="container">

        <header class="secao-titulo reveal-page">
            <h2 data-i18n="sectionTitle">Galeria Desportiva</h2>
            <p data-i18n="sectionText">Uma seleção de momentos marcantes, treinos intensos e provas onde a disciplina fala mais alto.</p>
            <div class="linha-laranja"></div>
        </header>

        <nav class="galeria-toolbar galeria-filtros reveal-page" role="tablist" aria-label="Filtrar galeria">
            <?php foreach ($categorias as $key => $labels): ?>
                <button
                    type="button"
                    class="filtro-btn<?= $filtroInicial === $key ? " activo" : "" ?>"
                    data-categoria="<?= htmlspecialchars($key) ?>"
                    data-i18n="filtro_<?= htmlspecialchars($key) ?>"
                    role="tab"
                    aria-selected="<?= $filtroInicial === $key ? "true" : "false" ?>"
                ><?= htmlspecialchars($labels["pt"]) ?></button>
            <?php endforeach; ?>
        </nav>

        <div id="galeria-conteudo" class="galeria-conteudo" aria-live="polite">
            <?php render_galeria_layout($galeriaItens, $filtroInicial); ?>
        </div>

        <footer class="page-closer frase-final reveal-page" id="galeria-fim">
            <h2 data-i18n="finalTitle">Disciplina. Foco. Garra.</h2>
            <p data-i18n="finalText">Mais do que fotografias, esta galeria representa evolução, esforço e mentalidade competitiva.</p>
        </footer>
    </div>
</section>

<div class="galeria-lightbox" id="galeria-lightbox" hidden role="dialog" aria-modal="true" aria-label="Visualizador de galeria">
    <button type="button" class="galeria-lightbox-close" aria-label="Fechar">&times;</button>
    <button type="button" class="galeria-lightbox-prev" aria-label="Anterior"><i class="fa-solid fa-chevron-left"></i></button>
    <button type="button" class="galeria-lightbox-next" aria-label="Seguinte"><i class="fa-solid fa-chevron-right"></i></button>

    <div class="galeria-lightbox-inner">
        <div class="galeria-lightbox-stage">
            <img src="" alt="" id="galeria-lightbox-img">
        </div>

        <div class="galeria-lightbox-meta">
            <span class="galeria-lightbox-counter" id="galeria-lightbox-counter">1 / 1</span>
            <h3 id="galeria-lightbox-caption"></h3>
            <p id="galeria-lightbox-desc"></p>
            <a href="contatos.php" class="galeria-lightbox-cta" data-i18n="lightboxCta">Contactar sobre este momento</a>
        </div>

        <div class="galeria-lightbox-thumbs" id="galeria-lightbox-thumbs"></div>
    </div>
</div>
</main>

<script>
window.galeriaData = <?= json_encode($galeriaItens, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
window.galeriaFiltroInicial = <?= json_encode($filtroInicial) ?>;
window.pageTranslations = {
    pt: {
        pageTitle: "Galeria | Lone Wolf", heroMini: "Rui Bastos", heroTitle: "Galeria",
        heroPhrase: "Momentos de treino, competição e superação. Cada imagem conta uma parte da caminhada.",
        sectionTitle: "Galeria Desportiva", sectionText: "Uma seleção de momentos marcantes, treinos intensos e provas onde a disciplina fala mais alto.",
        filtro_todos: "Todos", filtro_competicao: "Competição", filtro_treino: "Treino", filtro_equipamento: "Equipamento",
        finalTitle: "Disciplina. Foco. Garra.", finalText: "Mais do que fotografias, esta galeria representa evolução, esforço e mentalidade competitiva.",
        lightboxCta: "Contactar sobre este momento",
        scrollGallery: "Explorar",
        viewPhoto: "Ver",
        cardCta: "Contactar",
        cardCta_equipamento: "Ver loja",
        galeriaVazia: "Nenhuma imagem nesta categoria.",
        "tag_competicao": "Maratona Madrid",
        "tag_competicao-porto": "Maratona Porto",
        "tag_competicao-ispcsi": "Corrida ISPCSI",
        "tag_treino-fatima": "Corrida até Fátima",
        "tag_equipamento": "Equipamento",
        "tag_treino-foco": "Foco",
        "title_competicao": "Espírito Lone Wolf",
        "title_competicao-porto": "Competição",
        "title_competicao-ispcsi": "Ritmo de Prova",
        "title_treino-fatima": "Resistência",
        "title_equipamento": "Lone Wolf",
        "title_treino-foco": "Mente no Alvo",
        "desc_competicao": "Foco, garra e consistência em cada desafio.",
        "desc_competicao-porto": "Onde a mente e o corpo são postos à prova.",
        "desc_competicao-ispcsi": "Cada quilómetro conta na construção do resultado.",
        "desc_treino-fatima": "Superar distâncias com foco e determinação.",
        "desc_equipamento": "Identidade, disciplina e mentalidade competitiva.",
        "desc_treino-foco": "Foco total. Nada tira do caminho."
    },
    en: {
        pageTitle: "Gallery | Lone Wolf", heroMini: "Rui Bastos", heroTitle: "Gallery",
        heroPhrase: "Training, racing and breakthrough moments. Every image tells part of the journey.",
        sectionTitle: "Sports Gallery", sectionText: "A selection of standout moments, intense training and races where discipline speaks loudest.",
        filtro_todos: "All", filtro_competicao: "Competition", filtro_treino: "Training", filtro_equipamento: "Gear",
        finalTitle: "Discipline. Focus. Grit.", finalText: "More than photos, this gallery represents evolution, effort and competitive mindset.",
        lightboxCta: "Contact about this moment",
        scrollGallery: "Explore",
        viewPhoto: "View",
        cardCta: "Contact",
        cardCta_equipamento: "Shop",
        galeriaVazia: "No images in this category.",
        "tag_competicao": "Madrid Marathon",
        "tag_competicao-porto": "Porto Marathon",
        "tag_competicao-ispcsi": "ISPCSI Race",
        "tag_treino-fatima": "Run to Fátima",
        "tag_equipamento": "Gear",
        "tag_treino-foco": "Focus",
        "title_competicao": "Lone Wolf Spirit",
        "title_competicao-porto": "Competition",
        "title_competicao-ispcsi": "Race Pace",
        "title_treino-fatima": "Endurance",
        "title_equipamento": "Lone Wolf",
        "title_treino-foco": "Mind on Target",
        "desc_competicao": "Focus, grit and consistency in every challenge.",
        "desc_competicao-porto": "Where mind and body are tested.",
        "desc_competicao-ispcsi": "Every kilometre counts towards the result.",
        "desc_treino-fatima": "Overcoming distances with focus and determination.",
        "desc_equipamento": "Identity, discipline and competitive mindset.",
        "desc_treino-foco": "Total focus. Nothing gets in the way."
    }
};
</script>
<?php include "footer.php"; ?>
<script src="assets/js/galeria.js"></script>
</body>
</html>
