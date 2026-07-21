<?php
require_once "includes/init.php";
require_once "includes/auth.php";
require_once "includes/chat.php";

exigir_admin();

$conversaId = intval($_GET["conversa"] ?? $_POST["conversa_id"] ?? 0);

$secao = $_GET["secao"] ?? "conversas";
$redirect = "admin_mensagens.php?secao=" . urlencode($secao);

if ($conversaId <= 0) {
    header("Location: {$redirect}&erro=apagar");
    exit();
}

if (!apagar_conversa_chat($conn, $conversaId)) {
    header("Location: {$redirect}&erro=apagar");
    exit();
}

header("Location: {$redirect}&sucesso=apagar");
exit();
