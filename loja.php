<?php
require_once "includes/init.php";

$pageTitle = "Loja | Lone Wolf";
$bodyClass = "pagina-loja";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="pagina-loja">
<?php if (loja_esta_ativa()): ?>
    <?php
    $produtos = obter_produtos($conn);
    require __DIR__ . "/includes/loja-conteudo.php";
    ?>
<?php else: ?>
    <?php require __DIR__ . "/includes/loja-em-breve.php"; ?>
<?php endif; ?>
</main>

<?php include "footer.php"; ?>
</body>
</html>
