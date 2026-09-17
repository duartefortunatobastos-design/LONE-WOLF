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

$conversaId = intval($_POST["conversa_id"] ?? 0);
$mensagem = trim($_POST["mensagem"] ?? "");

if ($conversaId <= 0) {
    http_response_code(422);
    echo json_encode(["ok" => false, "erro" => "Conversa invalida."]);
    exit();
}

$conversa = obter_conversa_por_id($conn, $conversaId);
if (!$conversa) {
    http_response_code(404);
    echo json_encode(["ok" => false, "erro" => "Conversa nao encontrada."]);
    exit();
}

$autor = null;
$viewerRole = null;

if (utilizador_admin()) {
    $autor = "admin";
    $viewerRole = "admin";
} elseif (utilizador_autenticado()) {
    if (utilizador_bloqueado($conn, intval($_SESSION["user_id"]))) {
        http_response_code(403);
        echo json_encode(["ok" => false, "erro" => "A tua conta esta bloqueada."]);
        exit();
    }

    if (strcasecmp($conversa["email"], $_SESSION["email"] ?? "") !== 0) {
        http_response_code(403);
        echo json_encode(["ok" => false, "erro" => "Sem permissao para esta conversa."]);
        exit();
    }

    $autor = "user";
    $viewerRole = "user";
} else {
    http_response_code(401);
    echo json_encode(["ok" => false, "erro" => "Precisas de iniciar sessao."]);
    exit();
}

if ($autor === "admin" && !empty($conversa["bloqueado"])) {
    http_response_code(403);
    echo json_encode(["ok" => false, "erro" => "Este utilizador esta bloqueado."]);
    exit();
}

$tipo = "text";
$anexoUrl = null;
$anexoNome = null;

if (!empty($_FILES["anexo"]["name"])) {
    $anexo = guardar_anexo_chat($_FILES["anexo"]);
    if (!$anexo) {
        http_response_code(422);
        echo json_encode(["ok" => false, "erro" => "Ficheiro invalido ou demasiado grande (max. 25 MB)."]);
        exit();
    }
    $tipo = $anexo["tipo"];
    $anexoUrl = $anexo["url"];
    $anexoNome = $anexo["nome"];
}

if ($mensagem === "" && !$anexoUrl) {
    http_response_code(422);
    echo json_encode(["ok" => false, "erro" => "Escreve uma mensagem ou anexa um ficheiro."]);
    exit();
}

if (!inserir_mensagem_chat($conn, $conversaId, $autor, $mensagem, null, $tipo, $anexoUrl, $anexoNome)) {
    http_response_code(500);
    echo json_encode(["ok" => false, "erro" => "Erro ao guardar mensagem."]);
    exit();
}

$ultima = obter_mensagens_chat($conn, $conversaId);
$nova = end($ultima);

echo json_encode([
    "ok" => true,
    "mensagem" => formatar_mensagem_chat_api($nova, $viewerRole),
]);
