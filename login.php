<?php
require_once "includes/init.php";

$erro = "";

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
    } else {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["nome"] = $user["nome"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["tipo"] = $user["tipo"];

        obter_ou_criar_conversa($conn, intval($user["id"]), $user["nome"], $user["email"]);

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
        <?php if ($erro !== ""): ?>
            <div class="alerta erro" style="margin-bottom:18px;"><?= htmlspecialchars($erro) ?></div>
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
