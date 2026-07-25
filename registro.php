<?php
require_once "includes/init.php";

$erro = "";

if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $pass = $_POST["password"] ?? "";
    $confirma_pass = $_POST["confirm_password"] ?? "";

    if ($nome === "" || $email === "" || $pass === "" || $confirma_pass === "") {
        $erro = "Preenche todos os campos.";
    } elseif (empty($_POST["aceitar_politicas"])) {
        $erro = "Tens de aceitar a Política de Privacidade e a Política de Cookies.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Insere um email válido.";
    } elseif ($pass !== $confirma_pass) {
        $erro = "As passwords não coincidem.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM utilizadores WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $erro = "Este email já está registado.";
            $stmt->close();
        } else {
            $stmt->close();

            $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
            $tipo = "user";
            $token = gerar_token_verificacao();
            $tokenExpira = date("Y-m-d H:i:s", time() + 86400);

            $stmt = $conn->prepare("INSERT INTO utilizadores (nome, email, password, tipo, email_verificado, token_verificacao, token_expira) VALUES (?, ?, ?, ?, 0, ?, ?)");
            $stmt->bind_param("ssssss", $nome, $email, $hash_pass, $tipo, $token, $tokenExpira);

            if ($stmt->execute()) {
                $stmt->close();
                $emailEnviado = email_confirmar_conta($nome, $email, $token);
                $params = "registro=sucesso&email=" . urlencode($email);
                if (!$emailEnviado) {
                    $params .= "&email_erro=1";
                }
                header("Location: login.php?" . $params);
                exit();
            }

            $erro = "Erro ao criar conta. Tenta novamente.";
            $stmt->close();
        }
    }
}

$pageTitle = "Registo | Lone Wolf";
$bodyClass = "auth-page";
require_once "includes/head.php";
?>

<section class="auth-hero">
    <div class="acesso">Acesso</div>
    <h1>Registo</h1>
</section>

<section class="auth-shell">
    <div class="auth-card">
        <?php if ($erro !== ""): ?>
            <div class="alerta erro" style="margin-bottom:18px;"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="nome">Nome</label>
            <input
                type="text"
                id="nome"
                name="nome"
                placeholder="O teu nome"
                required
                value="<?= htmlspecialchars($_POST["nome"] ?? "") ?>"
            >

            <label for="email">E-mail</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="email@dominio.com"
                required
                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"
            >

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="A tua password" required>

            <label for="confirm_password">Confirmar Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Repete a password" required>

            <label class="auth-politicas">
                <input
                    type="checkbox"
                    id="aceitar_politicas"
                    name="aceitar_politicas"
                    value="1"
                    required
                    <?= !empty($_POST["aceitar_politicas"]) ? "checked" : "" ?>
                >
                <span>
                    Li e aceito a
                    <a href="politica-de-privacidade.php" target="_blank" rel="noopener noreferrer">Política de Privacidade</a>
                    e a
                    <a href="politica-de-cookies.php" target="_blank" rel="noopener noreferrer">Política de Cookies</a>.
                </span>
            </label>

            <button type="submit" class="btn-auth">Criar Conta</button>
        </form>

        <div class="auth-footer">
            <p>Já tens conta?</p>
            <a href="login.php" class="btn-auth alt">Entrar</a>
            <a href="index.php" class="auth-back">← Voltar ao site</a>
        </div>
    </div>
</section>

<?php include __DIR__ . "/cookie-banner.php"; ?>
<script src="assets/js/reveal.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
