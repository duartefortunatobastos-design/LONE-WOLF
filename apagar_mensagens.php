<?php
session_start();
include("ligacao.php");

// Proteção: só admins podem aceder
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Apagar a mensagem
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // garante que é um número inteiro
    $stmt = $conn->prepare("DELETE FROM mensagens WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Redirecionar de volta para o painel
header("Location: admin_mensagens.php");
exit();
?>