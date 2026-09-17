<?php
require_once "includes/init.php";
require_once "includes/auth.php";

exigir_admin();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: admin_mensagens.php?secao=contas&erro=apagar_conta");
    exit();
}

$userId = intval($_POST["user_id"] ?? 0);
$adminId = intval($_SESSION["user_id"] ?? 0);

if ($userId <= 0 || !apagar_utilizador($conn, $userId, $adminId)) {
    header("Location: admin_mensagens.php?secao=contas&erro=apagar_conta");
    exit();
}

header("Location: admin_mensagens.php?secao=contas&sucesso=apagar_conta");
exit();
