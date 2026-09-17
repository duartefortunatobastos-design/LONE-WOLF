<?php
require_once "includes/init.php";

$id = intval($_GET["id"] ?? $_SESSION["ultima_encomenda_id"] ?? 0);
$encomenda = $id > 0 ? obter_encomenda($conn, $id) : null;

if (!$encomenda) {
    header("Location: loja.php");
    exit;
}

if (isset($_SESSION["user_id"]) && intval($encomenda["user_id"]) !== intval($_SESSION["user_id"]) && ($_SESSION["tipo"] ?? "") !== "admin") {
    header("Location: loja.php");
    exit;
}

$itens = obter_itens_encomenda($conn, $id);
$config = require __DIR__ . "/includes/site-config.php";

$pageTitle = "Encomenda Confirmada | Lone Wolf";
$bodyClass = "pagina-checkout";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="pagina-checkout">
    <section class="hero-checkout">
        <div class="hero-conteudo reveal-page">
            <p class="kicker" data-i18n="kicker">Loja Oficial</p>
            <h1 data-i18n="title">Encomenda Confirmada</h1>
            <p class="hero-frase" data-i18n="subtitle">Obrigado! A tua encomenda foi registada com sucesso.</p>
        </div>
    </section>

    <section class="conteudo-checkout">
        <div class="container">
            <div class="container-estreito">
                <div class="checkout-sucesso-box reveal-page">
                    <div class="sucesso-icone"><i class="fa-solid fa-circle-check"></i></div>
                    <h2 data-i18n="orderNumber">Encomenda #<?= $id ?></h2>
                    <p data-i18n="emailSent">Enviámos um e-mail de confirmação para <?= htmlspecialchars($encomenda["email"]) ?>.</p>

                    <?php if ($encomenda["metodo_pagamento"] === "MB Way"): ?>
                        <div class="pagamento-info">
                            <h3 data-i18n="mbwayTitle">Pagamento MB Way</h3>
                            <p data-i18n="mbwayText">Envia o valor de <strong><?= formatar_preco((float) $encomenda["total"]) ?></strong> para <strong><?= htmlspecialchars($config["bank_mbway"]) ?></strong>.</p>
                        </div>
                    <?php elseif ($encomenda["metodo_pagamento"] === "Transferência Bancária"): ?>
                        <div class="pagamento-info">
                            <h3 data-i18n="transferTitle">Transferência Bancária</h3>
                            <p>IBAN: <strong><?= htmlspecialchars($config["bank_iban"]) ?></strong></p>
                            <p data-i18n="transferText">Indica o número da encomenda #<?= $id ?> na transferência.</p>
                        </div>
                    <?php endif; ?>

                    <div class="resumo-linhas">
                        <?php foreach ($itens as $item): ?>
                            <div class="resumo-item">
                                <span><?= htmlspecialchars($item["nome"]) ?> x <?= (int) $item["quantidade"] ?></span>
                                <span><?= formatar_preco((float) $item["preco"] * (int) $item["quantidade"]) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="resumo-total">
                        <span data-i18n="total">Total</span>
                        <strong><?= formatar_preco((float) $encomenda["total"]) ?></strong>
                    </div>

                    <div class="sucesso-acoes">
                        <a href="encomendas.php" class="btn btn-principal" data-i18n="myOrders">As Minhas Encomendas</a>
                        <a href="loja.php" class="btn btn-secundario" data-i18n="continueShop">Continuar a Comprar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>window.pageTranslations = {
    pt: { pageTitle: "Encomenda Confirmada | Lone Wolf", kicker: "Loja Oficial", title: "Encomenda Confirmada", subtitle: "Obrigado! A tua encomenda foi registada com sucesso.", orderNumber: "Encomenda #<?= $id ?>", emailSent: "Enviámos um e-mail de confirmação.", mbwayTitle: "Pagamento MB Way", mbwayText: "Envia o valor para o número indicado.", transferTitle: "Transferência Bancária", transferText: "Indica o número da encomenda na transferência.", total: "Total", myOrders: "As Minhas Encomendas", continueShop: "Continuar a Comprar" },
    en: { pageTitle: "Order Confirmed | Lone Wolf", kicker: "Official Shop", title: "Order Confirmed", subtitle: "Thank you! Your order was successfully placed.", orderNumber: "Order #<?= $id ?>", emailSent: "We sent a confirmation email.", mbwayTitle: "MB Way Payment", mbwayText: "Send the amount to the number shown.", transferTitle: "Bank Transfer", transferText: "Include the order number in the transfer.", total: "Total", myOrders: "My Orders", continueShop: "Continue Shopping" }
};</script>
<?php include "footer.php"; ?>
</body>
</html>
