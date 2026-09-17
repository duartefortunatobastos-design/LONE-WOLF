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
$novoTexto = trim($_POST["mensagem"] ?? "");

if ($mensagemId <= 0) {
    http_response_code(422);
    echo json_encode(["ok" => false, "erro" => "Mensagem invalida."]);
    exit();
}

$mensagemExistente = obter_mensagem_por_id($conn, $mensagemId);
if (!$mensagemExistente) {
    http_response_code(404);
    echo json_encode(["ok" => false, "erro" => "Mensagem nao encontrada."]);
    exit();
}

if ($novoTexto === "" && empty($mensagemExistente["anexo_url"])) {
    http_response_code(422);
    echo json_encode(["ok" => false, "erro" => "Mensagem invalida."]);
    exit();
}

$viewerRole = utilizador_admin() ? "admin" : "user";
$userId = intval($_SESSION["user_id"] ?? 0);
$email = $_SESSION["email"] ?? null;

if (!editar_mensagem_chat($conn, $mensagemId, $novoTexto, $viewerRole, $userId, $email)) {
    http_response_code(403);
    echo json_encode(["ok" => false, "erro" => "Nao foi possivel editar esta mensagem."]);
    exit();
}

$mensagem = obter_mensagem_por_id($conn, $mensagemId);

echo json_encode([
    "ok" => true,
    "mensagem" => formatar_mensagem_chat_api($mensagem, $viewerRole),
]);
