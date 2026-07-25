<?php

function render_galeria_trigger(array $item, string $classExtra = "galeria-card", bool $eager = false): void
{
    $class = trim("galeria-lightbox-trigger " . $classExtra);
    $imagem = htmlspecialchars($item["imagem"], ENT_QUOTES, "UTF-8");
    $titulo = htmlspecialchars($item["titulo"], ENT_QUOTES, "UTF-8");
    $descricao = htmlspecialchars($item["descricao"], ENT_QUOTES, "UTF-8");
    $id = htmlspecialchars($item["id"], ENT_QUOTES, "UTF-8");
    $tag = htmlspecialchars($item["tag"], ENT_QUOTES, "UTF-8");
    $loading = $eager ? "eager" : "lazy";
    $fetchPriority = $eager ? ' fetchpriority="high"' : "";
    $webp = $item["imagem_webp"] ?? "";
    $tagClass = ($item["id"] ?? "") === "competicao-porto" ? "tag tag--sem-icone" : "tag";
    ?>
    <button
        type="button"
        class="<?= $class ?>"
        data-img="<?= $imagem ?>"
        data-title="<?= $titulo ?>"
        data-desc="<?= $descricao ?>"
    >
        <span class="<?= $tagClass ?>" data-i18n="tag_<?= $id ?>"><?= $tag ?></span>
        <?php if ($webp !== ""): ?>
            <picture class="galeria-picture">
                <source type="image/webp" srcset="<?= htmlspecialchars($webp, ENT_QUOTES, "UTF-8") ?>">
                <img src="<?= $imagem ?>" alt="<?= $tag ?>" loading="<?= $loading ?>" decoding="async"<?= $fetchPriority ?>>
            </picture>
        <?php else: ?>
            <img src="<?= $imagem ?>" alt="<?= $tag ?>" loading="<?= $loading ?>" decoding="async"<?= $fetchPriority ?>>
        <?php endif; ?>
        <div class="overlay">
            <div class="overlay-inner">
                <h3 data-i18n="title_<?= $id ?>"><?= $titulo ?></h3>
                <p data-i18n="desc_<?= $id ?>"><?= $descricao ?></p>
            </div>
        </div>
    </button>
    <?php
}
