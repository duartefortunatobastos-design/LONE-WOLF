<?php
require_once "includes/init.php";
require_once "includes/auth.php";
require_once "includes/chat.php";

exigir_admin();

$userId = intval($_GET["id"] ?? 0);

$secao = $_GET["secao"] ?? "contas";
$redirect = "admin_mensagens.php?secao=" . urlencode($secao);

if ($userId <= 0 || !alternar_bloqueio_utilizador($conn, $userId)) {
    header("Location: {$redirect}&erro=bloqueio");
    exit();
}

header("Location: {$redirect}&sucesso=bloqueio");
exit();
