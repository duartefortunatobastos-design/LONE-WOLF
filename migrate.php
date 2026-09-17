<?php

function coluna_existe(mysqli $conn, string $tabela, string $coluna): bool
{
    if (!tabela_existe($conn, $tabela)) {
        return false;
    }

    $tabela = $conn->real_escape_string($tabela);
    $coluna = $conn->real_escape_string($coluna);
    $resultado = $conn->query("SHOW COLUMNS FROM `{$tabela}` LIKE '{$coluna}'");

    return $resultado && $resultado->num_rows > 0;
}

function tabela_existe(mysqli $conn, string $tabela): bool
{
    $tabela = $conn->real_escape_string($tabela);
    $resultado = $conn->query("SHOW TABLES LIKE '{$tabela}'");

    return $resultado && $resultado->num_rows > 0;
}

function executar_migracoes(mysqli $conn): void
{
    if (!tabela_existe($conn, "utilizadores")) {
        $conn->query("
            CREATE TABLE utilizadores (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                tipo VARCHAR(20) NOT NULL DEFAULT 'user',
                bloqueado TINYINT(1) NOT NULL DEFAULT 0,
                criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                UNIQUE KEY email_unico (email)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    } elseif (!coluna_existe($conn, "utilizadores", "bloqueado")) {
        $conn->query("ALTER TABLE utilizadores ADD COLUMN bloqueado TINYINT(1) NOT NULL DEFAULT 0");
    }

    if (!tabela_existe($conn, "conversas")) {
        $conn->query("
            CREATE TABLE conversas (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NULL,
                nome VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                criada_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                atualizada_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                UNIQUE KEY email_unico (email)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    }

    if (!tabela_existe($conn, "chat_mensagens")) {
        $conn->query("
            CREATE TABLE chat_mensagens (
                id INT AUTO_INCREMENT PRIMARY KEY,
                conversa_id INT NOT NULL,
                autor ENUM('user', 'admin') NOT NULL,
                mensagem TEXT NOT NULL,
                tipo ENUM('text', 'image', 'video', 'file') NOT NULL DEFAULT 'text',
                anexo_url VARCHAR(500) NULL,
                anexo_nome VARCHAR(255) NULL,
                visualizada_em DATETIME NULL,
                data_envio DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_conversa (conversa_id),
                CONSTRAINT fk_chat_conversa FOREIGN KEY (conversa_id) REFERENCES conversas(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    } else {
        if (!coluna_existe($conn, "chat_mensagens", "tipo")) {
            $conn->query("ALTER TABLE chat_mensagens ADD COLUMN tipo ENUM('text', 'image', 'video', 'file') NOT NULL DEFAULT 'text' AFTER mensagem");
        }
        if (!coluna_existe($conn, "chat_mensagens", "anexo_url")) {
            $conn->query("ALTER TABLE chat_mensagens ADD COLUMN anexo_url VARCHAR(500) NULL AFTER tipo");
        }
        if (!coluna_existe($conn, "chat_mensagens", "anexo_nome")) {
            $conn->query("ALTER TABLE chat_mensagens ADD COLUMN anexo_nome VARCHAR(255) NULL AFTER anexo_url");
        }
        if (!coluna_existe($conn, "chat_mensagens", "visualizada_em")) {
            $conn->query("ALTER TABLE chat_mensagens ADD COLUMN visualizada_em DATETIME NULL AFTER anexo_nome");
        }

        $conn->query("DELETE FROM chat_mensagens WHERE TRIM(mensagem) = '' AND (anexo_url IS NULL OR anexo_url = '')");
    }

    if (!tabela_existe($conn, "config_site")) {
        $conn->query("
            CREATE TABLE config_site (
                chave VARCHAR(100) PRIMARY KEY,
                valor VARCHAR(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    }

    if (!tabela_existe($conn, "produtos")) {
        $conn->query("
            CREATE TABLE produtos (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                nome_en VARCHAR(255) NULL,
                descricao TEXT NULL,
                descricao_en TEXT NULL,
                preco DECIMAL(10,2) NOT NULL,
                imagem VARCHAR(500) NOT NULL,
                categoria VARCHAR(100) NOT NULL DEFAULT 'Vestuário',
                categoria_en VARCHAR(100) NULL,
                badge VARCHAR(80) NULL,
                badge_en VARCHAR(80) NULL,
                tamanhos VARCHAR(255) NULL,
                cores VARCHAR(255) NULL,
                activo TINYINT(1) NOT NULL DEFAULT 1,
                ordem INT NOT NULL DEFAULT 0,
                criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    } else {
        actualizar_schema_produtos($conn);
    }

    if (!tabela_existe($conn, "encomendas")) {
        $conn->query("
            CREATE TABLE encomendas (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NULL,
                nome VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                telefone VARCHAR(50) NOT NULL,
                morada VARCHAR(500) NOT NULL,
                localidade VARCHAR(120) NOT NULL,
                codigo_postal VARCHAR(20) NOT NULL,
                metodo_pagamento VARCHAR(50) NOT NULL,
                observacoes TEXT NULL,
                total DECIMAL(10,2) NOT NULL,
                estado ENUM('pendente','pago','enviado','concluido','cancelado') NOT NULL DEFAULT 'pendente',
                criada_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_user (user_id),
                INDEX idx_estado (estado)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    }

    if (!tabela_existe($conn, "encomenda_itens")) {
        $conn->query("
            CREATE TABLE encomenda_itens (
                id INT AUTO_INCREMENT PRIMARY KEY,
                encomenda_id INT NOT NULL,
                produto_id INT NULL,
                nome VARCHAR(255) NOT NULL,
                tamanho VARCHAR(20) NULL,
                cor VARCHAR(50) NULL,
                preco DECIMAL(10,2) NOT NULL,
                quantidade INT NOT NULL DEFAULT 1,
                INDEX idx_encomenda (encomenda_id),
                CONSTRAINT fk_item_encomenda FOREIGN KEY (encomenda_id) REFERENCES encomendas(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    }

    if (!tabela_existe($conn, "provas_futuras")) {
        $conn->query("
            CREATE TABLE provas_futuras (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                nome_en VARCHAR(255) NULL,
                data_prova DATE NOT NULL,
                local VARCHAR(255) NULL,
                local_en VARCHAR(255) NULL,
                distancia VARCHAR(50) NULL,
                destaque TINYINT(1) NOT NULL DEFAULT 1,
                ordem INT NOT NULL DEFAULT 0
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    }

    if (!tabela_existe($conn, "blog_posts")) {
        $conn->query("
            CREATE TABLE blog_posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                slug VARCHAR(200) NOT NULL UNIQUE,
                titulo VARCHAR(255) NOT NULL,
                titulo_en VARCHAR(255) NULL,
                resumo TEXT NULL,
                resumo_en TEXT NULL,
                conteudo MEDIUMTEXT NOT NULL,
                conteudo_en MEDIUMTEXT NULL,
                imagem VARCHAR(500) NULL,
                publicado_em DATE NOT NULL,
                activo TINYINT(1) NOT NULL DEFAULT 1,
                INDEX idx_publicado (publicado_em)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    }

    if (!tabela_existe($conn, "newsletter")) {
        $conn->query("
            CREATE TABLE newsletter (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL UNIQUE,
                criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    }

    seed_dados_iniciais($conn);
}

function actualizar_schema_produtos(mysqli $conn): void
{
    $colunas = [
        "nome_en" => "VARCHAR(255) NULL",
        "descricao_en" => "TEXT NULL",
        "categoria_en" => "VARCHAR(100) NULL",
        "badge" => "VARCHAR(80) NULL",
        "badge_en" => "VARCHAR(80) NULL",
        "tamanhos" => "VARCHAR(255) NULL",
        "cores" => "VARCHAR(255) NULL",
        "activo" => "TINYINT(1) NOT NULL DEFAULT 1",
        "ordem" => "INT NOT NULL DEFAULT 0",
        "criado_em" => "DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP",
    ];

    foreach ($colunas as $nome => $definicao) {
        if (!coluna_existe($conn, "produtos", $nome)) {
            $conn->query("ALTER TABLE produtos ADD COLUMN `{$nome}` {$definicao}");
        }
    }

    $conn->query("UPDATE produtos SET activo = 1 WHERE activo IS NULL OR activo = 0");
}

function catalogo_produtos_legacy(mysqli $conn): bool
{
    $resultado = $conn->query("SELECT nome, imagem FROM produtos ORDER BY id ASC LIMIT 1");
    if (!$resultado || $resultado->num_rows === 0) {
        return false;
    }

    $row = $resultado->fetch_assoc();
    $imagem = $row["imagem"] ?? "";

    return ($row["nome"] ?? "") === "T-Shirt A"
        || strpos($imagem, "IMAGENS/loja") === false;
}

function inserir_catalogo_produtos(mysqli $conn): void
{
    $produtos = [
        [1, "T-Shirt Lone Wolf", "Lone Wolf T-Shirt", "T-shirt leve de algodão, ideal para treino e uso casual.", "Light cotton t-shirt, ideal for training and casual wear.", 24.90, "IMAGENS/loja/camisola_lonewolf.png", "Vestuário", "Clothing", "Mais Vendido", "Best Seller", "S,M,L,XL", "Preto,Laranja", 1],
        [2, "Sweat com Capuz", "Hooded Sweatshirt", "Conforto premium para os dias mais frios.", "Premium comfort for colder days.", 44.90, "IMAGENS/loja/sweat2_lonewolf.png", "Vestuário", "Clothing", "Novo", "New", "S,M,L,XL", "Preto,Cinzento", 2],
        [3, "Sweat sem Capuz", "Crewneck Sweatshirt", "Conforto para os dias mais frios.", "Comfort for colder days.", 15.50, "IMAGENS/loja/sweat1_lonewolf.png", "Vestuário", "Clothing", "Novo", "New", "S,M,L,XL", "Preto", 3],
        [4, "Camisola de Competição", "Competition Jersey", "Modelo inspirado no espírito competitivo e na superação do atleta.", "Inspired by competitive spirit and athlete resilience.", 29.90, "IMAGENS/loja/provas_lonewolf.png", "Running", "Running", "Performance", "Performance", "S,M,L", "Laranja,Preto", 4],
        [5, "Calção de Competição", "Competition Shorts", "Modelo inspirado no espírito competitivo e na superação do atleta.", "Inspired by competitive spirit and athlete resilience.", 25.50, "IMAGENS/loja/calçao_lonewolf.png", "Running", "Running", "Performance", "Performance", "S,M,L", "Preto", 5],
        [6, "Calças de Fato Treino", "Training Joggers", "Conforto premium para os dias mais frios.", "Premium comfort for colder days.", 30.00, "IMAGENS/loja/calca_lonewolf.png", "Vestuário", "Clothing", "Novo", "New", "S,M,L,XL", "Preto", 6],
        [7, "Boné Lone Wolf", "Lone Wolf Cap", "Boné confortável e versátil para treino, passeio ou lifestyle.", "Comfortable cap for training or lifestyle.", 19.90, "IMAGENS/loja/bone_lonewolf.png", "Acessórios", "Accessories", "Essencial", "Essential", "", "Preto,Laranja", 7],
        [8, "Garrafa Desportiva", "Sports Bottle", "Hidratação com estilo, resistente e pronta para qualquer desafio.", "Stylish hydration ready for any challenge.", 14.90, "IMAGENS/loja/garrafa_lonewolf.png", "Acessórios", "Accessories", "Treino", "Training", "", "Preto,Laranja", 8],
        [9, "Saco Desportivo Lone Wolf", "Lone Wolf Gym Bag", "Espaço, durabilidade e visual marcante para acompanhar a tua rotina.", "Space, durability and bold look for your routine.", 34.90, "IMAGENS/loja/saco_lonewolf.png", "Equipamento", "Equipment", "Premium", "Premium", "", "Preto", 9],
    ];

    $stmt = $conn->prepare("INSERT INTO produtos (id, nome, nome_en, descricao, descricao_en, preco, imagem, categoria, categoria_en, badge, badge_en, tamanhos, cores, ordem) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

    foreach ($produtos as $produto) {
        $stmt->bind_param("issssdsssssssi", $produto[0], $produto[1], $produto[2], $produto[3], $produto[4], $produto[5], $produto[6], $produto[7], $produto[8], $produto[9], $produto[10], $produto[11], $produto[12], $produto[13]);
        $stmt->execute();
    }

    $stmt->close();
}

function seed_dados_iniciais(mysqli $conn): void
{
    $resultado = $conn->query("SELECT COUNT(*) AS total FROM produtos");
    $total = intval($resultado->fetch_assoc()["total"] ?? 0);

    if ($total === 0 || catalogo_produtos_legacy($conn)) {
        if ($total > 0) {
            $conn->query("SET FOREIGN_KEY_CHECKS=0");
            $conn->query("TRUNCATE TABLE produtos");
            $conn->query("SET FOREIGN_KEY_CHECKS=1");
        }

        inserir_catalogo_produtos($conn);
    }

    $resultado = $conn->query("SELECT COUNT(*) AS total FROM provas_futuras");
    if (intval($resultado->fetch_assoc()["total"] ?? 0) === 0) {
        $provas = [
            ["Meia Maratona de Lisboa", "Lisbon Half Marathon", "2026-03-22", "Lisboa", "Lisbon", "21 km"],
            ["Maratona de Madrid", "Madrid Marathon", "2026-04-26", "Madrid", "Madrid", "42 km"],
            ["São Silvestre de Lisboa", "Lisbon São Silvestre", "2026-12-28", "Lisboa", "Lisbon", "10 km"],
        ];
        $stmt = $conn->prepare("INSERT INTO provas_futuras (nome, nome_en, data_prova, local, local_en, distancia, ordem) VALUES (?,?,?,?,?,?,?)");
        $ordem = 1;
        foreach ($provas as $prova) {
            $stmt->bind_param("ssssssi", $prova[0], $prova[1], $prova[2], $prova[3], $prova[4], $prova[5], $ordem);
            $stmt->execute();
            $ordem++;
        }
        $stmt->close();
    }

    $resultado = $conn->query("SELECT COUNT(*) AS total FROM blog_posts");
    if (intval($resultado->fetch_assoc()["total"] ?? 0) === 0) {
        $posts = [
            ["maratona-porto-2025", "Maratona do Porto 2025 — 2:52:55", "Porto Marathon 2025 — 2:52:55", "11.º lugar na Maratona do Porto com novo recorde pessoal.", "11th place at Porto Marathon with a new personal best.", "<p>A Maratona do Porto marcou o fecho de uma preparação exigente. Com um tempo de <strong>2:52:55</strong> e <strong>11.º lugar</strong>, o objetivo de estar entre os primeiros portugueses foi alcançado.</p><p>A estratégia de controlo de ritmo nas primeiras metades permitiu manter consistência até aos últimos quilómetros.</p>", "<p>Porto Marathon closed a demanding preparation block. With <strong>2:52:55</strong> and <strong>11th place</strong>, the goal of finishing among the top Portuguese runners was achieved.</p>", "IMAGENS/FOTO_PORTO.jpg", "2025-11-02"],
            ["meia-lagos-2025", "Meia Internacional de Lagos — Vitória", "Lagos International Half — Victory", "1.º lugar na Meia Internacional de Lagos.", "1st place at Lagos International Half Marathon.", "<p>Vitória na Meia Internacional de Lagos com <strong>1:21:45</strong>. Uma prova onde a consistência e a gestão de esforço fizeram a diferença nos últimos 5 km.</p>", "<p>Victory at Lagos International Half Marathon in <strong>1:21:45</strong>. Consistency and effort management made the difference in the final 5 km.</p>", "IMAGENS/PAI_4.jpeg", "2025-11-15"],
            ["sao-silvestre-seixal-2025", "São Silvestre Seixal — 35:59", "Seixal São Silvestre — 35:59", "Melhor tempo nos 10 km da temporada.", "Best 10 km time of the season.", "<p>A São Silvestre Seixal trouxe o melhor registo de <strong>35:59</strong> nos 10 km, fechando o ano com ritmo forte e confiança para 2026.</p>", "<p>Seixal São Silvestre brought the best <strong>35:59</strong> 10 km record, closing the year with strong rhythm and confidence for 2026.</p>", "IMAGENS/PAI_3.jpeg", "2025-12-31"],
        ];
        $stmt = $conn->prepare("INSERT INTO blog_posts (slug, titulo, titulo_en, resumo, resumo_en, conteudo, conteudo_en, imagem, publicado_em) VALUES (?,?,?,?,?,?,?,?,?)");
        foreach ($posts as $post) {
            $stmt->bind_param("sssssssss", $post[0], $post[1], $post[2], $post[3], $post[4], $post[5], $post[6], $post[7], $post[8]);
            $stmt->execute();
        }
        $stmt->close();
    }
}

function migracao_chat_concluida(mysqli $conn): bool
{
    if (!tabela_existe($conn, "config_site")) {
        return false;
    }

    $resultado = $conn->query("SELECT valor FROM config_site WHERE chave = 'chat_migrado' LIMIT 1");

    return $resultado && $resultado->num_rows > 0;
}

function marcar_migracao_chat(mysqli $conn): void
{
    $conn->query("INSERT INTO config_site (chave, valor) VALUES ('chat_migrado', '1') ON DUPLICATE KEY UPDATE valor = '1'");
}
