<?php
require_once "includes/init.php";

header("Location: loja.php");
exit;

if (empty($_SESSION["carrinho"])) {
    header("Location: carrinho.php");
    exit;
}

if (!isset($_SESSION["user_id"])) {
    $_SESSION["redirect_after_login"] = "checkout.php";
    header("Location: login.php");
    exit;
}

$total = 0;
foreach ($_SESSION["carrinho"] as $item) {
    $total += $item["preco"] * $item["quantidade"];
}

$nome = $_SESSION["nome"] ?? "";
$email = $_SESSION["email"] ?? "";
$checkoutErro = $_SESSION["checkout_erro"] ?? "";
unset($_SESSION["checkout_erro"]);

$pageTitle = "Checkout | Lone Wolf";
$bodyClass = "pagina-checkout";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="pagina-checkout">
    <section class="hero-checkout">
        <div class="hero-conteudo reveal-page">
            <p class="kicker" data-i18n="kicker">Loja Oficial</p>
            <h1 data-i18n="heroTitle">Checkout</h1>
            <p class="hero-frase" data-i18n="heroPhrase">Preenche os dados para finalizar a tua encomenda.</p>
        </div>
    </section>

    <section class="conteudo-checkout">
        <div class="container">
            <div class="container-estreito">
                <div class="topo">
                    <h2 data-i18n="formTitle">Finalizar Compra</h2>
                    <p data-i18n="formSubtitle">Preenche os teus dados para concluir a encomenda.</p>
                    <div class="linha-laranja"></div>
                </div>

                <?php if ($checkoutErro !== ""): ?>
                    <div class="alerta erro"><?= htmlspecialchars($checkoutErro) ?></div>
                <?php endif; ?>

                <form action="processar_encomenda.php" method="POST">
                    <div class="checkout-grid">
                        <div class="box">
                            <div class="campo">
                                <label for="nome" data-i18n="labelName">Nome Completo</label>
                                <input type="text" id="nome" name="nome" required value="<?php echo htmlspecialchars($nome); ?>">
                            </div>

                            <div class="campo">
                                <label for="email" data-i18n="labelEmail">Email</label>
                                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>">
                            </div>

                            <div class="campo">
                                <label for="telefone" data-i18n="labelPhone">Telemóvel</label>
                                <input type="text" id="telefone" name="telefone" required>
                            </div>

                            <div class="campo">
                                <label for="morada" data-i18n="labelAddress">Morada</label>
                                <input type="text" id="morada" name="morada" required>
                            </div>

                            <div class="linha-dupla">
                                <div class="campo">
                                    <label for="localidade" data-i18n="labelCity">Cidade</label>
                                    <input type="text" id="localidade" name="localidade" required>
                                </div>

                                <div class="campo">
                                    <label for="codigo_postal" data-i18n="labelPostal">Código Postal</label>
                                    <input type="text" id="codigo_postal" name="codigo_postal" required>
                                </div>
                            </div>

                            <div class="campo">
                                <label for="metodo_pagamento" data-i18n="labelPayment">Método de Pagamento</label>
                                <select id="metodo_pagamento" name="metodo_pagamento" required>
                                    <option value="" data-i18n="paymentSelect">Seleciona uma opção</option>
                                    <option value="mbway" data-i18n="paymentMbway">MB Way</option>
                                    <option value="transferencia" data-i18n="paymentTransfer">Transferência Bancária</option>
                                    <option value="entrega" data-i18n="paymentDelivery">Pagamento na Entrega</option>
                                </select>
                            </div>

                            <div class="campo">
                                <label for="observacoes" data-i18n="labelNotes">Observações</label>
                                <textarea id="observacoes" name="observacoes"></textarea>
                            </div>

                            <button type="submit" class="btn btn-principal" data-i18n="submitBtn">Finalizar Encomenda</button>
                        </div>

                        <div class="box">
                            <h3 data-i18n="summaryTitle">Resumo</h3>

                            <div class="resumo-linhas">
                                <?php foreach ($_SESSION["carrinho"] as $item): ?>
                                    <div class="resumo-item">
                                        <span><?php echo htmlspecialchars($item["nome"]); ?> x <?php echo (int) $item["quantidade"]; ?></span>
                                        <span><?php echo number_format($item["preco"] * $item["quantidade"], 2, ",", "."); ?>€</span>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="resumo-item">
                                <span data-i18n="subtotal">Subtotal</span>
                                <span><?php echo number_format($total, 2, ",", "."); ?>€</span>
                            </div>

                            <div class="resumo-item">
                                <span data-i18n="shipping">Envio</span>
                                <span data-i18n="shippingFree">0,00€</span>
                            </div>

                            <div class="resumo-total">
                                <span data-i18n="total">Total</span>
                                <strong><?php echo number_format($total, 2, ",", "."); ?>€</strong>
                            </div>

                            <div class="resumo-acoes">
                                <a href="carrinho.php" class="btn btn-secundario" data-i18n="backCart">Voltar ao Carrinho</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Checkout | Lone Wolf",
        kicker: "Loja Oficial",
        heroTitle: "Checkout",
        heroPhrase: "Preenche os dados para finalizar a tua encomenda.",
        formTitle: "Finalizar Compra",
        formSubtitle: "Preenche os teus dados para concluir a encomenda.",
        labelName: "Nome Completo",
        labelEmail: "Email",
        labelPhone: "Telemóvel",
        labelAddress: "Morada",
        labelCity: "Cidade",
        labelPostal: "Código Postal",
        labelPayment: "Método de Pagamento",
        paymentSelect: "Seleciona uma opção",
        paymentMbway: "MB Way",
        paymentTransfer: "Transferência Bancária",
        paymentDelivery: "Pagamento na Entrega",
        labelNotes: "Observações",
        submitBtn: "Finalizar Encomenda",
        summaryTitle: "Resumo",
        subtotal: "Subtotal",
        shipping: "Envio",
        shippingFree: "0,00€",
        total: "Total",
        backCart: "Voltar ao Carrinho"
    },
    en: {
        pageTitle: "Checkout | Lone Wolf",
        kicker: "Official Shop",
        heroTitle: "Checkout",
        heroPhrase: "Fill in your details to complete your order.",
        formTitle: "Complete Purchase",
        formSubtitle: "Enter your details to finish the order.",
        labelName: "Full Name",
        labelEmail: "Email",
        labelPhone: "Mobile",
        labelAddress: "Address",
        labelCity: "City",
        labelPostal: "Postal Code",
        labelPayment: "Payment Method",
        paymentSelect: "Select an option",
        paymentMbway: "MB Way",
        paymentTransfer: "Bank Transfer",
        paymentDelivery: "Pay on Delivery",
        labelNotes: "Notes",
        submitBtn: "Place Order",
        summaryTitle: "Summary",
        subtotal: "Subtotal",
        shipping: "Shipping",
        shippingFree: "€0.00",
        total: "Total",
        backCart: "Back to Cart"
    }
};</script>

<?php include "footer.php"; ?>

</body>
</html>
