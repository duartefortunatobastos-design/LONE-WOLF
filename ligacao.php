<?php
mysqli_report(MYSQLI_REPORT_OFF);

$host = "localhost";
$user = "SEU_USER_HOSTINGER";
$pass = "SUA_PASSWORD_HOSTINGER";
$db   = "SEU_DB_HOSTINGER";

$httpHost = strtolower($_SERVER["HTTP_HOST"] ?? "localhost");
$eLocal = $httpHost === "localhost"
    || strpos($httpHost, "localhost:") === 0
    || $httpHost === "127.0.0.1"
    || strpos($httpHost, ".local") !== false;

if ($eLocal) {
    $user = "root";
    $pass = "";
    $db = "lonewolf_db";
}

if (!$eLocal && ($user === "root" || $user === "SEU_USER_HOSTINGER" || $pass === "" || $pass === "SUA_PASSWORD_HOSTINGER")) {
    http_response_code(500);
    exit(
        "Falta configurar o ligacao.php na Hostinger. " .
        "No hPanel abre Bases de dados, copia o utilizador, a palavra-passe e o nome da base, " .
        "e cola neste ficheiro. Nao uses o root do XAMPP."
    );
}

$conn = @new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    http_response_code(500);
    exit("Erro na ligacao a base de dados. Confirma o user, a password e o nome da base no ligacao.php da Hostinger.");
}

$conn->set_charset("utf8mb4");
