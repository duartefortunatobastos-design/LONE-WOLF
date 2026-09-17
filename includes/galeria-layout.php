<?php

require_once __DIR__ . "/galeria-item.php";

function galeria_filter_items(array $items, string $categoria): array
{
    if ($categoria === "todos") {
        return $items;
    }

    return array_values(array_filter($items, static fn(array $item): bool => ($item["categoria"] ?? "") === $categoria));
}

function render_galeria_layout(array $items, string $categoria = "todos"): void
{
    $items = galeria_filter_items($items, $categoria);

    if (!$items) {
        echo '<p class="galeria-vazia" data-i18n="galeriaVazia">Nenhuma imagem nesta categoria.</p>';
        return;
    }

    echo '<section class="galeria-album page-block" aria-label="Álbum de fotografias">';
    foreach ($items as $index => $item) {
        render_galeria_trigger($item, "galeria-card", $index < 2);
    }
    echo '</section>';
}
