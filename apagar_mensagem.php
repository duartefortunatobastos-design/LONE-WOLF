<?php
require_once "includes/init.php";
require_once "includes/auth.php";

exigir_admin();

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $stmt = $conn->prepare("DELETE FROM mensagens WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: admin_mensagens.php");
exit();
