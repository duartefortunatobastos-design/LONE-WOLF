<?php
require_once "includes/init.php";
require_once "includes/auth.php";

exigir_admin();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $encomendaId = isset($_POST["encomenda_id"]) ? (int) $_POST["encomenda_id"] : 0;
    $estado = trim($_POST["estado"] ?? "");

    if ($encomendaId > 0 && $estado !== "") {
        if (actualizar_estado_encomenda($conn, $encomendaId, $estado)) {
            header("Location: admin_encomendas.php?sucesso=1");
            exit;
        }
    }

    header("Location: admin_encomendas.php?erro=1");
    exit;
}

$encomendas = listar_todas_encomendas($conn);
$estados = ["pendente", "pago", "enviado", "concluido", "cancelado"];

$pageTitle = "Encomendas Admin | Lone Wolf";
$bodyClass = "admin-panel-page";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<section class="hero-admin">
    <div class="hero-conteudo reveal-page">
        <div class="hero-mini">Administração Lone Wolf</div>
        <h1>Encomendas</h1>
        <p class="hero-frase">Consulta e actualiza o estado das encomendas da loja.</p>
    </div>
</section>

<section class="admin-page">
    <div class="admin-container">

        <?php if (isset($_GET["sucesso"])): ?>
            <div class="alerta sucesso admin-alerta">Estado da encomenda actualizado com sucesso.</div>
        <?php endif; ?>

        <?php if (isset($_GET["erro"])): ?>
            <div class="alerta erro admin-alerta">Não foi possível actualizar a encomenda.</div>
        <?php endif; ?>

        <nav class="admin-nav" aria-label="Secções do painel">
            <a href="admin_mensagens.php" class="admin-nav-link">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Mensagens</span>
            </a>
            <a href="admin_encomendas.php" class="admin-nav-link ativa">
                <i class="fa-solid fa-box"></i>
                <span>Encomendas</span>
                <em><?= count($encomendas) ?></em>
            </a>
            <a href="admin_produtos.php" class="admin-nav-link">
                <i class="fa-solid fa-shirt"></i>
                <span>Produtos</span>
            </a>
        </nav>

        <section class="painel-contas admin-painel-grande reveal-page">
            <header class="admin-painel-header">
                <div class="admin-painel-heading">
                    <h2>Lista de encomendas</h2>
                    <p class="painel-subtitulo">Total: <?= count($encomendas) ?> encomenda(s)</p>
                </div>
            </header>

            <?php if (empty($encomendas)): ?>
                <div class="sem-mensagens">Ainda não existem encomendas.</div>
            <?php else: ?>
                <div class="admin-contas-list">
                    <?php foreach ($encomendas as $encomenda): ?>
                        <?php $itens = obter_itens_encomenda($conn, (int) $encomenda["id"]); ?>
                        <article class="admin-conta-card">
                            <div class="admin-conta-perfil">
                                <span class="conta-avatar">#</span>
                                <div class="admin-conta-info">
                                    <strong class="utilizador-nome">Encomenda #<?= (int) $encomenda["id"] ?></strong>
                                    <span class="utilizador-email"><?= htmlspecialchars($encomenda["nome"]) ?> — <?= htmlspecialchars($encomenda["email"]) ?></span>
                                    <span class="admin-conversa-preview">
                                        <?= date("d/m/Y H:i", strtotime($encomenda["criada_em"])) ?>
                                        · <?= htmlspecialchars(label_metodo_pagamento($encomenda["metodo_pagamento"])) ?>
                                        · <?= formatar_preco((float) $encomenda["total"]) ?>
                                    </span>
                                    <?php if (!empty($itens)): ?>
                                        <span class="admin-conversa-preview">
                                            <?php
                                            $resumoItens = [];
                                            foreach ($itens as $item) {
                                                $resumoItens[] = htmlspecialchars($item["nome"]) . " x" . (int) $item["quantidade"];
                                            }
                                            echo implode(", ", $resumoItens);
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="admin-conta-estado">
                                <span class="estado-badge estado-<?= htmlspecialchars($encomenda["estado"]) ?>">
                                    <?= label_estado_encomenda($encomenda["estado"]) ?>
                                </span>
                            </div>

                            <div class="admin-conta-acoes">
                                <form method="POST" class="admin-form-inline">
                                    <input type="hidden" name="encomenda_id" value="<?= (int) $encomenda["id"] ?>">
                                    <select name="estado" aria-label="Estado da encomenda">
                                        <?php foreach ($estados as $estado): ?>
                                            <option value="<?= htmlspecialchars($estado) ?>"<?= $encomenda["estado"] === $estado ? " selected" : "" ?>>
                                                <?= label_estado_encomenda($estado) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn-action guardar">
                                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                                    </button>
                                </form>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>
</section>

<script src="assets/js/admin.js"></script>
<?php include "footer.php"; ?>

</body>
</html>
