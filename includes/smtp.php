<?php

function smtp_ultimo_erro(): string
{
    return $GLOBALS["smtp_ultimo_erro"] ?? "";
}

function smtp_registar_erro(string $mensagem): void
{
    $GLOBALS["smtp_ultimo_erro"] = $mensagem;
    $logDir = __DIR__ . "/../logs";
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0755, true);
    }
    @file_put_contents(
        $logDir . "/mail.log",
        date("Y-m-d H:i:s") . " — " . $mensagem . PHP_EOL,
        FILE_APPEND
    );
}

function smtp_enviar(string $para, string $assunto, string $corpoHtml, array $config, string $corpoTexto = ""): bool
{
    $cred = smtp_credenciais($config);

    if ($cred["user"] === "" || $cred["pass"] === "") {
        smtp_registar_erro("Credenciais SMTP em falta no .env");
        return false;
    }

    if (smtp_enviar_via_ssl($para, $assunto, $corpoHtml, $corpoTexto, $cred)) {
        return true;
    }

    return smtp_enviar_via_starttls($para, $assunto, $corpoHtml, $corpoTexto, $cred);
}

function smtp_credenciais(array $config): array
{
    $pass = trim($config["smtp_pass"] ?? "");
    $pass = str_replace([" ", "-", "\r", "\n"], "", $pass);
    $pass = strtolower($pass);

    return [
        "user" => trim($config["smtp_user"] ?? ""),
        "pass" => $pass,
        "de" => trim($config["smtp_from_email"] ?? $config["smtp_user"] ?? ""),
        "deNome" => $config["smtp_from_name"] ?? "Lone Wolf",
        "replyTo" => trim($config["contact_email"] ?? $config["smtp_user"] ?? ""),
    ];
}

function smtp_contexto(): array
{
    return [
        "ssl" => [
            "verify_peer" => true,
            "verify_peer_name" => true,
            "allow_self_signed" => false,
            "SNI_enabled" => true,
            "peer_name" => "smtp.gmail.com",
        ],
    ];
}

function smtp_enviar_via_ssl(string $para, string $assunto, string $corpoHtml, string $corpoTexto, array $cred): bool
{
    $socket = @stream_socket_client(
        "ssl://smtp.gmail.com:465",
        $errno,
        $errstr,
        30,
        STREAM_CLIENT_CONNECT,
        stream_context_create(smtp_contexto())
    );

    if (!$socket) {
        smtp_registar_erro("SSL:465 ligação falhou — {$errstr} ({$errno})");
        return false;
    }

    stream_set_timeout($socket, 30);

    if (!smtp_ler($socket, [220])) {
        smtp_registar_erro("SSL:465 resposta inicial inválida — " . smtp_ultima_resposta());
        fclose($socket);
        return false;
    }

    if (!smtp_escrever($socket, "EHLO lonewolf.pt") || !smtp_ler($socket, [250])) {
        smtp_registar_erro("SSL:465 EHLO falhou — " . smtp_ultima_resposta());
        fclose($socket);
        return false;
    }

    return smtp_finalizar_envio($socket, $para, $assunto, $corpoHtml, $corpoTexto, $cred, "SSL:465");
}

function smtp_enviar_via_starttls(string $para, string $assunto, string $corpoHtml, string $corpoTexto, array $cred): bool
{
    $socket = @stream_socket_client(
        "tcp://smtp.gmail.com:587",
        $errno,
        $errstr,
        30,
        STREAM_CLIENT_CONNECT,
        stream_context_create(smtp_contexto())
    );

    if (!$socket) {
        smtp_registar_erro("STARTTLS:587 ligação falhou — {$errstr} ({$errno})");
        return false;
    }

    stream_set_timeout($socket, 30);

    if (!smtp_ler($socket, [220])) {
        smtp_registar_erro("STARTTLS:587 resposta inicial inválida — " . smtp_ultima_resposta());
        fclose($socket);
        return false;
    }

    if (!smtp_escrever($socket, "EHLO lonewolf.pt") || !smtp_ler($socket, [250])) {
        smtp_registar_erro("STARTTLS:587 EHLO falhou — " . smtp_ultima_resposta());
        fclose($socket);
        return false;
    }

    if (!smtp_escrever($socket, "STARTTLS") || !smtp_ler($socket, [220])) {
        smtp_registar_erro("STARTTLS:587 STARTTLS falhou — " . smtp_ultima_resposta());
        fclose($socket);
        return false;
    }

    $cryptoOk = false;
    foreach ([STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT ?? null, STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT ?? null, STREAM_CRYPTO_METHOD_TLS_CLIENT ?? null] as $metodo) {
        if ($metodo !== null && @stream_socket_enable_crypto($socket, true, $metodo)) {
            $cryptoOk = true;
            break;
        }
    }

    if (!$cryptoOk) {
        smtp_registar_erro("STARTTLS:587 encriptação TLS falhou. Verifica se a extensão OpenSSL está activa no php.ini");
        fclose($socket);
        return false;
    }

    if (!smtp_escrever($socket, "EHLO lonewolf.pt") || !smtp_ler($socket, [250])) {
        smtp_registar_erro("STARTTLS:587 EHLO pós-TLS falhou — " . smtp_ultima_resposta());
        fclose($socket);
        return false;
    }

    return smtp_finalizar_envio($socket, $para, $assunto, $corpoHtml, $corpoTexto, $cred, "STARTTLS:587");
}

function smtp_autenticar($socket, array $cred): bool
{
    $authPlain = base64_encode("\0{$cred["user"]}\0{$cred["pass"]}");

    if (smtp_escrever($socket, "AUTH PLAIN {$authPlain}") && smtp_ler($socket, [235])) {
        return true;
    }

    if (!smtp_escrever($socket, "AUTH LOGIN") || !smtp_ler($socket, [334])) {
        smtp_registar_erro("Autenticação falhou — " . smtp_ultima_resposta());
        return false;
    }

    if (!smtp_escrever($socket, base64_encode($cred["user"])) || !smtp_ler($socket, [334])) {
        smtp_registar_erro("Autenticação falhou — " . smtp_ultima_resposta());
        return false;
    }

    if (!smtp_escrever($socket, base64_encode($cred["pass"])) || !smtp_ler($socket, [235])) {
        $comprimento = strlen($cred["pass"]);
        smtp_registar_erro(
            "Autenticação Gmail falhou (BadCredentials). Conta: {$cred["user"]}, password com {$comprimento} caracteres. "
            . "Cria uma nova App Password em https://myaccount.google.com/apppasswords . Resposta: " . smtp_ultima_resposta()
        );
        return false;
    }

    return true;
}

function smtp_finalizar_envio($socket, string $para, string $assunto, string $corpoHtml, string $corpoTexto, array $cred, string $metodo): bool
{
    if (!smtp_autenticar($socket, $cred)) {
        fclose($socket);
        return false;
    }

    if (!smtp_escrever($socket, "MAIL FROM:<{$cred["de"]}>") || !smtp_ler($socket, [250])) {
        smtp_registar_erro("{$metodo} MAIL FROM falhou — " . smtp_ultima_resposta());
        fclose($socket);
        return false;
    }

    if (!smtp_escrever($socket, "RCPT TO:<{$para}>") || !smtp_ler($socket, [250, 251])) {
        smtp_registar_erro("{$metodo} RCPT TO falhou — " . smtp_ultima_resposta());
        fclose($socket);
        return false;
    }

    if (!smtp_escrever($socket, "DATA") || !smtp_ler($socket, [354])) {
        smtp_registar_erro("{$metodo} DATA falhou — " . smtp_ultima_resposta());
        fclose($socket);
        return false;
    }

    $headers = [
        "MIME-Version: 1.0",
        "From: {$cred["deNome"]} <{$cred["de"]}>",
        "Reply-To: {$cred["replyTo"]}",
        "To: {$para}",
        "Subject: =?UTF-8?B?" . base64_encode($assunto) . "?=",
        "Date: " . date("r"),
    ];

    if ($corpoTexto !== "") {
        $boundary = "lw_" . bin2hex(random_bytes(8));
        $headers[] = "Content-Type: multipart/alternative; boundary=\"{$boundary}\"";

        $corpo = "--{$boundary}\r\n";
        $corpo .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
        $corpo .= $corpoTexto . "\r\n\r\n";
        $corpo .= "--{$boundary}\r\n";
        $corpo .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
        $corpo .= $corpoHtml . "\r\n\r\n";
        $corpo .= "--{$boundary}--";
    } else {
        $headers[] = "Content-Type: text/html; charset=UTF-8";
        $corpo = $corpoHtml;
    }

    $corpo = preg_replace('/^\./m', '..', $corpo);
    $mensagem = implode("\r\n", $headers) . "\r\n\r\n" . $corpo;

    if (!smtp_escrever($socket, $mensagem) || !smtp_escrever($socket, ".") || !smtp_ler($socket, [250])) {
        smtp_registar_erro("{$metodo} envio falhou — " . smtp_ultima_resposta());
        fclose($socket);
        return false;
    }

    smtp_escrever($socket, "QUIT");
    fclose($socket);

    smtp_registar_erro("Email enviado com sucesso para {$para} via {$metodo}");
    return true;
}

function smtp_escrever($socket, string $comando): bool
{
    return fwrite($socket, $comando . "\r\n") !== false;
}

function smtp_ultima_resposta(): string
{
    return $GLOBALS["smtp_ultima_resposta"] ?? "";
}

function smtp_ler($socket, array $codigosEsperados): bool
{
    $resposta = "";

    while ($linha = fgets($socket, 8192)) {
        $resposta .= $linha;
        if (isset($linha[3]) && $linha[3] === " ") {
            break;
        }
    }

    $GLOBALS["smtp_ultima_resposta"] = trim($resposta);

    if ($resposta === "") {
        return false;
    }

    $codigo = (int) substr($resposta, 0, 3);

    return in_array($codigo, $codigosEsperados, true);
}
