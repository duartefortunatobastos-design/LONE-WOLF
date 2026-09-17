<?php
require_once "includes/init.php";
require_once "includes/auth.php";

exigir_admin();

$secao = $_GET["secao"] ?? "resumo";
if (!in_array($secao, ["resumo", "contas"], true)) {
    $secao = "resumo";
}

$sqlUtilizadores = "SELECT id, nome, email, tipo, bloqueado FROM utilizadores ORDER BY id ASC";
$resultadoUtilizadores = $conn->query($sqlUtilizadores);

$utilizadores = [];
$totalUtilizadores = 0;
$totalAdmins = 0;
$totalBloqueados = 0;

if ($resultadoUtilizadores && $resultadoUtilizadores->num_rows > 0) {
    while ($utilizador = $resultadoUtilizadores->fetch_assoc()) {
        $utilizadores[] = $utilizador;
        $totalUtilizadores++;

        if (($utilizador["tipo"] ?? "") === "admin") {
            $totalAdmins++;
        }

        if (!empty($utilizador["bloqueado"])) {
            $totalBloqueados++;
        }
    }
}

usort($utilizadores, function ($a, $b) {
    $aAdmin = ($a["tipo"] ?? "") === "admin";
    $bAdmin = ($b["tipo"] ?? "") === "admin";

    if ($aAdmin !== $bAdmin) {
        return $aAdmin ? -1 : 1;
    }

    return intval($a["id"]) <=> intval($b["id"]);
});

$totalEncomendas = 0;
$totalProdutos = 0;
$resEncomendas = $conn->query("SELECT COUNT(*) AS n FROM encomendas");
if ($resEncomendas) {
    $totalEncomendas = (int) ($resEncomendas->fetch_assoc()["n"] ?? 0);
}
$resProdutos = $conn->query("SELECT COUNT(*) AS n FROM produtos");
if ($resProdutos) {
    $totalProdutos = (int) ($resProdutos->fetch_assoc()["n"] ?? 0);
}

$adminId = intval($_SESSION["user_id"] ?? 0);

$pageTitle = $secao === "contas" ? "Contas Admin | Lone Wolf" : "Painel Admin | Lone Wolf";
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
            <?php if ($secao === "contas"): ?>
                <?php include "includes/admin-voltar.php"; ?>
            <?php endif; ?>
        </div>
        <h1><?= $secao === "contas" ? "Contas" : "Painel Admin" ?></h1>
        <p class="hero-frase">
            <?= $secao === "contas" ? "Contas criadas no site." : "Encomendas, produtos e contas num só sítio." ?>
        </p>
    </div>
</section>

<section class="ds-section">
    <div class="ds-container">

        <?php if (isset($_GET["sucesso"]) && $_GET["sucesso"] === "bloqueio"): ?>
            <div class="alerta sucesso admin-alerta">Estado da conta atualizado com sucesso.</div>
        <?php endif; ?>

        <?php if (isset($_GET["sucesso"]) && $_GET["sucesso"] === "apagar_conta"): ?>
            <div class="alerta sucesso admin-alerta">Conta eliminada com sucesso.</div>
        <?php endif; ?>

        <?php if (isset($_GET["erro"])): ?>
            <div class="alerta erro admin-alerta">
                <?php if (($_GET["erro"] ?? "") === "apagar_conta"): ?>
                    Não foi possível apagar esta conta.
                <?php else: ?>
                    Não foi possível concluir a operação.
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php include "includes/admin-nav.php"; ?>

        <?php if ($secao === "resumo"): ?>
            <section class="admin-stats reveal-page">
                <article class="ds-card admin-kpi" style="background:#151517;border:1px solid #26262a;border-radius:4px;">
                    <span class="stat-label">Encomendas</span>
                    <strong class="ds-stat"><?= $totalEncomendas ?></strong>
                </article>
                <article class="ds-card admin-kpi" style="background:#151517;border:1px solid #26262a;border-radius:4px;">
                    <span class="stat-label">Produtos</span>
                    <strong class="ds-stat"><?= $totalProdutos ?></strong>
                </article>
                <article class="ds-card admin-kpi" style="background:#151517;border:1px solid #26262a;border-radius:4px;">
                    <span class="stat-label">Contas</span>
                    <strong class="ds-stat"><?= $totalUtilizadores ?></strong>
                </article>
                <article class="ds-card admin-kpi" style="background:#151517;border:1px solid #26262a;border-radius:4px;">
                    <span class="stat-label">Bloqueados</span>
                    <strong class="ds-stat"><?= $totalBloqueados ?></strong>
                </article>
            </section>

            <section class="races-grid admin-quick-grid reveal-page">
                <a href="admin_encomendas.php" class="ds-card">
                    <span class="admin-quick-icon"><i class="fa-solid fa-box"></i></span>
                    <h3 class="ds-title">Encomendas</h3>
                    <p class="ds-text">Consulta e actualiza o estado das encomendas da loja.</p>
                    <span class="ds-stat"><?= $totalEncomendas ?> encomenda(s)</span>
                </a>
                <a href="admin_produtos.php" class="ds-card">
                    <span class="admin-quick-icon"><i class="fa-solid fa-shirt"></i></span>
                    <h3 class="ds-title">Produtos</h3>
                    <p class="ds-text">Edita preço, estado activo e badge dos produtos.</p>
                    <span class="ds-stat"><?= $totalProdutos ?> produto(s)</span>
                </a>
                <a href="admin_mensagens.php?secao=contas" class="ds-card">
                    <span class="admin-quick-icon"><i class="fa-solid fa-users"></i></span>
                    <h3 class="ds-title">Contas</h3>
                    <p class="ds-text">Vê as contas criadas no site.</p>
                    <span class="ds-stat"><?= $totalUtilizadores - $totalAdmins ?> utilizador(es)</span>
                </a>
            </section>
        <?php endif; ?>

        <?php if ($secao === "contas"): ?>
            <section class="reveal-page">
                <header class="admin-painel-header">
                    <div class="admin-painel-heading">
                        <h2 class="ds-title">Contas registadas</h2>
                        <p class="painel-subtitulo ds-text">Utilizadores criados no site.</p>
                    </div>
                    <div class="admin-painel-resumo">
                        <span class="resumo-chip">Total <strong><?= $totalUtilizadores ?></strong></span>
                        <span class="resumo-chip">Utilizadores <strong><?= $totalUtilizadores - $totalAdmins ?></strong></span>
                        <span class="resumo-chip">Admins <strong><?= $totalAdmins ?></strong></span>
                    </div>
                </header>

                <?php if (!empty($utilizadores)): ?>
                    <div class="admin-contas-list">
                        <?php foreach ($utilizadores as $utilizador): ?>
                            <?php
                            $inicial = mb_strtoupper(mb_substr(trim($utilizador["nome"]), 0, 1));
                            $isAdmin = ($utilizador["tipo"] ?? "") === "admin";
                            $isBlocked = !empty($utilizador["bloqueado"]);
                            $isSelf = intval($utilizador["id"]) === $adminId;
                            ?>
                            <article class="ds-card admin-conta-card<?= $isBlocked ? " conta-bloqueada" : "" ?>">
                                <div class="admin-conta-perfil">
                                    <span class="conta-avatar"><?= htmlspecialchars($inicial) ?></span>
                                    <div class="admin-conta-info">
                                        <strong class="utilizador-nome"><?= htmlspecialchars($utilizador["nome"]) ?></strong>
                                        <span class="conta-id">#<?= intval($utilizador["id"]) ?></span>
                                        <span class="utilizador-email"><?= htmlspecialchars($utilizador["email"]) ?></span>
                                    </div>
                                </div>

                                <div class="admin-conta-estado">
                                    <?php if ($isBlocked): ?>
                                        <span class="tipo-conta blocked">Bloqueado</span>
                                    <?php else: ?>
                                        <span class="tipo-conta user">Ativo</span>
                                    <?php endif; ?>

                                    <?php if ($isAdmin): ?>
                                        <span class="tipo-conta admin">Admin</span>
                                    <?php else: ?>
                                        <span class="tipo-conta user">Utilizador</span>
                                    <?php endif; ?>
                                </div>

                                <div class="admin-conta-acoes single">
                                    <?php if ($isAdmin): ?>
                                        <span class="admin-conta-sem-acao">Conta protegida</span>
                                    <?php else: ?>
                                        <div class="admin-menu-wrap">
                                            <button type="button" class="admin-menu-btn" aria-label="Gerir conta" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis"></i>
                                                <span>Gerir</span>
                                            </button>
                                            <div class="admin-menu" hidden>
                                                <a
                                                    class="admin-menu-item"
                                                    href="toggle_bloqueio.php?id=<?= intval($utilizador["id"]) ?>&secao=contas"
                                                    data-admin-confirm
                                                    data-confirm-title="<?= $isBlocked ? "Desbloquear conta" : "Bloquear conta" ?>"
                                                    data-confirm-message="<?= $isBlocked ? "A conta volta a poder aceder ao site." : "A conta fica bloqueada." ?>"
                                                    data-confirm-text="<?= $isBlocked ? "Desbloquear" : "Bloquear" ?>"
                                                    data-confirm-variant="default"
                                                    data-confirm-icon="fa-ban"
                                                >
                                                    <i class="fa-solid fa-ban"></i>
                                                    <?= $isBlocked ? "Desbloquear conta" : "Bloquear conta" ?>
                                                </a>
                                                <?php if (!$isSelf): ?>
                                                    <button
                                                        type="button"
                                                        class="admin-menu-item danger"
                                                        data-apagar-conta="<?= intval($utilizador["id"]) ?>"
                                                        data-nome="<?= htmlspecialchars($utilizador["nome"]) ?>"
                                                    >
                                                        <i class="fa-solid fa-user-xmark"></i> Apagar conta
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="sem-mensagens ds-card">Ainda não existem contas registadas.</div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

    </div>
</section>
</main>

<script src="assets/js/admin.js"></script>
<?php include "footer.php"; ?>

</body>
</html>
