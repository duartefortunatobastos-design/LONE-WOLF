<?php
session_start();
require_once("ligacao.php"); // ligação à base de dados
include 'header.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = $_POST["username"];
    $pass = $_POST["password"];

    // Preparar query para buscar o admin
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $admin = $resultado->fetch_assoc();

    if ($admin && password_verify($pass, $admin["password"])) {
        // Login válido → criar sessão
        $_SESSION["admin"] = $user;
        header("Location: admin_mensagens.php");
        exit();
    } else {
        $erro = "Credenciais inválidas!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
    <head>
    <?php include __DIR__ . "/includes/stylesheets.php"; ?>

        <meta charset="UTF-8">
        <title>Admin - Lone Wolf</title>
    </head>
    <body>
        <section class="admin-hero">
            <div class="admin-box">
                <h2>Administração</h2>
                <?php if (isset($erro)) echo "<div class='admin-error'>$erro</div>"; ?>
                <form method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button class="btn-admin entrar">Entrar</button>
                    <a href="index.php" class="btn-admin voltar">Voltar</a>
                </form>
            </div>
        </section>
    </body>

    <?php
    include 'footer.php';
    ?>
    
</html>