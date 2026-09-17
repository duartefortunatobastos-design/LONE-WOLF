<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$ligacao = __DIR__ . "/../ligacao.php";
if (!is_file($ligacao)) {
    http_response_code(500);
    exit(
        "Falta o ficheiro ligacao.php em public_html. " .
        "Cria-o com os dados da base de dados da Hostinger (hPanel > Bases de dados)."
    );
}

require_once $ligacao;
require_once __DIR__ . "/migrate.php";
require_once __DIR__ . "/chat.php";
require_once __DIR__ . "/shop.php";
require_once __DIR__ . "/mail.php";

try {
    executar_migracoes($conn);

    if (!migracao_chat_concluida($conn)) {
        migrar_mensagens_antigas($conn);
        marcar_migracao_chat($conn);
    }
} catch (Throwable $e) {
    http_response_code(500);
    exit("Erro ao preparar a base de dados. Confirma o ligacao.php e que a base MySQL existe na Hostinger.");
}
