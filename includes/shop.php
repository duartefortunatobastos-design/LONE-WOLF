<?php

function obter_produtos(mysqli $conn, bool $apenasActivos = true): array
{
    $sql = "SELECT * FROM produtos";
    if ($apenasActivos) {
        $sql .= " WHERE activo = 1";
    }
    $sql .= " ORDER BY ordem ASC, id ASC";

    $resultado = $conn->query($sql);
    $produtos = [];

    if ($resultado) {
        while ($row = $resultado->fetch_assoc()) {
            $produtos[] = $row;
        }
    }

    return $produtos;
}

function obter_produto(mysqli $conn, int $id): ?array
{
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ? AND activo = 1 LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $produto = $resultado->fetch_assoc() ?: null;
    $stmt->close();

    return $produto;
}

function formatar_preco(float $preco): string
{
    return number_format($preco, 2, ",", ".") . "€";
}

function parse_lista_csv(?string $valor): array
{
    if ($valor === null || trim($valor) === "") {
        return [];
    }

    return array_values(array_filter(array_map("trim", explode(",", $valor))));
}

function criar_encomenda(mysqli $conn, array $dados, array $itensCarrinho): int
{
    $stmt = $conn->prepare("
        INSERT INTO encomendas (user_id, nome, email, telefone, morada, localidade, codigo_postal, metodo_pagamento, observacoes, total, estado)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pendente')
    ");

    $userId = $dados["user_id"] ?? null;
    $observacoes = $dados["observacoes"] ?? "";

    $stmt->bind_param(
        "issssssssd",
        $userId,
        $dados["nome"],
        $dados["email"],
        $dados["telefone"],
        $dados["morada"],
        $dados["localidade"],
        $dados["codigo_postal"],
        $dados["metodo_pagamento"],
        $observacoes,
        $dados["total"]
    );
    $stmt->execute();
    $encomendaId = intval($stmt->insert_id);
    $stmt->close();

    $stmtItem = $conn->prepare("
        INSERT INTO encomenda_itens (encomenda_id, produto_id, nome, tamanho, cor, preco, quantidade)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    foreach ($itensCarrinho as $item) {
        $produtoId = intval($item["id"]);
        $nome = $item["nome"];
        $tamanho = $item["tamanho"] ?? "";
        $cor = $item["cor"] ?? "";
        $preco = floatval($item["preco"]);
        $quantidade = intval($item["quantidade"]);
        $stmtItem->bind_param("iisssdi", $encomendaId, $produtoId, $nome, $tamanho, $cor, $preco, $quantidade);
        $stmtItem->execute();
    }
    $stmtItem->close();

    return $encomendaId;
}

function obter_encomenda(mysqli $conn, int $id): ?array
{
    $stmt = $conn->prepare("SELECT * FROM encomendas WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $encomenda = $stmt->get_result()->fetch_assoc() ?: null;
    $stmt->close();

    return $encomenda;
}

function obter_itens_encomenda(mysqli $conn, int $encomendaId): array
{
    $stmt = $conn->prepare("SELECT * FROM encomenda_itens WHERE encomenda_id = ? ORDER BY id ASC");
    $stmt->bind_param("i", $encomendaId);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $itens = [];

    while ($row = $resultado->fetch_assoc()) {
        $itens[] = $row;
    }

    $stmt->close();
    return $itens;
}

function listar_encomendas_utilizador(mysqli $conn, int $userId): array
{
    $stmt = $conn->prepare("SELECT * FROM encomendas WHERE user_id = ? ORDER BY criada_em DESC");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $lista = [];

    while ($row = $resultado->fetch_assoc()) {
        $lista[] = $row;
    }

    $stmt->close();
    return $lista;
}

function listar_todas_encomendas(mysqli $conn): array
{
    $resultado = $conn->query("SELECT * FROM encomendas ORDER BY criada_em DESC");
    $lista = [];

    if ($resultado) {
        while ($row = $resultado->fetch_assoc()) {
            $lista[] = $row;
        }
    }

    return $lista;
}

function actualizar_estado_encomenda(mysqli $conn, int $id, string $estado): bool
{
    $permitidos = ["pendente", "pago", "enviado", "concluido", "cancelado"];
    if (!in_array($estado, $permitidos, true)) {
        return false;
    }

    $stmt = $conn->prepare("UPDATE encomendas SET estado = ? WHERE id = ?");
    $stmt->bind_param("si", $estado, $id);
    $ok = $stmt->execute();
    $stmt->close();

    return $ok;
}

function obter_provas_futuras(mysqli $conn): array
{
    $resultado = $conn->query("SELECT * FROM provas_futuras WHERE data_prova >= CURDATE() ORDER BY data_prova ASC, ordem ASC");
    $lista = [];

    if ($resultado) {
        while ($row = $resultado->fetch_assoc()) {
            $lista[] = $row;
        }
    }

    return $lista;
}

function obter_blog_posts(mysqli $conn, int $limite = 20): array
{
    $stmt = $conn->prepare("SELECT * FROM blog_posts WHERE activo = 1 ORDER BY publicado_em DESC LIMIT ?");
    $stmt->bind_param("i", $limite);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $posts = [];

    while ($row = $resultado->fetch_assoc()) {
        $posts[] = $row;
    }

    $stmt->close();
    return $posts;
}

function obter_blog_post_por_slug(mysqli $conn, string $slug): ?array
{
    $stmt = $conn->prepare("SELECT * FROM blog_posts WHERE slug = ? AND activo = 1 LIMIT 1");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $post = $stmt->get_result()->fetch_assoc() ?: null;
    $stmt->close();

    return $post;
}

function registar_newsletter(mysqli $conn, string $email): bool
{
    $email = trim(strtolower($email));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    $stmt = $conn->prepare("INSERT IGNORE INTO newsletter (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    $ok = $stmt->execute() && $stmt->affected_rows > 0;
    $stmt->close();

    return $ok;
}

function label_metodo_pagamento(string $metodo): string
{
    return match ($metodo) {
        "mbway" => "MB Way",
        "transferencia" => "Transferência Bancária",
        "entrega" => "Pagamento na Entrega",
        default => ucfirst($metodo),
    };
}

function label_estado_encomenda(string $estado): string
{
    return match ($estado) {
        "pendente" => "Pendente",
        "pago" => "Pago",
        "enviado" => "Enviado",
        "concluido" => "Concluído",
        "cancelado" => "Cancelado",
        default => ucfirst($estado),
    };
}
