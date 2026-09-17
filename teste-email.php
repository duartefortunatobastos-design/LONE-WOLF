<?php
require_once "includes/init.php";

$config = require __DIR__ . "/includes/site-config.php";
$passLen = strlen(str_replace([" ", "-"], "", $config["smtp_pass"] ?? ""));
$resultado = "";
$detalhe = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $para = trim($_POST["email"] ?? $config["smtp_user"]);
    $ok = enviar_email(
        $para,
        "Teste LoneWolf Runner",
        "<h2>Teste OK</h2><p>Se recebeste este email, o SMTP está a funcionar.</p>",
        "Teste OK — Se recebeste este email, o SMTP está a funcionar."
    );

    if ($ok) {
        $resultado = "sucesso";
        $detalhe = "Email enviado para {$para}";
    } else {
        $resultado = "erro";
        $detalhe = smtp_ultimo_erro() ?: "Erro desconhecido ao enviar email.";
    }
}

$pageTitle = "Teste Email | Lone Wolf";
$bodyClass = "auth-page";
require_once "includes/head.php";
?>

<section class="auth-hero">
    <div class="acesso">Diagnóstico</div>
    <h1>Teste de Email</h1>
</section>

<section class="auth-shell">
    <div class="auth-card">
        <p style="margin-bottom:16px;color:#666;font-size:14px;">
            Conta SMTP: <strong><?= htmlspecialchars($config["smtp_user"] ?? "") ?></strong><br>
            App Password: <strong><?= $passLen > 0 ? "{$passLen} caracteres" : "NÃO CONFIGURADA" ?></strong>
            <?php if ($passLen !== 16 && $passLen > 0): ?>
                <br><span style="color:#c00;">A App Password do Gmail deve ter exactamente 16 caracteres.</span>
            <?php endif; ?>
        </p>

        <?php if ($resultado === "sucesso"): ?>
            <div class="alerta sucesso" style="margin-bottom:18px;"><?= htmlspecialchars($detalhe) ?></div>
        <?php elseif ($resultado === "erro"): ?>
            <div class="alerta erro" style="margin-bottom:18px;"><?= htmlspecialchars($detalhe) ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="email">Enviar teste para</label>
            <input type="email" id="email" name="email" required value="<?= htmlspecialchars($config["smtp_user"] ?? "") ?>">
            <button type="submit" class="btn-auth">Enviar email de teste</button>
        </form>

        <div class="auth-footer">
            <a href="login.php" class="auth-back">← Voltar ao login</a>
        </div>
    </div>
</section>

<?php include __DIR__ . "/cookie-banner.php"; ?>
</body>
</html>
