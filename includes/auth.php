<?php

function utilizador_autenticado(): bool
{
    return isset($_SESSION["user_id"]);
}

function utilizador_admin(): bool
{
    return utilizador_autenticado() && ($_SESSION["tipo"] ?? "") === "admin";
}

function exigir_login(string $redirect = "login.php"): void
{
    if (!utilizador_autenticado()) {
        header("Location: " . $redirect);
        exit();
    }
}

function exigir_admin(string $redirect = "index.php"): void
{
    if (!utilizador_admin()) {
        header("Location: " . $redirect);
        exit();
    }
}

function apagar_utilizador(mysqli $conn, int $userId, int $adminId): bool
{
    if ($userId <= 0 || $userId === $adminId) {
        return false;
    }

    $stmt = $conn->prepare("SELECT id, email, tipo FROM utilizadores WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $utilizador = $resultado ? $resultado->fetch_assoc() : null;
    $stmt->close();

    if (!$utilizador || ($utilizador["tipo"] ?? "") === "admin") {
        return false;
    }

    require_once __DIR__ . "/chat.php";

    $conversa = obter_conversa_por_email($conn, $utilizador["email"]);
    if ($conversa) {
        apagar_conversa_chat($conn, intval($conversa["id"]));
    }

    $stmt = $conn->prepare("DELETE FROM encomendas WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM favoritos WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM utilizadores WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $ok = $stmt->execute();
    $stmt->close();

    return $ok;
}
