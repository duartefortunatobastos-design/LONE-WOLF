<?php
require_once "includes/init.php";
require_once "includes/auth.php";
require_once "includes/chat.php";

header("Content-Type: application/json; charset=utf-8");

$conversaId = intval($_GET["conversa_id"] ?? 0);
$desdeId = intval($_GET["desde_id"] ?? 0);

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

$viewerRole = null;

if (utilizador_admin()) {
    $viewerRole = "admin";
} elseif (utilizador_autenticado()) {
    if (strcasecmp($conversa["email"], $_SESSION["email"] ?? "") !== 0) {
        http_response_code(403);
        echo json_encode(["ok" => false, "erro" => "Sem permissao."]);
        exit();
    }
    $viewerRole = "user";
} else {
    http_response_code(401);
    echo json_encode(["ok" => false, "erro" => "Precisas de iniciar sessao."]);
    exit();
}

$autorParaMarcar = $viewerRole === "admin" ? "user" : "admin";
marcar_mensagens_como_visualizadas($conn, $conversaId, $autorParaMarcar);

$mensagens = obter_mensagens_chat($conn, $conversaId, $desdeId);
$saida = [];

foreach ($mensagens as $mensagem) {
    $saida[] = formatar_mensagem_chat_api($mensagem, $viewerRole);
}

if ($desdeId === 0) {
    $todas = obter_mensagens_chat($conn, $conversaId);
    foreach ($todas as &$msg) {
        if (($viewerRole === "admin" && $msg["autor"] === "admin") ||
            ($viewerRole === "user" && $msg["autor"] === "user")) {
            $msg["visualizada_em"] = $msg["visualizada_em"] ?? null;
        }
    }
    unset($msg);
}

echo json_encode([
    "ok" => true,
    "mensagens" => $saida,
    "visualizadas" => obter_ids_visualizados($conn, $conversaId, $viewerRole),
]);
