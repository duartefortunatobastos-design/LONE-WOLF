<?php

$pageTitle = $pageTitle ?? ($parceiro["nome"] . " | Lone Wolf");
$bodyClass = "parceiro-page";
require_once __DIR__ . "/head.php";
?>

<?php include __DIR__ . "/../header.php"; ?>

<main class="parceiro-main">
    <section class="parceiro-hero" style="--parceiro-bg: url('<?= htmlspecialchars($parceiro["bg"]) ?>')">
        <div class="parceiro-hero-inner reveal-page">
            <div class="parceiro-hero-copy">
                <a href="patrocinadores.php" class="voltar-link">
                    <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                    <span data-i18n="backPartners">Voltar aos parceiros</span>
                </a>

                <p class="parceria-label" data-i18n="partnerSince">Parceria desde 2021</p>
                <h1><?= htmlspecialchars($parceiro["nome"]) ?></h1>
                <p class="parceiro-hero-desc" data-i18n="heroText">Parceiro oficial do projeto.</p>
            </div>

            <?php if (!empty($parceiro["links"])): ?>
                <div class="footer-social-area parceiro-hero-social">
                    <h3 class="footer-title" data-i18n="socialsLabel">Redes e contactos</h3>
                    <div class="footer-social-wrap">
                        <?php foreach ($parceiro["links"] as $link): ?>
                            <a
                                href="<?= htmlspecialchars($link["href"]) ?>"
                                <?= !empty($link["external"]) ? 'target="_blank" rel="noopener noreferrer"' : "" ?>
                                class="<?= htmlspecialchars($link["class"]) ?>"
                                aria-label="<?= htmlspecialchars($link["label"]) ?>"
                            >
                                <i class="<?= htmlspecialchars($link["icon"]) ?>" aria-hidden="true"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="parceiro-conteudo">
        <div class="parceiro-conteudo-grid">
            <article class="parceiro-card parceiro-card--about reveal-page">
                <header class="parceiro-card-head">
                    <h2 data-i18n="aboutTitle">Sobre esta parceria</h2>
                    <p class="parceiro-card-sub" data-i18n="aboutSubtitle">Como trabalhamos em conjunto</p>
                    <div class="linha"></div>
                </header>
                <div class="parceiro-card-body">
                    <p data-i18n="aboutText1"></p>
                    <p data-i18n="aboutText2"></p>
                </div>
            </article>

            <article class="parceiro-card parceiro-card--highlights reveal-page">
                <header class="parceiro-card-head">
                    <h2 data-i18n="highlightsTitle">Destaques</h2>
                    <p class="parceiro-card-sub" data-i18n="highlightsSubtitle">O que esta colaboração traz ao projeto</p>
                    <div class="linha"></div>
                </header>
                <div class="parceiro-destaques-grid">
                    <?php foreach ($parceiro["icons"] as $index => $icon): ?>
                        <div class="parceiro-destaque-card" style="--destaque-delay: <?= $index * 0.12 ?>s">
                            <span class="parceiro-destaque-icone" aria-hidden="true">
                                <i class="fa-solid <?= htmlspecialchars($icon) ?>"></i>
                            </span>
                            <p data-i18n="highlight<?= $index + 1 ?>"></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </article>
        </div>
    </section>
</main>

<script>window.pageTranslations = <?= json_encode($pageTranslations, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;</script>
<?php include __DIR__ . "/../footer.php"; ?>
</body>
</html>
