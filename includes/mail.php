<?php

function enviar_email(string $para, string $assunto, string $corpoHtml, ?string $replyTo = null): bool
{
    $config = require __DIR__ . "/site-config.php";
    $de = $config["contact_email"] ?? "noreply@lonewolf.pt";
    $replyTo = $replyTo ? str_replace(["\r", "\n"], "", $replyTo) : $de;

    $headers = [
        "MIME-Version: 1.0",
        "Content-type: text/html; charset=UTF-8",
        "From: Lone Wolf <{$de}>",
        "Reply-To: {$replyTo}",
        "X-Mailer: PHP/" . phpversion(),
    ];

    return @mail($para, $assunto, $corpoHtml, implode("\r\n", $headers));
}

function email_contacto_admin(string $nome, string $email, string $mensagem, bool $comConta): bool
{
    $config = require __DIR__ . "/site-config.php";
    $adminEmail = $config["contact_email"] ?? "ruimbb@gmail.com";
    $origem = $comConta ? "utilizador com conta" : "visitante (sem login)";
    $mensagemHtml = nl2br(htmlspecialchars($mensagem));

    $html = "
    <div style=\"font-family:Arial,sans-serif;max-width:600px;margin:0 auto;color:#111;\">
        <h2 style=\"color:#e57f1f;\">Nova mensagem de contacto</h2>
        <p><strong>Nome:</strong> " . htmlspecialchars($nome) . "</p>
        <p><strong>E-mail:</strong> " . htmlspecialchars($email) . "</p>
        <p><strong>Origem:</strong> {$origem}</p>
        <p><strong>Mensagem:</strong></p>
        <p>{$mensagemHtml}</p>
        <p style=\"color:#666;font-size:13px;\">A conversa também ficou disponível no painel de mensagens.</p>
    </div>";

    return enviar_email($adminEmail, "Nova mensagem de contacto — Lone Wolf", $html, $email);
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
