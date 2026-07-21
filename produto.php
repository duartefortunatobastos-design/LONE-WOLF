<?php
require_once "includes/init.php";

$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
$produto = $id > 0 ? obter_produto($conn, $id) : null;

if (!$produto) {
    header("Location: loja.php");
    exit;
}

$tamanhos = parse_lista_csv($produto["tamanhos"] ?? "");
$cores = parse_lista_csv($produto["cores"] ?? "");

$pageTitle = $produto["nome"] . " | Loja Lone Wolf";
$pageDescription = $produto["descricao"] ?? "";
$pageImage = $produto["imagem"];
$bodyClass = "pagina-loja pagina-produto";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<section class="produto-topbar">
    <div class="container">
        <a href="loja.php" class="produto-voltar" data-i18n="backToShop">
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
            Voltar à loja
        </a>
    </div>
</section>

<main class="pagina-produto-main">
    <section class="produto-detalhe">
        <div class="container">
            <div class="produto-detalhe-grid reveal-page">
                <div class="produto-detalhe-imagem">
                    <?php if (!empty($produto["badge"])): ?>
                        <span class="produto-badge"><?= htmlspecialchars($produto["badge"]) ?></span>
                    <?php endif; ?>
                    <img src="<?= htmlspecialchars($produto["imagem"]) ?>" alt="<?= htmlspecialchars($produto["nome"]) ?>">
                </div>

                <div class="produto-detalhe-info">
                    <span class="produto-categoria" data-i18n-field="categoria"><?= htmlspecialchars($produto["categoria"]) ?></span>
                    <h1 data-i18n-field="nome"><?= htmlspecialchars($produto["nome"]) ?></h1>
                    <div class="produto-preco-grande"><?= formatar_preco((float) $produto["preco"]) ?></div>
                    <p class="produto-desc" data-i18n-field="descricao"><?= htmlspecialchars($produto["descricao"]) ?></p>

                    <form action="adicionar_carrinho.php" method="GET" class="produto-form">
                        <input type="hidden" name="id" value="<?= (int) $produto["id"] ?>">

                        <?php if (!empty($tamanhos)): ?>
                            <label for="tamanho" data-i18n="sizeLabel">Tamanho</label>
                            <select id="tamanho" name="tamanho" required>
                                <option value="" data-i18n="chooseSize">Escolhe o tamanho</option>
                                <?php foreach ($tamanhos as $tam): ?>
                                    <option value="<?= htmlspecialchars($tam) ?>"><?= htmlspecialchars($tam) ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>

                        <?php if (!empty($cores)): ?>
                            <label for="cor" data-i18n="colorLabel">Cor</label>
                            <select id="cor" name="cor" required>
                                <option value="" data-i18n="chooseColor">Escolhe a cor</option>
                                <?php foreach ($cores as $c): ?>
                                    <option value="<?= htmlspecialchars($c) ?>"><?= htmlspecialchars($c) ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>

                        <button type="submit" class="produto-btn" data-i18n="addToCart">Adicionar ao Carrinho</button>
                    </form>

                    <div class="share-row">
                        <span data-i18n="share">Partilhar</span>
                        <?php
                        $shareUrl = urlencode(($config = require __DIR__ . "/includes/site-config.php")["site_url"] . "/produto.php?id=" . $id);
                        $shareText = urlencode($produto["nome"] . " — Lone Wolf");
                        ?>
                        <a href="https://wa.me/?text=<?= $shareText ?>%20<?= $shareUrl ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-whatsapp" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $shareUrl ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-facebook" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: <?= json_encode($produto["nome"] . " | Loja Lone Wolf") ?>,
        sizeLabel: "Tamanho", colorLabel: "Cor", chooseSize: "Escolhe o tamanho", chooseColor: "Escolhe a cor",
        addToCart: "Adicionar ao Carrinho", share: "Partilhar", backToShop: "Voltar à loja",
        nome: <?= json_encode($produto["nome"]) ?>,
        descricao: <?= json_encode($produto["descricao"]) ?>,
        categoria: <?= json_encode($produto["categoria"]) ?>
    },
    en: {
        pageTitle: <?= json_encode(($produto["nome_en"] ?: $produto["nome"]) . " | Lone Wolf Shop") ?>,
        sizeLabel: "Size", colorLabel: "Color", chooseSize: "Choose size", chooseColor: "Choose color",
        addToCart: "Add to Cart", share: "Share", backToShop: "Back to shop",
        nome: <?= json_encode($produto["nome_en"] ?: $produto["nome"]) ?>,
        descricao: <?= json_encode($produto["descricao_en"] ?: $produto["descricao"]) ?>,
        categoria: <?= json_encode($produto["categoria_en"] ?: $produto["categoria"]) ?>
    }
};</script>
<?php include "footer.php"; ?>
</body>
</html>
