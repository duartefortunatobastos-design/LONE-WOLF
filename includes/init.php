<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../ligacao.php";
require_once __DIR__ . "/migrate.php";
require_once __DIR__ . "/chat.php";
require_once __DIR__ . "/shop.php";
require_once __DIR__ . "/mail.php";

executar_migracoes($conn);

if (!migracao_chat_concluida($conn)) {
    migrar_mensagens_antigas($conn);
    marcar_migracao_chat($conn);
}
