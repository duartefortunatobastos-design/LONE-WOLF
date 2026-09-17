<?php

/** @var array<int, array{label: string, href?: string}> $breadcrumbs */
$breadcrumbs = $breadcrumbs ?? [];

if (count($breadcrumbs) <= 1) {
    return;
}
?>
<nav class="lw-breadcrumbs" aria-label="Navegação secundária">
    <ol>
        <?php foreach ($breadcrumbs as $index => $crumb): ?>
            <li>
                <?php if (!empty($crumb["href"]) && $index < count($breadcrumbs) - 1): ?>
                    <a href="<?= htmlspecialchars($crumb["href"]) ?>"><?= htmlspecialchars($crumb["label"]) ?></a>
                <?php else: ?>
                    <span aria-current="page"><?= htmlspecialchars($crumb["label"]) ?></span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
