<?php
require_once "includes/init.php";
require_once __DIR__ . "/includes/galeria-layout.php";

$galeriaItens = require __DIR__ . "/includes/galeria-data.php";
$galeriaTotal = count($galeriaItens);
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

<main class="galeria-page-main gallery-page">
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

        <header class="secao-titulo galeria-album-head reveal-page">
            <p class="galeria-album-kicker" data-i18n="albumKicker">Arquivo</p>
            <h2 data-i18n="sectionTitle">Provas e treino</h2>
            <p class="galeria-album-lead" data-i18n="sectionText">Competição, preparação e identidade — o caminho de Rui Bastos.</p>
            <p class="galeria-album-count"><?= (int) $galeriaTotal ?> <span data-i18n="albumCountLabel">fotografias</span></p>
        </header>

        <nav class="galeria-toolbar galeria-filtros reveal-page" role="tablist" aria-label="Filtrar fotografias">
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
            <p data-i18n="finalText">Mais do que imagens: evolução, esforço e mentalidade competitiva.</p>
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
        </div>

        <div class="galeria-lightbox-thumbs" id="galeria-lightbox-thumbs"></div>
    </div>
</div>
</main>

<?php
$pageTranslations = [
    "pt" => [
        "pageTitle" => "Galeria | Lone Wolf",
        "heroMini" => "Rui Bastos",
        "heroTitle" => "Galeria",
        "heroPhrase" => "Momentos de treino, competição e superação. Cada imagem conta uma parte da caminhada.",
        "sectionTitle" => "Provas e treino",
        "sectionText" => "Competição, preparação e identidade — o caminho de Rui Bastos.",
        "albumKicker" => "Arquivo",
        "albumCountLabel" => "fotografias",
        "filtro_todos" => "Todos",
        "filtro_competicao" => "Competição",
        "filtro_treino" => "Treino",
        "filtro_equipamento" => "Equipamento",
        "finalTitle" => "Disciplina. Foco. Garra.",
        "finalText" => "Mais do que imagens: evolução, esforço e mentalidade competitiva.",
        "lightboxCta" => "Contactar sobre este momento",
        "scrollGallery" => "Explorar",
        "viewPhoto" => "Ver",
        "cardCta" => "Contactar",
        "cardCta_equipamento" => "Ver loja",
        "galeriaVazia" => "Nenhuma imagem nesta categoria.",
    ],
    "en" => [
        "pageTitle" => "Gallery | Lone Wolf",
        "heroMini" => "Rui Bastos",
        "heroTitle" => "Gallery",
        "heroPhrase" => "Training, racing and breakthrough moments. Every image tells part of the journey.",
        "sectionTitle" => "Racing and training",
        "sectionText" => "Competition, preparation and identity — Rui Bastos’s path.",
        "albumKicker" => "Archive",
        "albumCountLabel" => "photographs",
        "filtro_todos" => "All",
        "filtro_competicao" => "Competition",
        "filtro_treino" => "Training",
        "filtro_equipamento" => "Gear",
        "finalTitle" => "Discipline. Focus. Grit.",
        "finalText" => "More than images: evolution, effort and competitive mindset.",
        "lightboxCta" => "Contact about this moment",
        "scrollGallery" => "Explore",
        "viewPhoto" => "View",
        "cardCta" => "Contact",
        "cardCta_equipamento" => "Shop",
        "galeriaVazia" => "No images in this category.",
    ],
];

foreach ($galeriaItens as $item) {
    $id = (string) ($item["id"] ?? "");
    if ($id === "") {
        continue;
    }
    $pageTranslations["pt"]["tag_{$id}"] = $item["tag"] ?? "";
    $pageTranslations["pt"]["title_{$id}"] = $item["titulo"] ?? "";
    $pageTranslations["pt"]["desc_{$id}"] = $item["descricao"] ?? "";
    $pageTranslations["en"]["tag_{$id}"] = $item["tag_en"] ?? ($item["tag"] ?? "");
    $pageTranslations["en"]["title_{$id}"] = $item["titulo_en"] ?? ($item["titulo"] ?? "");
    $pageTranslations["en"]["desc_{$id}"] = $item["descricao_en"] ?? ($item["descricao"] ?? "");
}

$jsonFlags = JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT;
?>
<script>
window.galeriaData = <?= json_encode($galeriaItens, $jsonFlags) ?>;
window.galeriaFiltroInicial = <?= json_encode($filtroInicial, $jsonFlags) ?>;
window.pageTranslations = <?= json_encode($pageTranslations, $jsonFlags) ?>;
</script>
<?php include "footer.php"; ?>
<script src="assets/js/galeria.js?v=20260917a"></script>
</body>
</html>
