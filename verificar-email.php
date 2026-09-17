<?php
require_once "includes/init.php";

$token = trim($_GET["token"] ?? "");
$sucesso = false;
$erro = "";

if ($token !== "") {
    $stmt = $conn->prepare("SELECT id, email_verificado, token_expira FROM utilizadores WHERE token_verificacao = ? LIMIT 1");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $user = $resultado->fetch_assoc();
    $stmt->close();

    if (!$user) {
        $erro = "Link de confirmação inválido ou já utilizado.";
    } elseif (!empty($user["email_verificado"])) {
        $sucesso = true;
    } elseif (!empty($user["token_expira"]) && strtotime($user["token_expira"]) < time()) {
        $erro = "Este link expirou. Cria uma nova conta ou contacta-nos para obter ajuda.";
    } else {
        $stmt = $conn->prepare("UPDATE utilizadores SET email_verificado = 1, token_verificacao = NULL, token_expira = NULL WHERE id = ?");
        $stmt->bind_param("i", $user["id"]);
        $stmt->execute();
        $stmt->close();
        $sucesso = true;
    }
} else {
    $erro = "Link de confirmação inválido.";
}

$pageTitle = "Confirmar Email | Lone Wolf";
$bodyClass = "auth-page";
require_once "includes/head.php";
?>

<section class="auth-hero">
    <div class="acesso">Acesso</div>
    <h1>Confirmar Email</h1>
</section>

<section class="auth-shell">
    <div class="auth-card">
        <?php if ($sucesso): ?>
            <div class="alerta sucesso" style="margin-bottom:18px;">
                Email confirmado com sucesso! A tua conta está activa — já podes fazer login.
            </div>
            <a href="login.php" class="btn-auth">Entrar na minha conta</a>
        <?php else: ?>
            <div class="alerta erro" style="margin-bottom:18px;"><?= htmlspecialchars($erro) ?></div>
            <a href="registro.php" class="btn-auth alt">Voltar ao registo</a>
        <?php endif; ?>

        <div class="auth-footer">
            <a href="index.php" class="auth-back">← Voltar ao site</a>
        </div>
    </div>
</section>

<?php include __DIR__ . "/cookie-banner.php"; ?>
<script src="assets/js/reveal.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
