<?php
require_once "includes/init.php";

if (!isset($_SESSION["user_id"])) {
    $_SESSION["redirect_after_login"] = "encomendas.php";
    header("Location: login.php");
    exit;
}

$encomendas = listar_encomendas_utilizador($conn, intval($_SESSION["user_id"]));

$pageTitle = "As Minhas Encomendas | Lone Wolf";
$bodyClass = "pagina-carrinho";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="pagina-carrinho">
    <section class="hero-carrinho">
        <div class="hero-conteudo reveal-page">
            <p class="kicker" data-i18n="kicker">Loja Oficial</p>
            <h1 data-i18n="title">As Minhas Encomendas</h1>
            <p class="hero-frase" data-i18n="subtitle">Consulta o histórico e estado das tuas compras.</p>
        </div>
    </section>

    <section class="conteudo-carrinho">
        <div class="container">
            <div class="container-estreito">
                <?php if (empty($encomendas)): ?>
                    <div class="carrinho-box vazio reveal-page">
                        <div class="icone-vazio">📦</div>
                        <h3 data-i18n="emptyTitle">Ainda não tens encomendas</h3>
                        <p data-i18n="emptyText">Explora a loja Lone Wolf e faz a tua primeira compra.</p>
                        <a href="loja.php" class="btn btn-principal" data-i18n="goShop">Ir para a Loja</a>
                    </div>
                <?php else: ?>
                    <div class="encomendas-lista">
                        <?php foreach ($encomendas as $encomenda): ?>
                            <?php $itens = obter_itens_encomenda($conn, intval($encomenda["id"])); ?>
                            <article class="encomenda-card reveal-page">
                                <div class="encomenda-topo">
                                    <div>
                                        <h3>#<?= (int) $encomenda["id"] ?></h3>
                                        <span class="encomenda-data"><?= date("d/m/Y H:i", strtotime($encomenda["criada_em"])) ?></span>
                                    </div>
                                    <span class="estado-badge estado-<?= htmlspecialchars($encomenda["estado"]) ?>"><?= label_estado_encomenda($encomenda["estado"]) ?></span>
                                </div>
                                <div class="resumo-linhas">
                                    <?php foreach ($itens as $item): ?>
                                        <div class="resumo-item">
                                            <span><?= htmlspecialchars($item["nome"]) ?><?php if ($item["tamanho"]): ?> (<?= htmlspecialchars($item["tamanho"]) ?>)<?php endif; ?> x <?= (int) $item["quantidade"] ?></span>
                                            <span><?= formatar_preco((float) $item["preco"] * (int) $item["quantidade"]) ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="resumo-total">
                                    <span data-i18n="total">Total</span>
                                    <strong><?= formatar_preco((float) $encomenda["total"]) ?></strong>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<script>window.pageTranslations = {
    pt: { pageTitle: "As Minhas Encomendas | Lone Wolf", kicker: "Loja Oficial", title: "As Minhas Encomendas", subtitle: "Consulta o histórico e estado das tuas compras.", emptyTitle: "Ainda não tens encomendas", emptyText: "Explora a loja Lone Wolf e faz a tua primeira compra.", goShop: "Ir para a Loja", total: "Total" },
    en: { pageTitle: "My Orders | Lone Wolf", kicker: "Official Shop", title: "My Orders", subtitle: "View your purchase history and order status.", emptyTitle: "No orders yet", emptyText: "Explore the Lone Wolf shop and place your first order.", goShop: "Go to Shop", total: "Total" }
};</script>
<?php include "footer.php"; ?>
</body>
</html>
