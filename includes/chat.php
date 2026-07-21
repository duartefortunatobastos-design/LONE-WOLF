<?php

require_once __DIR__ . "/migrate.php";

function migrar_mensagens_antigas(mysqli $conn): void
{
    if (!tabela_existe($conn, "mensagens")) {
        return;
    }

    $resultado = $conn->query("SELECT * FROM mensagens ORDER BY data_envio ASC");
    if (!$resultado) {
        return;
    }

    while ($linha = $resultado->fetch_assoc()) {
        $nome = trim($linha["nome"] ?? "Utilizador");
        $email = trim($linha["email"] ?? "");
        if ($email === "") {
            continue;
        }

        $userId = null;
        $stmtUser = $conn->prepare("SELECT id FROM utilizadores WHERE email = ? LIMIT 1");
        $stmtUser->bind_param("s", $email);
        $stmtUser->execute();
        $resUser = $stmtUser->get_result();
        if ($resUser && $resUser->num_rows > 0) {
            $userId = intval($resUser->fetch_assoc()["id"]);
        }
        $stmtUser->close();

        $conversaId = obter_ou_criar_conversa($conn, $userId, $nome, $email);

        if (trim($linha["mensagem"] ?? "") !== "") {
            inserir_mensagem_chat($conn, $conversaId, "user", $linha["mensagem"], $linha["data_envio"] ?? null);
        }

        if (trim($linha["resposta"] ?? "") !== "") {
            inserir_mensagem_chat($conn, $conversaId, "admin", $linha["resposta"], null);
        }
    }
}

function utilizador_bloqueado(mysqli $conn, int $userId): bool
{
    $stmt = $conn->prepare("SELECT bloqueado FROM utilizadores WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $utilizador = $resultado->fetch_assoc();
    $stmt->close();

    return !empty($utilizador["bloqueado"]);
}
function alternar_bloqueio_utilizador(mysqli $conn, int $userId): bool
{
    $stmt = $conn->prepare("SELECT tipo, bloqueado FROM utilizadores WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $utilizador = $resultado->fetch_assoc();
    $stmt->close();

    if (!$utilizador || ($utilizador["tipo"] ?? "") === "admin") {
        return false;
    }

    $novoEstado = empty($utilizador["bloqueado"]) ? 1 : 0;
    $stmt = $conn->prepare("UPDATE utilizadores SET bloqueado = ? WHERE id = ?");
    $stmt->bind_param("ii", $novoEstado, $userId);
    $ok = $stmt->execute();
    $stmt->close();

    return $ok;
}

function obter_ou_criar_conversa(mysqli $conn, ?int $userId, string $nome, string $email): int
{
    $stmt = $conn->prepare("SELECT id FROM conversas WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $conversa = $resultado->fetch_assoc();
    $stmt->close();

    if ($conversa) {
        $conversaId = intval($conversa["id"]);

        if ($userId) {
            $stmt = $conn->prepare("UPDATE conversas SET user_id = ?, nome = ? WHERE id = ?");
            $stmt->bind_param("isi", $userId, $nome, $conversaId);
            $stmt->execute();
            $stmt->close();
        }

        return $conversaId;
    }

    $stmt = $conn->prepare("INSERT INTO conversas (user_id, nome, email) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userId, $nome, $email);
    $stmt->execute();
    $conversaId = intval($stmt->insert_id);
    $stmt->close();

    return $conversaId;
}

function inserir_mensagem_chat(
    mysqli $conn,
    int $conversaId,
    string $autor,
    string $mensagem,
    ?string $dataEnvio = null,
    string $tipo = "text",
    ?string $anexoUrl = null,
    ?string $anexoNome = null
): bool {
    $mensagem = trim($mensagem);
    $tipo = in_array($tipo, ["text", "image", "video", "file"], true) ? $tipo : "text";
    $anexoUrl = $anexoUrl ? trim($anexoUrl) : null;
    $anexoNome = $anexoNome ? trim($anexoNome) : null;

    if (!in_array($autor, ["user", "admin"], true)) {
        return false;
    }

    if ($mensagem === "" && !$anexoUrl) {
        return false;
    }

    if ($dataEnvio) {
        $stmt = $conn->prepare("
            INSERT INTO chat_mensagens (conversa_id, autor, mensagem, tipo, anexo_url, anexo_nome, data_envio)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("issssss", $conversaId, $autor, $mensagem, $tipo, $anexoUrl, $anexoNome, $dataEnvio);
    } else {
        $stmt = $conn->prepare("
            INSERT INTO chat_mensagens (conversa_id, autor, mensagem, tipo, anexo_url, anexo_nome)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("isssss", $conversaId, $autor, $mensagem, $tipo, $anexoUrl, $anexoNome);
    }

    $ok = $stmt->execute();
    $stmt->close();

    if ($ok) {
        $stmt = $conn->prepare("UPDATE conversas SET atualizada_em = NOW() WHERE id = ?");
        $stmt->bind_param("i", $conversaId);
        $stmt->execute();
        $stmt->close();
    }

    return $ok;
}

function obter_conversa_por_id(mysqli $conn, int $conversaId): ?array
{
    $stmt = $conn->prepare("
        SELECT c.*, u.bloqueado
        FROM conversas c
        LEFT JOIN utilizadores u ON u.id = c.user_id
        WHERE c.id = ?
        LIMIT 1
    ");
    $stmt->bind_param("i", $conversaId);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $conversa = $resultado->fetch_assoc();
    $stmt->close();

    return $conversa ?: null;
}

function obter_conversa_por_email(mysqli $conn, string $email): ?array
{
    $stmt = $conn->prepare("
        SELECT c.*, u.bloqueado
        FROM conversas c
        LEFT JOIN utilizadores u ON u.id = c.user_id
        WHERE c.email = ?
        LIMIT 1
    ");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $conversa = $resultado->fetch_assoc();
    $stmt->close();

    return $conversa ?: null;
}

function listar_conversas(mysqli $conn): array
{
    $sql = "
        SELECT
            c.*,
            u.bloqueado,
            (
                SELECT cm.mensagem
                FROM chat_mensagens cm
                WHERE cm.conversa_id = c.id
                ORDER BY cm.id DESC
                LIMIT 1
            ) AS ultima_mensagem,
            (
                SELECT cm.autor
                FROM chat_mensagens cm
                WHERE cm.conversa_id = c.id
                ORDER BY cm.id DESC
                LIMIT 1
            ) AS ultimo_autor,
            (
                SELECT COUNT(*)
                FROM chat_mensagens cm
                WHERE cm.conversa_id = c.id AND cm.autor = 'user'
            ) AS total_user,
            (
                SELECT COUNT(*)
                FROM chat_mensagens cm
                WHERE cm.conversa_id = c.id AND cm.autor = 'admin'
            ) AS total_admin
        FROM conversas c
        LEFT JOIN utilizadores u ON u.id = c.user_id
        ORDER BY c.atualizada_em DESC
    ";

    $resultado = $conn->query($sql);
    $conversas = [];

    if ($resultado) {
        while ($linha = $resultado->fetch_assoc()) {
            $conversas[] = $linha;
        }
    }

    return $conversas;
}

function mensagem_tem_conteudo(array $mensagem): bool
{
    return trim($mensagem["mensagem"] ?? "") !== "" || !empty($mensagem["anexo_url"]);
}

function obter_mensagens_chat(mysqli $conn, int $conversaId, int $desdeId = 0): array
{
    $sqlBase = "
        SELECT id, autor, mensagem, tipo, anexo_url, anexo_nome, visualizada_em, data_envio
        FROM chat_mensagens
        WHERE conversa_id = ?
          AND (TRIM(mensagem) != '' OR anexo_url IS NOT NULL)
    ";

    if ($desdeId > 0) {
        $stmt = $conn->prepare($sqlBase . " AND id > ? ORDER BY id ASC");
        $stmt->bind_param("ii", $conversaId, $desdeId);
    } else {
        $stmt = $conn->prepare($sqlBase . " ORDER BY id ASC");
        $stmt->bind_param("i", $conversaId);
    }

    $stmt->execute();
    $resultado = $stmt->get_result();
    $mensagens = [];

    while ($linha = $resultado->fetch_assoc()) {
        if (mensagem_tem_conteudo($linha)) {
            $mensagens[] = $linha;
        }
    }

    $stmt->close();

    return $mensagens;
}

function marcar_mensagens_como_visualizadas(mysqli $conn, int $conversaId, string $autorDestino): void
{
    if (!in_array($autorDestino, ["user", "admin"], true)) {
        return;
    }

    $stmt = $conn->prepare("
        UPDATE chat_mensagens
        SET visualizada_em = NOW()
        WHERE conversa_id = ?
          AND autor = ?
          AND visualizada_em IS NULL
    ");
    $stmt->bind_param("is", $conversaId, $autorDestino);
    $stmt->execute();
    $stmt->close();
}

function contar_mensagens_nao_visualizadas(mysqli $conn, int $conversaId, string $autorDestino): int
{
    if (!in_array($autorDestino, ["user", "admin"], true)) {
        return 0;
    }

    $stmt = $conn->prepare("
        SELECT COUNT(*) AS total
        FROM chat_mensagens
        WHERE conversa_id = ?
          AND autor = ?
          AND visualizada_em IS NULL
          AND (TRIM(mensagem) != '' OR anexo_url IS NOT NULL)
    ");
    $stmt->bind_param("is", $conversaId, $autorDestino);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $linha = $resultado->fetch_assoc();
    $stmt->close();

    return intval($linha["total"] ?? 0);
}

function contar_todas_nao_visualizadas(mysqli $conn, string $autorDestino, ?string $emailUtilizador = null): int
{
    if (!in_array($autorDestino, ["user", "admin"], true)) {
        return 0;
    }

    if ($emailUtilizador) {
        $stmt = $conn->prepare("
            SELECT COUNT(*) AS total
            FROM chat_mensagens cm
            INNER JOIN conversas c ON c.id = cm.conversa_id
            WHERE cm.autor = ?
              AND cm.visualizada_em IS NULL
              AND c.email = ?
              AND (TRIM(cm.mensagem) != '' OR cm.anexo_url IS NOT NULL)
        ");
        $stmt->bind_param("ss", $autorDestino, $emailUtilizador);
    } else {
        $stmt = $conn->prepare("
            SELECT COUNT(*) AS total
            FROM chat_mensagens
            WHERE autor = ?
              AND visualizada_em IS NULL
              AND (TRIM(mensagem) != '' OR anexo_url IS NOT NULL)
        ");
        $stmt->bind_param("s", $autorDestino);
    }

    $stmt->execute();
    $resultado = $stmt->get_result();
    $linha = $resultado->fetch_assoc();
    $stmt->close();

    return intval($linha["total"] ?? 0);
}

function formatar_mensagem_chat_api(array $mensagem, string $viewerRole): array
{
    $autor = $mensagem["autor"] ?? "user";
    $mine = ($viewerRole === "admin" && $autor === "admin") || ($viewerRole === "user" && $autor === "user");

    return [
        "id" => intval($mensagem["id"]),
        "autor" => $autor,
        "mensagem" => $mensagem["mensagem"] ?? "",
        "tipo" => $mensagem["tipo"] ?? "text",
        "anexo_url" => $mensagem["anexo_url"] ?? null,
        "anexo_nome" => $mensagem["anexo_nome"] ?? null,
        "hora" => formatar_hora_chat($mensagem["data_envio"] ?? ""),
        "mine" => $mine,
        "visualizada" => !empty($mensagem["visualizada_em"]),
    ];
}

function guardar_anexo_chat(array $ficheiro): ?array
{
    if (($ficheiro["error"] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        return null;
    }

    $tamanhoMax = 25 * 1024 * 1024;
    if (($ficheiro["size"] ?? 0) > $tamanhoMax) {
        return null;
    }

    $nomeOriginal = basename($ficheiro["name"] ?? "ficheiro");
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
    $mime = mime_content_type($ficheiro["tmp_name"]) ?: ($ficheiro["type"] ?? "");

    $extensoesImagem = ["jpg", "jpeg", "png", "gif", "webp"];
    $extensoesVideo = ["mp4", "webm", "mov", "avi", "mkv"];
    $extensoesFicheiro = ["pdf", "doc", "docx", "txt", "zip"];

    $tipo = "file";
    if (in_array($extensao, $extensoesImagem, true) || strpos($mime, "image/") === 0) {
        $tipo = "image";
    } elseif (in_array($extensao, $extensoesVideo, true) || strpos($mime, "video/") === 0) {
        $tipo = "video";
    } elseif (!in_array($extensao, $extensoesFicheiro, true)) {
        return null;
    }

    $pasta = __DIR__ . "/../uploads/chat";
    if (!is_dir($pasta)) {
        mkdir($pasta, 0755, true);
    }

    $nomeGuardado = uniqid("chat_", true) . ($extensao ? "." . $extensao : "");
    $destino = $pasta . "/" . $nomeGuardado;

    if (!move_uploaded_file($ficheiro["tmp_name"], $destino)) {
        return null;
    }

    return [
        "tipo" => $tipo,
        "url" => "uploads/chat/" . $nomeGuardado,
        "nome" => $nomeOriginal,
    ];
}

function obter_ids_visualizados(mysqli $conn, int $conversaId, string $viewerRole): array
{
    $autorProprio = $viewerRole === "admin" ? "admin" : "user";
    $stmt = $conn->prepare("
        SELECT id
        FROM chat_mensagens
        WHERE conversa_id = ?
          AND autor = ?
          AND visualizada_em IS NOT NULL
          AND (TRIM(mensagem) != '' OR anexo_url IS NOT NULL)
    ");
    $stmt->bind_param("is", $conversaId, $autorProprio);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $ids = [];
    while ($linha = $resultado->fetch_assoc()) {
        $ids[] = intval($linha["id"]);
    }
    $stmt->close();
    return $ids;
}

function formatar_hora_chat(string $data): string
{
    $timestamp = strtotime($data);
    if (!$timestamp) {
        return "";
    }

    $hoje = date("Y-m-d");
    $diaMensagem = date("Y-m-d", $timestamp);

    if ($diaMensagem === $hoje) {
        return date("H:i", $timestamp);
    }

    return date("d/m H:i", $timestamp);
}

function bolha_e_minha(array $mensagem, string $viewerRole): bool
{
    $autor = $mensagem["autor"] ?? "user";
    return ($viewerRole === "admin" && $autor === "admin") || ($viewerRole === "user" && $autor === "user");
}

function renderizar_conteudo_bolha(array $mensagem): string
{
    $html = "";
    $tipo = $mensagem["tipo"] ?? "text";
    $anexoUrl = $mensagem["anexo_url"] ?? null;
    $anexoNome = htmlspecialchars($mensagem["anexo_nome"] ?? "Anexo");
    $texto = trim($mensagem["mensagem"] ?? "");

    if ($anexoUrl) {
        $url = htmlspecialchars($anexoUrl);
        if ($tipo === "image") {
            $html .= '<a href="' . $url . '" target="_blank" rel="noopener noreferrer" class="chat-anexo-imagem">';
            $html .= '<img src="' . $url . '" alt="' . $anexoNome . '">';
            $html .= "</a>";
        } elseif ($tipo === "video") {
            $html .= '<video class="chat-anexo-video" controls preload="metadata">';
            $html .= '<source src="' . $url . '">';
            $html .= "</video>";
        } else {
            $html .= '<a href="' . $url . '" target="_blank" rel="noopener noreferrer" class="chat-anexo-ficheiro">';
            $html .= '<i class="fa-solid fa-paperclip"></i> ' . $anexoNome;
            $html .= "</a>";
        }
    }

    if ($texto !== "") {
        $html .= '<div class="chat-bubble-text">' . nl2br(htmlspecialchars($texto)) . "</div>";
    }

    return $html;
}

function conversa_precisa_resposta(mysqli $conn, int $conversaId): bool
{
    $stmt = $conn->prepare("
        SELECT autor
        FROM chat_mensagens
        WHERE conversa_id = ?
          AND (TRIM(mensagem) != '' OR anexo_url IS NOT NULL)
        ORDER BY id DESC
        LIMIT 1
    ");
    $stmt->bind_param("i", $conversaId);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $linha = $resultado->fetch_assoc();
    $stmt->close();

    return ($linha["autor"] ?? "") === "user";
}

function contar_conversas_pendentes_admin(mysqli $conn): int
{
    $resultado = $conn->query("
        SELECT COUNT(*) AS total
        FROM conversas c
        WHERE (
            SELECT cm.autor
            FROM chat_mensagens cm
            WHERE cm.conversa_id = c.id
              AND (TRIM(cm.mensagem) != '' OR cm.anexo_url IS NOT NULL)
            ORDER BY cm.id DESC
            LIMIT 1
        ) = 'user'
    ");
    $linha = $resultado ? $resultado->fetch_assoc() : null;

    return intval($linha["total"] ?? 0);
}

function obter_mensagem_por_id(mysqli $conn, int $mensagemId): ?array
{
    $stmt = $conn->prepare("
        SELECT cm.*, c.email, c.user_id
        FROM chat_mensagens cm
        INNER JOIN conversas c ON c.id = cm.conversa_id
        WHERE cm.id = ?
        LIMIT 1
    ");
    $stmt->bind_param("i", $mensagemId);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $linha = $resultado->fetch_assoc();
    $stmt->close();

    return $linha ?: null;
}

function apagar_ficheiro_anexo(?string $anexoUrl): void
{
    if (!$anexoUrl) {
        return;
    }

    $caminho = __DIR__ . "/../" . ltrim($anexoUrl, "/");
    if (is_file($caminho)) {
        unlink($caminho);
    }
}

function utilizador_pode_gerir_mensagem(array $mensagem, string $viewerRole, ?int $userId, ?string $email): bool
{
    if ($viewerRole === "admin") {
        return ($mensagem["autor"] ?? "") === "admin";
    }

    if ($viewerRole === "user" && $userId && intval($mensagem["user_id"]) === $userId) {
        return ($mensagem["autor"] ?? "") === "user";
    }

    if ($viewerRole === "user" && $email && strcasecmp($mensagem["email"] ?? "", $email) === 0) {
        return ($mensagem["autor"] ?? "") === "user";
    }

    return false;
}

function editar_mensagem_chat(mysqli $conn, int $mensagemId, string $novoTexto, string $viewerRole, ?int $userId, ?string $email): bool
{
    $mensagem = obter_mensagem_por_id($conn, $mensagemId);
    if (!$mensagem || !utilizador_pode_gerir_mensagem($mensagem, $viewerRole, $userId, $email)) {
        return false;
    }

    $novoTexto = trim($novoTexto);
    if ($novoTexto === "" && empty($mensagem["anexo_url"])) {
        return false;
    }

    $stmt = $conn->prepare("UPDATE chat_mensagens SET mensagem = ? WHERE id = ?");
    $stmt->bind_param("si", $novoTexto, $mensagemId);
    $ok = $stmt->execute();
    $stmt->close();

    return $ok;
}

function apagar_mensagem_chat(mysqli $conn, int $mensagemId, string $viewerRole, ?int $userId, ?string $email): bool
{
    $mensagem = obter_mensagem_por_id($conn, $mensagemId);
    if (!$mensagem || !utilizador_pode_gerir_mensagem($mensagem, $viewerRole, $userId, $email)) {
        return false;
    }

    apagar_ficheiro_anexo($mensagem["anexo_url"] ?? null);

    $stmt = $conn->prepare("DELETE FROM chat_mensagens WHERE id = ?");
    $stmt->bind_param("i", $mensagemId);
    $ok = $stmt->execute();
    $stmt->close();

    if ($ok) {
        $conversaId = intval($mensagem["conversa_id"]);
        $stmt = $conn->prepare("UPDATE conversas SET atualizada_em = NOW() WHERE id = ?");
        $stmt->bind_param("i", $conversaId);
        $stmt->execute();
        $stmt->close();
    }

    return $ok;
}

function apagar_conversa_chat(mysqli $conn, int $conversaId): bool
{
    $mensagens = obter_mensagens_chat($conn, $conversaId);
    foreach ($mensagens as $msg) {
        apagar_ficheiro_anexo($msg["anexo_url"] ?? null);
    }

    $stmt = $conn->prepare("DELETE FROM conversas WHERE id = ?");
    $stmt->bind_param("i", $conversaId);
    $ok = $stmt->execute();
    $stmt->close();

    return $ok;
}

function renderizar_acoes_bolha(bool $mine, int $mensagemId): string
{
    if (!$mine) {
        return "";
    }

    return '
        <div class="chat-bubble-actions">
            <button type="button" class="chat-action-btn" data-action="edit" data-id="' . $mensagemId . '" title="Editar">
                <i class="fa-solid fa-pen"></i>
            </button>
            <button type="button" class="chat-action-btn" data-action="delete" data-id="' . $mensagemId . '" title="Apagar">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
    ';
}
