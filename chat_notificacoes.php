<?php
require_once "includes/init.php";
require_once "includes/auth.php";
require_once "includes/chat.php";

header("Content-Type: application/json; charset=utf-8");

if (!utilizador_autenticado()) {
    http_response_code(401);
    echo json_encode(["ok" => false, "erro" => "Precisas de iniciar sessao."]);
    exit();
}

$emailFiltro = utilizador_admin() ? null : ($_SESSION["email"] ?? "");

if (utilizador_admin()) {
    $naoLidas = contar_conversas_pendentes_admin($conn);
} else {
    $naoLidas = contar_todas_nao_visualizadas($conn, "admin", $emailFiltro);
}

$ultimaPreview = "";
$ultimaConversaId = 0;

if (utilizador_admin()) {
    $stmt = $conn->prepare("
        SELECT c.id AS conversa_id, cm.mensagem, cm.tipo, cm.anexo_nome, c.nome
        FROM conversas c
        INNER JOIN chat_mensagens cm ON cm.conversa_id = c.id
        WHERE cm.id = (
            SELECT cm2.id
            FROM chat_mensagens cm2
            WHERE cm2.conversa_id = c.id
              AND (TRIM(cm2.mensagem) != '' OR cm2.anexo_url IS NOT NULL)
            ORDER BY cm2.id DESC
            LIMIT 1
        )
        AND cm.autor = 'user'
        ORDER BY cm.id DESC
        LIMIT 1
    ");
} else {
    $email = $_SESSION["email"] ?? "";
    $stmt = $conn->prepare("
        SELECT cm.conversa_id, cm.mensagem, cm.tipo, cm.anexo_nome
        FROM chat_mensagens cm
        INNER JOIN conversas c ON c.id = cm.conversa_id
        WHERE cm.autor = 'admin'
          AND cm.visualizada_em IS NULL
          AND c.email = ?
          AND (TRIM(cm.mensagem) != '' OR cm.anexo_url IS NOT NULL)
        ORDER BY cm.id DESC
        LIMIT 1
    ");
    $stmt->bind_param("s", $email);
}

$stmt->execute();
$resultado = $stmt->get_result();
if ($linha = $resultado->fetch_assoc()) {
    $ultimaConversaId = intval($linha["conversa_id"]);
    if (trim($linha["mensagem"] ?? "") !== "") {
        $ultimaPreview = mb_strimwidth($linha["mensagem"], 0, 80, "...");
    } elseif (($linha["tipo"] ?? "") === "image") {
        $ultimaPreview = "Enviou uma foto";
    } elseif (($linha["tipo"] ?? "") === "video") {
        $ultimaPreview = "Enviou um video";
    } else {
        $ultimaPreview = "Enviou um ficheiro";
    }
}
$stmt->close();

echo json_encode([
    "ok" => true,
    "nao_lidas" => $naoLidas,
    "preview" => $ultimaPreview,
    "conversa_id" => $ultimaConversaId,
    "titulo" => utilizador_admin() ? "Nova mensagem de utilizador" : "Nova resposta da Lone Wolf",
]);
