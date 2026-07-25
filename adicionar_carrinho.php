<?php
require_once "includes/init.php";

bloquear_loja_se_inactiva();

$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
$tamanho = trim($_GET["tamanho"] ?? "");
$cor = trim($_GET["cor"] ?? "");

$produto = $id > 0 ? obter_produto($conn, $id) : null;

if (!$produto) {
    header("Location: loja.php");
    exit;
}

$tamanhos = parse_lista_csv($produto["tamanhos"] ?? "");
$cores = parse_lista_csv($produto["cores"] ?? "");

if (!empty($tamanhos) && ($tamanho === "" || !in_array($tamanho, $tamanhos, true))) {
    header("Location: produto.php?id=" . $id);
    exit;
}

if (!empty($cores) && ($cor === "" || !in_array($cor, $cores, true))) {
    header("Location: produto.php?id=" . $id);
    exit;
}

if (!isset($_SESSION["carrinho"])) {
    $_SESSION["carrinho"] = [];
}

$chave = $id . "|" . $tamanho . "|" . $cor;

if (isset($_SESSION["carrinho"][$chave])) {
    $_SESSION["carrinho"][$chave]["quantidade"] += 1;
} else {
    $_SESSION["carrinho"][$chave] = [
        "id" => $produto["id"],
        "chave" => $chave,
        "nome" => $produto["nome"],
        "preco" => floatval($produto["preco"]),
        "imagem" => $produto["imagem"],
        "tamanho" => $tamanho,
        "cor" => $cor,
        "quantidade" => 1,
    ];
}

header("Location: carrinho.php");
exit;
