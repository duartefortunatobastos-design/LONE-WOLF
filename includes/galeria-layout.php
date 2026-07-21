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

    if ($categoria === "todos") {
        $destaques = array_values(array_filter($items, static fn(array $item): bool => !empty($item["destaque"])));
        $resto = array_values(array_filter($items, static fn(array $item): bool => empty($item["destaque"])));

        if ($destaques) {
            echo '<section class="galeria-destaque page-block">';
            if (isset($destaques[0])) {
                render_galeria_trigger($destaques[0], "foto-destaque", true);
            }
            if (isset($destaques[1])) {
                echo '<div class="coluna-destaque">';
                render_galeria_trigger($destaques[1], "foto-card", true);
                echo '</div>';
            }
            echo '</section>';
        }

        if ($resto) {
            echo '<section class="galeria-grid galeria-mosaico page-block">';
            foreach ($resto as $item) {
                render_galeria_trigger($item, "galeria-card");
            }
            echo '</section>';
        }

        return;
    }

    echo '<section class="galeria-grid galeria-mosaico galeria-mosaico--3 page-block">';
    foreach ($items as $item) {
        render_galeria_trigger($item, "galeria-card");
    }
    echo '</section>';
}
