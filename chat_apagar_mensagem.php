<?php
require_once "includes/init.php";
require_once "includes/auth.php";
require_once "includes/chat.php";

header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["ok" => false, "erro" => "Metodo nao permitido."]);
    exit();
}

if (!utilizador_autenticado()) {
    http_response_code(401);
    echo json_encode(["ok" => false, "erro" => "Precisas de iniciar sessao."]);
    exit();
}

$mensagemId = intval($_POST["mensagem_id"] ?? 0);

if ($mensagemId <= 0) {
    http_response_code(422);
    echo json_encode(["ok" => false, "erro" => "Mensagem invalida."]);
    exit();
}

$viewerRole = utilizador_admin() ? "admin" : "user";
$userId = intval($_SESSION["user_id"] ?? 0);
$email = $_SESSION["email"] ?? null;

if (!apagar_mensagem_chat($conn, $mensagemId, $viewerRole, $userId, $email)) {
    http_response_code(403);
    echo json_encode(["ok" => false, "erro" => "Nao foi possivel apagar esta mensagem."]);
    exit();
}

echo json_encode(["ok" => true, "id" => $mensagemId]);
