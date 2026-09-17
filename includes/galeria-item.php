<?php

function galeria_public_src(string $path): string
{
    $normalized = str_replace("\\", "/", $path);
    $parts = array_map("rawurlencode", explode("/", $normalized));
    return implode("/", $parts);
}

function render_galeria_trigger(array $item, string $classExtra = "galeria-card", bool $eager = false): void
{
    $orientacao = $item["orientacao"] ?? "portrait";
    $class = trim("galeria-lightbox-trigger album-shot album-shot--" . $orientacao . " " . $classExtra);
    $imagem = htmlspecialchars($item["imagem"], ENT_QUOTES, "UTF-8");
    $imagemSrc = htmlspecialchars(galeria_public_src($item["imagem"]), ENT_QUOTES, "UTF-8");
    $titulo = htmlspecialchars($item["titulo"], ENT_QUOTES, "UTF-8");
    $descricao = htmlspecialchars($item["descricao"], ENT_QUOTES, "UTF-8");
    $id = htmlspecialchars($item["id"], ENT_QUOTES, "UTF-8");
    $alt = htmlspecialchars($item["tag"] ?? $item["titulo"], ENT_QUOTES, "UTF-8");
    $loading = $eager ? "eager" : "lazy";
    $fetchPriority = $eager ? ' fetchpriority="high"' : "";
    $webp = $item["imagem_webp"] ?? "";
    $webpSrc = $webp !== "" ? htmlspecialchars(galeria_public_src($webp), ENT_QUOTES, "UTF-8") : "";
    ?>
    <button
        type="button"
        class="<?= $class ?>"
        data-img="<?= $imagemSrc ?>"
        data-title="<?= $titulo ?>"
        data-desc="<?= $descricao ?>"
        data-orientacao="<?= htmlspecialchars($orientacao, ENT_QUOTES, "UTF-8") ?>"
    >
        <?php if ($webpSrc !== ""): ?>
            <picture class="galeria-picture">
                <source type="image/webp" srcset="<?= $webpSrc ?>">
                <img src="<?= $imagemSrc ?>" alt="<?= $alt ?>" loading="<?= $loading ?>" decoding="async"<?= $fetchPriority ?>>
            </picture>
        <?php else: ?>
            <img src="<?= $imagemSrc ?>" alt="<?= $alt ?>" loading="<?= $loading ?>" decoding="async"<?= $fetchPriority ?>>
        <?php endif; ?>
    </button>
    <?php
}
