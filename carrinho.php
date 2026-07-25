<?php
require_once "includes/init.php";

bloquear_loja_se_inactiva();

if (!isset($_SESSION["carrinho"])) {
    $_SESSION["carrinho"] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["atualizar"])) {
    foreach ($_POST["quantidade"] as $chave => $qtd) {
        $chave = (string) $chave;
        $qtd = (int) $qtd;

        if ($qtd <= 0) {
            unset($_SESSION["carrinho"][$chave]);
        } elseif (isset($_SESSION["carrinho"][$chave])) {
            $_SESSION["carrinho"][$chave]["quantidade"] = $qtd;
        }
    }

    header("Location: carrinho.php");
    exit;
}

$total = 0;
foreach ($_SESSION["carrinho"] as $item) {
    $total += floatval($item["preco"]) * intval($item["quantidade"]);
}

$pageTitle = "Carrinho | Lone Wolf";
$bodyClass = "pagina-carrinho";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="pagina-carrinho">
    <section class="hero-carrinho">
        <div class="hero-conteudo reveal-page">
            <p class="kicker" data-i18n="kicker">Loja Oficial</p>
            <h1 data-i18n="title">Carrinho</h1>
            <p class="hero-frase" data-i18n="subtitle">Revê os teus artigos antes de concluir a compra.</p>
        </div>
    </section>

    <section class="conteudo-carrinho">
        <div class="container">
            <div class="container-estreito">
                <div class="topo">
                    <h2 data-i18n="cartTitle">O Teu Carrinho</h2>
                    <p data-i18n="cartText">Podes aceder a esta página a qualquer momento.</p>
                    <div class="linha-laranja"></div>
                </div>

                <div class="carrinho-box">
                    <?php if (empty($_SESSION["carrinho"])): ?>
                        <div class="vazio">
                            <div class="icone-vazio">🛒</div>
                            <h3 data-i18n="emptyTitle">O teu carrinho está vazio</h3>
                            <p data-i18n="emptyText">Ainda não tens produtos no carrinho.</p>
                            <a href="loja.php" class="btn btn-principal" data-i18n="continueShop">Continuar a Comprar</a>
                        </div>
                    <?php else: ?>
                        <form method="POST" action="carrinho.php">
                            <?php foreach ($_SESSION["carrinho"] as $chave => $item): ?>
                                <div class="item">
                                    <div>
                                        <img src="<?= htmlspecialchars($item["imagem"]) ?>" alt="<?= htmlspecialchars($item["nome"]) ?>">
                                    </div>
                                    <div>
                                        <h3><?= htmlspecialchars($item["nome"]) ?></h3>
                                        <p class="item-meta">
                                            <?php if (!empty($item["tamanho"])): ?><span>Tam. <?= htmlspecialchars($item["tamanho"]) ?></span><?php endif; ?>
                                            <?php if (!empty($item["cor"])): ?><span><?= htmlspecialchars($item["cor"]) ?></span><?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="preco"><?= formatar_preco((float) $item["preco"]) ?></div>
                                    <div class="quantidade">
                                        <input type="number" name="quantidade[<?= htmlspecialchars($chave) ?>]" min="0" value="<?= (int) $item["quantidade"] ?>">
                                    </div>
                                    <div class="subtotal">
                                        <?= formatar_preco((float) $item["preco"] * (int) $item["quantidade"]) ?>
                                        <span class="acoes-item">
                                            <a href="remover_carrinho.php?chave=<?= urlencode($chave) ?>" data-i18n="remove">Remover</a>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="rodape-carrinho">
                                <div class="total">
                                    <span data-i18n="total">Total:</span>
                                    <strong><?= formatar_preco($total) ?></strong>
                                </div>
                                <div class="botoes">
                                    <a href="loja.php" class="btn btn-secundario" data-i18n="continueShop">Continuar a Comprar</a>
                                    <button type="submit" name="atualizar" class="btn btn-secundario" data-i18n="updateCart">Atualizar Carrinho</button>
                                    <a href="checkout.php" class="btn btn-principal" data-i18n="checkout">Concluir Compra</a>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<script>window.pageTranslations = {
    pt: { pageTitle: "Carrinho | Lone Wolf", kicker: "Loja Oficial", title: "Carrinho", subtitle: "Revê os teus artigos antes de concluir a compra.", cartTitle: "O Teu Carrinho", cartText: "Podes aceder a esta página a qualquer momento.", emptyTitle: "O teu carrinho está vazio", emptyText: "Ainda não tens produtos no carrinho.", continueShop: "Continuar a Comprar", remove: "Remover", total: "Total:", updateCart: "Atualizar Carrinho", checkout: "Concluir Compra" },
    en: { pageTitle: "Cart | Lone Wolf", kicker: "Official Shop", title: "Cart", subtitle: "Review your items before checkout.", cartTitle: "Your Cart", cartText: "You can access this page at any time.", emptyTitle: "Your cart is empty", emptyText: "You don't have any products yet.", continueShop: "Continue Shopping", remove: "Remove", total: "Total:", updateCart: "Update Cart", checkout: "Checkout" }
};</script>
<?php include "footer.php"; ?>
</body>
</html>
