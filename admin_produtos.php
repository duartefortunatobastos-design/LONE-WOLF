<?php
require_once "includes/init.php";
require_once "includes/auth.php";

exigir_admin();

$mensagemSucesso = false;
$mensagemErro = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $produtoId = isset($_POST["produto_id"]) ? (int) $_POST["produto_id"] : 0;
    $precoRaw = str_replace(",", ".", trim($_POST["preco"] ?? "0"));
    $preco = is_numeric($precoRaw) ? (float) $precoRaw : -1;
    $activo = isset($_POST["activo"]) ? 1 : 0;
    $badge = trim($_POST["badge"] ?? "");

    if ($produtoId > 0 && $preco >= 0) {
        $stmt = $conn->prepare("UPDATE produtos SET preco = ?, activo = ?, badge = ? WHERE id = ?");
        $stmt->bind_param("disi", $preco, $activo, $badge, $produtoId);

        if ($stmt->execute()) {
            $mensagemSucesso = true;
        } else {
            $mensagemErro = true;
        }

        $stmt->close();
    } else {
        $mensagemErro = true;
    }
}

$produtos = obter_produtos($conn, false);

$pageTitle = "Produtos Admin | Lone Wolf";
$bodyClass = "admin-panel-page";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>
<?php include "includes/admin-ds.php"; ?>

<main class="lw-admin">
<section class="hero-admin">
    <div class="hero-conteudo reveal-page">
        <div class="admin-hero-top">
            <div class="hero-mini">Administração Lone Wolf</div>
            <?php include "includes/admin-voltar.php"; ?>
        </div>
        <h1>Produtos</h1>
        <p class="hero-frase">Edita preço, estado activo e badge dos produtos da loja.</p>
    </div>
</section>

<section class="ds-section">
    <div class="ds-container">

        <?php if ($mensagemSucesso): ?>
            <div class="alerta sucesso admin-alerta">Produto actualizado com sucesso.</div>
        <?php endif; ?>

        <?php if ($mensagemErro): ?>
            <div class="alerta erro admin-alerta">Não foi possível actualizar o produto.</div>
        <?php endif; ?>

        <?php include "includes/admin-nav.php"; ?>

        <section class="reveal-page">
            <header class="admin-painel-header">
                <div class="admin-painel-heading">
                    <h2 class="ds-title">Catálogo de produtos</h2>
                    <p class="painel-subtitulo ds-text">Total: <?= count($produtos) ?> produto(s)</p>
                </div>
            </header>

            <?php if (empty($produtos)): ?>
                <div class="sem-mensagens ds-card">Ainda não existem produtos registados.</div>
            <?php else: ?>
                <div class="admin-contas-list">
                    <?php foreach ($produtos as $produto): ?>
                        <article class="ds-card admin-produto-card">
                            <div class="admin-conta-perfil">
                                <?php if (!empty($produto["imagem"])): ?>
                                    <img src="<?= htmlspecialchars($produto["imagem"]) ?>" alt="" class="admin-produto-thumb" width="64" height="64">
                                <?php endif; ?>
                                <div class="admin-conta-info">
                                    <strong class="utilizador-nome"><?= htmlspecialchars($produto["nome"]) ?></strong>
                                    <span class="utilizador-email">#<?= (int) $produto["id"] ?> · <?= htmlspecialchars($produto["categoria"]) ?></span>
                                    <span class="admin-conversa-preview"><?= htmlspecialchars($produto["descricao"] ?? "") ?></span>
                                </div>
                            </div>

                            <form method="POST" class="admin-produto-form">
                                <input type="hidden" name="produto_id" value="<?= (int) $produto["id"] ?>">

                                <label>
                                    Preço (€)
                                    <input type="text" name="preco" value="<?= htmlspecialchars(number_format((float) $produto["preco"], 2, ".", "")) ?>" required>
                                </label>

                                <label>
                                    Badge
                                    <input type="text" name="badge" value="<?= htmlspecialchars($produto["badge"] ?? "") ?>" maxlength="80">
                                </label>

                                <label class="admin-checkbox-label">
                                    <input type="checkbox" name="activo" value="1"<?= !empty($produto["activo"]) ? " checked" : "" ?>>
                                    Activo na loja
                                </label>

                                <button type="submit" class="ds-btn ds-btn-primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                                </button>
                            </form>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>
</section>
</main>

<script src="assets/js/admin.js"></script>
<?php include "footer.php"; ?>

</body>
</html>
