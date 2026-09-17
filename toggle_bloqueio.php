<?php
require_once "includes/init.php";
require_once "includes/auth.php";
require_once "includes/chat.php";

exigir_admin();

$userId = intval($_GET["id"] ?? 0);

if ($userId <= 0 || !alternar_bloqueio_utilizador($conn, $userId)) {
    header("Location: admin_mensagens.php?secao=contas&erro=bloqueio");
    exit();
}

header("Location: admin_mensagens.php?secao=contas&sucesso=bloqueio");
exit();
