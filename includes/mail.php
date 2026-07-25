<?php

require_once __DIR__ . "/smtp.php";

function enviar_email(string $para, string $assunto, string $corpoHtml, string $corpoTexto = ""): bool
{
    $config = require __DIR__ . "/site-config.php";

    if (!empty($config["smtp_user"]) && !empty($config["smtp_pass"])) {
        return smtp_enviar($para, $assunto, $corpoHtml, $config, $corpoTexto);
    }

    $de = $config["smtp_from_email"] ?? $config["contact_email"] ?? "noreply@lonewolf.pt";

    $headers = [
        "MIME-Version: 1.0",
        "Content-type: text/html; charset=UTF-8",
        "From: Lone Wolf <{$de}>",
        "Reply-To: {$de}",
        "X-Mailer: PHP/" . phpversion(),
    ];

    return @mail($para, $assunto, $corpoHtml, implode("\r\n", $headers));
}

function email_encomenda_cliente(array $encomenda, array $itens): bool
{
    $linhas = "";
    foreach ($itens as $item) {
        $extra = [];
        if (!empty($item["tamanho"])) {
            $extra[] = "Tam. " . htmlspecialchars($item["tamanho"]);
        }
        if (!empty($item["cor"])) {
            $extra[] = htmlspecialchars($item["cor"]);
        }
        $detalhe = $extra ? " (" . implode(", ", $extra) . ")" : "";
        $linhas .= "<tr><td>" . htmlspecialchars($item["nome"]) . "{$detalhe}</td><td>" . (int) $item["quantidade"] . "</td><td>" . number_format((float) $item["preco"] * (int) $item["quantidade"], 2, ",", ".") . "€</td></tr>";
    }

    $html = "
    <div style=\"font-family:Arial,sans-serif;max-width:600px;margin:0 auto;color:#111;\">
        <h2 style=\"color:#e57f1f;\">Encomenda #{$encomenda["id"]} — Lone Wolf</h2>
        <p>Obrigado, " . htmlspecialchars($encomenda["nome"]) . "! Recebemos a tua encomenda.</p>
        <table width=\"100%\" cellpadding=\"8\" cellspacing=\"0\" style=\"border-collapse:collapse;margin:20px 0;\">
            <tr style=\"background:#f4f4f4;\"><th align=\"left\">Artigo</th><th>Qtd</th><th>Total</th></tr>
            {$linhas}
        </table>
        <p><strong>Total: " . number_format((float) $encomenda["total"], 2, ",", ".") . "€</strong></p>
        <p><strong>Pagamento:</strong> " . htmlspecialchars($encomenda["metodo_pagamento"]) . "</p>
        <p>Entraremos em contacto em breve para confirmar envio e pagamento.</p>
        <p style=\"color:#666;font-size:13px;\">Lone Wolf — Rui Bastos</p>
    </div>";

    return enviar_email($encomenda["email"], "Encomenda #{$encomenda["id"]} — Lone Wolf", $html);
}

function email_encomenda_admin(array $encomenda, array $itens): bool
{
    $config = require __DIR__ . "/site-config.php";
    $adminEmail = $config["orders_email"] ?? $config["contact_email"];

    $html = "<p>Nova encomenda #{$encomenda["id"]} de " . htmlspecialchars($encomenda["nome"]) . " (" . htmlspecialchars($encomenda["email"]) . ")</p>";
    $html .= "<p>Total: " . number_format((float) $encomenda["total"], 2, ",", ".") . "€ — " . htmlspecialchars($encomenda["metodo_pagamento"]) . "</p>";
    $html .= "<p><a href=\"" . htmlspecialchars(($config["site_url"] ?? "") . "/admin_encomendas.php") . "\">Ver no admin</a></p>";

    return enviar_email($adminEmail, "Nova encomenda #{$encomenda["id"]}", $html);
}

function email_confirmar_conta(string $nome, string $email, string $token): bool
{
    $config = require __DIR__ . "/site-config.php";
    $siteUrl = rtrim($config["site_url"] ?? "", "/");
    $verificationUrl = $siteUrl . "/verificar-email.php?token=" . urlencode($token);
    $verificationUrlHtml = htmlspecialchars($verificationUrl);
    $saudacao = $nome !== "" ? "Olá " . htmlspecialchars($nome) . "," : "Olá,";

    $html = "
    <div style=\"font-family:Arial,Helvetica,sans-serif;max-width:600px;margin:0 auto;color:#111111;line-height:1.6;\">
        <h2 style=\"color:#111111;margin-bottom:16px;\">Bem-vindo ao LoneWolf Runner! 🐺</h2>
        <p>{$saudacao}</p>
        <p>Obrigado por te registares na nossa plataforma. Para ativares a tua conta e começares a utilizar o site, por favor confirma o teu endereço de e-mail clicando no botão abaixo:</p>
        <p style=\"margin:20px 0;\">
            <a href=\"{$verificationUrlHtml}\" style=\"background-color:#111111;color:#ffffff;padding:12px 24px;text-decoration:none;border-radius:5px;font-weight:bold;display:inline-block;\">Confirmar a minha conta</a>
        </p>
        <br>
        <p>Se não criaste nenhuma conta no nosso site, podes ignorar este e-mail.</p>
        <p>Bons treinos,<br><strong>Equipa LoneWolf Runner</strong></p>
    </div>";

    $texto = "Bem-vindo ao LoneWolf Runner!\n\n"
        . ($nome !== "" ? "Olá {$nome},\n\n" : "Olá,\n\n")
        . "Obrigado por te registares. Confirma a tua conta em:\n{$verificationUrl}\n\n"
        . "Se não criaste nenhuma conta, ignora este e-mail.\n\n"
        . "Bons treinos,\nEquipa LoneWolf Runner";

    return enviar_email($email, "Confirma a tua conta no LoneWolf Runner 🐺", $html, $texto);
}

function gerar_token_verificacao(): string
{
    return bin2hex(random_bytes(32));
}
