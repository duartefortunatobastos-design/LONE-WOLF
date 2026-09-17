<?php
require_once "includes/init.php";

$email = trim($_GET["email"] ?? $_POST["email"] ?? "");
$enviado = false;
$erro = "";

if ($email !== "" && filter_var($email, FILTER_VALIDATE_EMAIL) && ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_GET["email"]))) {
    $stmt = $conn->prepare("SELECT id, nome, email_verificado, token_verificacao, token_expira FROM utilizadores WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$user) {
        $erro = "Conta não encontrada.";
    } elseif (!empty($user["email_verificado"])) {
        $erro = "Esta conta já está confirmada. Podes fazer login.";
    } else {
        $token = $user["token_verificacao"] ?? "";
        $expirado = empty($user["token_expira"]) || strtotime($user["token_expira"]) < time();

        if ($token === "" || $expirado) {
            $token = gerar_token_verificacao();
            $tokenExpira = date("Y-m-d H:i:s", time() + 86400);
            $stmt = $conn->prepare("UPDATE utilizadores SET token_verificacao = ?, token_expira = ? WHERE id = ?");
            $stmt->bind_param("ssi", $token, $tokenExpira, $user["id"]);
            $stmt->execute();
            $stmt->close();
        }

        if (email_confirmar_conta($user["nome"] ?? "", $email, $token)) {
            $enviado = true;
        } else {
            $erro = "Não foi possível enviar o email. Verifica se a App Password no .env tem exactamente 16 caracteres.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $erro = "Insere um email válido.";
}

$pageTitle = "Reenviar Confirmação | Lone Wolf";
$bodyClass = "auth-page";
require_once "includes/head.php";
?>

<section class="auth-hero">
    <div class="acesso">Acesso</div>
    <h1>Reenviar Email</h1>
</section>

<section class="auth-shell">
    <div class="auth-card">
        <?php if ($enviado): ?>
            <div class="alerta sucesso" style="margin-bottom:18px;">
                Email de confirmação reenviado para <strong><?= htmlspecialchars($email) ?></strong>. Consulta o seu email.
            </div>
        <?php elseif ($erro !== ""): ?>
            <div class="alerta erro" style="margin-bottom:18px;"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="email@dominio.com" required value="<?= htmlspecialchars($email) ?>">
            <button type="submit" class="btn-auth">Reenviar confirmação</button>
        </form>

        <div class="auth-footer">
            <a href="login.php" class="btn-auth alt">Voltar ao login</a>
        </div>
    </div>
</section>

<?php include __DIR__ . "/cookie-banner.php"; ?>
<script src="assets/js/reveal.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
