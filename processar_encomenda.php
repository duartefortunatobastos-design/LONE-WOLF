<?php
require_once "includes/init.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: checkout.php");
    exit;
}

if (empty($_SESSION["carrinho"])) {
    header("Location: carrinho.php");
    exit;
}

if (!isset($_SESSION["user_id"])) {
    $_SESSION["redirect_after_login"] = "checkout.php";
    header("Location: login.php");
    exit;
}

$nome = trim($_POST["nome"] ?? "");
$email = trim($_POST["email"] ?? "");
$telefone = trim($_POST["telefone"] ?? "");
$morada = trim($_POST["morada"] ?? "");
$localidade = trim($_POST["localidade"] ?? "");
$codigo_postal = trim($_POST["codigo_postal"] ?? "");
$metodo = trim($_POST["metodo_pagamento"] ?? "");
$observacoes = trim($_POST["observacoes"] ?? "");

if ($nome === "" || $email === "" || $telefone === "" || $morada === "" || $localidade === "" || $codigo_postal === "" || $metodo === "") {
    $_SESSION["checkout_erro"] = "Preenche todos os campos obrigatórios.";
    header("Location: checkout.php");
    exit;
}

$total = 0;
foreach ($_SESSION["carrinho"] as $item) {
    $total += floatval($item["preco"]) * intval($item["quantidade"]);
}

$userId = intval($_SESSION["user_id"]);

$encomendaId = criar_encomenda($conn, [
    "user_id" => $userId,
    "nome" => $nome,
    "email" => $email,
    "telefone" => $telefone,
    "morada" => $morada,
    "localidade" => $localidade,
    "codigo_postal" => $codigo_postal,
    "metodo_pagamento" => label_metodo_pagamento($metodo),
    "observacoes" => $observacoes,
    "total" => $total,
], array_values($_SESSION["carrinho"]));

$encomenda = obter_encomenda($conn, $encomendaId);
$itens = obter_itens_encomenda($conn, $encomendaId);

if ($encomenda) {
    email_encomenda_cliente($encomenda, $itens);
    email_encomenda_admin($encomenda, $itens);
}

$_SESSION["ultima_encomenda_id"] = $encomendaId;
$_SESSION["carrinho"] = [];

header("Location: encomenda-sucesso.php?id=" . $encomendaId);
exit;
