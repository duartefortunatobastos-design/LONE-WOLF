<?php
require_once "includes/init.php";

$erro = "";
$emailPendente = "";

if (isset($_SESSION["user_id"])) {
    if (!empty($_SESSION["redirect_after_login"])) {
        $destino = $_SESSION["redirect_after_login"];
        unset($_SESSION["redirect_after_login"]);
        header("Location: " . $destino);
        exit();
    }

    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $pass = $_POST["password"] ?? "";

    $stmt = $conn->prepare("SELECT * FROM utilizadores WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $user = $resultado->fetch_assoc();
    $stmt->close();

    if (!$user) {
        $erro = "Conta não encontrada";
    } elseif (!password_verify($pass, $user["password"])) {
        $erro = "Password incorreta";
    } elseif (!empty($user["bloqueado"])) {
        $erro = "A tua conta foi bloqueada. Contacta o administrador.";
    } elseif (empty($user["email_verificado"])) {
        $erro = "A tua conta ainda não foi confirmada. Consulta o teu email e clica no link de confirmação antes de fazer login.";
        $emailPendente = $email;
    } else {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["nome"] = $user["nome"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["tipo"] = $user["tipo"];

        if (!empty($_SESSION["redirect_after_login"])) {
            $destino = $_SESSION["redirect_after_login"];
            unset($_SESSION["redirect_after_login"]);
            header("Location: " . $destino);
            exit();
        }

        header("Location: index.php");
        exit();
    }
}

$pageTitle = "Login | Lone Wolf";
$bodyClass = "auth-page";
require_once "includes/head.php";
?>

<section class="auth-hero">
    <div class="acesso">Acesso</div>
    <h1>Login</h1>
</section>

<section class="auth-shell">
    <div class="auth-card">
        <?php if (!empty($_GET["registro"]) && $_GET["registro"] === "sucesso"): ?>
            <div class="alerta sucesso" style="margin-bottom:18px;">
                Conta criada com sucesso! Enviámos um email de confirmação para <strong><?= htmlspecialchars($_GET["email"] ?? "") ?></strong>. Para fazer login, consulta o seu email.
            </div>
            <?php if (!empty($_GET["email_erro"])): ?>
                <p style="margin:-8px 0 18px;text-align:center;">
                    Não recebeste o email?
                    <a href="reenviar-confirmacao.php?email=<?= urlencode($_GET["email"] ?? "") ?>">Reenviar confirmação</a>
                </p>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($erro !== ""): ?>
            <div class="alerta erro" style="margin-bottom:18px;"><?= htmlspecialchars($erro) ?></div>
            <?php if (!empty($emailPendente)): ?>
                <p style="margin:-8px 0 18px;text-align:center;">
                    <a href="reenviar-confirmacao.php?email=<?= urlencode($emailPendente) ?>">Reenviar email de confirmação</a>
                </p>
            <?php endif; ?>
        <?php endif; ?>

        <form method="POST">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="ex: email@dominio.com" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="A tua password" required>

            <button type="submit" class="btn-auth">Entrar</button>
        </form>

        <div class="auth-footer">
            <p>Ainda não tens conta?</p>
            <a href="registro.php" class="btn-auth alt">Criar Conta</a>
            <a href="index.php" class="auth-back">← Voltar ao site</a>
        </div>
    </div>
</section>

<?php include __DIR__ . "/cookie-banner.php"; ?>
<script src="assets/js/reveal.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
