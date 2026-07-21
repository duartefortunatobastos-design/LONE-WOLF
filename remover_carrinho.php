<?php
require_once "includes/init.php";

$chave = $_GET["chave"] ?? $_GET["id"] ?? "";

if ($chave !== "" && isset($_SESSION["carrinho"][$chave])) {
    unset($_SESSION["carrinho"][$chave]);
} elseif (is_numeric($chave) && isset($_SESSION["carrinho"][(int) $chave])) {
    unset($_SESSION["carrinho"][(int) $chave]);
}

header("Location: carrinho.php");
exit;
