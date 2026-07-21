<?php
require_once "includes/init.php";
require_once "includes/auth.php";
require_once "includes/chat.php";

exigir_admin();

$secao = $_GET["secao"] ?? "resumo";
if (!in_array($secao, ["resumo", "contas", "conversas"], true)) {
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
        $conversa = obter_conversa_por_email($conn, $utilizador["email"]);
        $utilizador["conversa_id"] = $conversa ? intval($conversa["id"]) : 0;
        $utilizador["precisa_resposta"] = $conversa
            ? conversa_precisa_resposta($conn, intval($conversa["id"]))
            : false;

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

$conversas = listar_conversas($conn);
$chatsPendentes = contar_conversas_pendentes_admin($conn);
$resultadoConversas = $conn->query("SELECT COUNT(*) AS total FROM conversas");
$totalConversas = intval($resultadoConversas->fetch_assoc()["total"] ?? 0);
$adminId = intval($_SESSION["user_id"] ?? 0);

$pageTitle = "Painel Admin | Lone Wolf";
$bodyClass = "admin-panel-page";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<section class="hero-admin">
    <div class="hero-conteudo reveal-page">
        <div class="hero-mini">Administracao Lone Wolf</div>
        <h1>Painel Admin</h1>
        <p class="hero-frase">
            Gere contas, conversas e mantem a plataforma organizada num unico lugar.
        </p>
    </div>
</section>

<section class="admin-page">
    <div class="admin-container">

        <?php if (isset($_GET["sucesso"]) && $_GET["sucesso"] === "bloqueio"): ?>
            <div class="alerta sucesso admin-alerta">Estado da conta atualizado com sucesso.</div>
        <?php endif; ?>

        <?php if (isset($_GET["sucesso"]) && $_GET["sucesso"] === "apagar"): ?>
            <div class="alerta sucesso admin-alerta">Conversa apagada com sucesso.</div>
        <?php endif; ?>

        <?php if (isset($_GET["sucesso"]) && $_GET["sucesso"] === "apagar_conta"): ?>
            <div class="alerta sucesso admin-alerta">Conta eliminada com sucesso.</div>
        <?php endif; ?>

        <?php if (isset($_GET["erro"])): ?>
            <div class="alerta erro admin-alerta">
                <?php if (($_GET["erro"] ?? "") === "apagar_conta"): ?>
                    Nao foi possivel apagar esta conta.
                <?php else: ?>
                    Nao foi possivel concluir a operacao.
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <nav class="admin-nav" aria-label="Secoes do painel">
            <a href="admin_mensagens.php?secao=resumo" class="admin-nav-link<?= $secao === "resumo" ? " ativa" : "" ?>">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Resumo</span>
            </a>
            <a href="admin_mensagens.php?secao=contas" class="admin-nav-link<?= $secao === "contas" ? " ativa" : "" ?>">
                <i class="fa-solid fa-users"></i>
                <span>Contas</span>
                <em><?= $totalUtilizadores - $totalAdmins ?></em>
            </a>
            <a href="admin_mensagens.php?secao=conversas" class="admin-nav-link<?= $secao === "conversas" ? " ativa" : "" ?>">
                <i class="fa-solid fa-comments"></i>
                <span>Conversas</span>
                <?php if ($chatsPendentes > 0): ?>
                    <em class="alerta"><?= $chatsPendentes ?></em>
                <?php else: ?>
                    <em><?= $totalConversas ?></em>
                <?php endif; ?>
            </a>
            <a href="admin_encomendas.php" class="admin-nav-link">
                <i class="fa-solid fa-box"></i>
                <span>Encomendas</span>
            </a>
            <a href="admin_produtos.php" class="admin-nav-link">
                <i class="fa-solid fa-shirt"></i>
                <span>Produtos</span>
            </a>
            <a href="responder_mensagem.php" class="admin-nav-link admin-nav-cta">
                <i class="fa-solid fa-message"></i>
                <span>Abrir chat</span>
            </a>
        </nav>

        <?php if ($secao === "resumo"): ?>
            <section class="admin-stats admin-stats-grande reveal-page">
                <div class="stat-card">
                    <div class="stat-label">Contas</div>
                    <div class="stat-value"><?= $totalUtilizadores ?></div>
                </div>

                <div class="stat-card<?= $chatsPendentes > 0 ? " stat-card-alert" : "" ?>">
                    <div class="stat-label">Por Responder</div>
                    <div class="stat-value"><?= $chatsPendentes ?></div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Conversas</div>
                    <div class="stat-value"><?= $totalConversas ?></div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Bloqueados</div>
                    <div class="stat-value"><?= $totalBloqueados ?></div>
                </div>
            </section>

            <section class="admin-quick-grid reveal-page">
                <a href="admin_mensagens.php?secao=contas" class="admin-quick-card">
                    <span class="admin-quick-icon"><i class="fa-solid fa-user-gear"></i></span>
                    <strong>Gerir contas</strong>
                    <p>Bloquear, desbloquear ou apagar utilizadores registados.</p>
                    <span class="admin-quick-meta"><?= $totalUtilizadores - $totalAdmins ?> utilizadores</span>
                </a>

                <a href="admin_mensagens.php?secao=conversas" class="admin-quick-card<?= $chatsPendentes > 0 ? " pendente" : "" ?>">
                    <span class="admin-quick-icon"><i class="fa-solid fa-inbox"></i></span>
                    <strong>Ver conversas</strong>
                    <p>Responde a mensagens e gere historico de contacto.</p>
                    <span class="admin-quick-meta">
                        <?= $chatsPendentes > 0 ? $chatsPendentes . " por responder" : $totalConversas . " conversas" ?>
                    </span>
                </a>

                <a href="responder_mensagem.php" class="admin-quick-card">
                    <span class="admin-quick-icon"><i class="fa-solid fa-paper-plane"></i></span>
                    <strong>Ir para o chat</strong>
                    <p>Abre a area de mensagens em tempo real.</p>
                    <span class="admin-quick-meta">Resposta rapida</span>
                </a>
            </section>

            <?php if ($chatsPendentes > 0): ?>
                <section class="painel-contas admin-painel-grande reveal-page">
                    <header class="admin-painel-header compacto">
                        <div class="admin-painel-heading">
                            <h2>Atencao imediata</h2>
                            <p class="painel-subtitulo">Conversas que aguardam resposta da administracao.</p>
                        </div>
                    </header>

                    <div class="admin-contas-list">
                        <?php foreach ($conversas as $item): ?>
                            <?php if (($item["ultimo_autor"] ?? "") !== "user") continue; ?>
                            <article class="admin-conta-card conta-pendente">
                                <div class="admin-conta-perfil">
                                    <span class="conta-avatar"><?= htmlspecialchars(mb_strtoupper(mb_substr(trim($item["nome"]), 0, 1))) ?></span>
                                    <div class="admin-conta-info">
                                        <strong class="utilizador-nome"><?= htmlspecialchars($item["nome"]) ?></strong>
                                        <span class="utilizador-email"><?= htmlspecialchars($item["email"]) ?></span>
                                    </div>
                                </div>
                                <div class="admin-conta-estado">
                                    <span class="conta-alerta"><i class="fa-solid fa-circle-exclamation"></i> Por responder</span>
                                </div>
                                <div class="admin-conta-acoes single">
                                    <a class="btn-action guardar urgente" href="responder_mensagem.php?conversa=<?= intval($item["id"]) ?>">
                                        <i class="fa-solid fa-reply"></i> Responder
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($secao === "contas"): ?>
            <section class="painel-contas admin-painel-grande reveal-page">
                <header class="admin-painel-header">
                    <div class="admin-painel-heading">
                        <h2>Contas registadas</h2>
                        <p class="painel-subtitulo">Gerir utilizadores, estado das contas e permissoes de acesso.</p>
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
                            <article class="admin-conta-card<?= $isBlocked ? " conta-bloqueada" : "" ?>">
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

                                    <?php if ($utilizador["precisa_resposta"]): ?>
                                        <span class="conta-alerta"><i class="fa-solid fa-comment-dots"></i> Chat pendente</span>
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
                                                <?php if ($utilizador["conversa_id"] > 0): ?>
                                                    <a
                                                        class="admin-menu-item"
                                                        href="responder_mensagem.php?conversa=<?= $utilizador["conversa_id"] ?>"
                                                    >
                                                        <i class="fa-solid fa-message"></i> Abrir conversa
                                                    </a>
                                                <?php endif; ?>
                                                <a
                                                    class="admin-menu-item"
                                                    href="toggle_bloqueio.php?id=<?= intval($utilizador["id"]) ?>&secao=contas"
                                                    data-admin-confirm
                                                    data-confirm-title="<?= $isBlocked ? "Desbloquear conta" : "Bloquear conta" ?>"
                                                    data-confirm-message="<?= $isBlocked ? "A conta voltara a poder enviar mensagens e aceder ao chat." : "A conta ficara bloqueada e deixara de poder enviar mensagens." ?>"
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
                    <div class="sem-mensagens">Ainda nao existem contas registadas.</div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <?php if ($secao === "conversas"): ?>
            <section class="painel-contas admin-painel-grande reveal-page">
                <header class="admin-painel-header">
                    <div class="admin-painel-heading">
                        <h2>Conversas</h2>
                        <p class="painel-subtitulo">Historico de contacto com utilizadores e gestao de chats.</p>
                    </div>
                    <div class="admin-painel-resumo">
                        <?php if ($chatsPendentes > 0): ?>
                            <span class="badge-pendente-global">
                                <i class="fa-solid fa-comment-dots"></i>
                                <?= $chatsPendentes ?> por responder
                            </span>
                        <?php endif; ?>
                        <span class="resumo-chip">Total <strong><?= $totalConversas ?></strong></span>
                    </div>
                </header>

                <?php if (!empty($conversas)): ?>
                    <div class="admin-contas-list">
                        <?php foreach ($conversas as $item): ?>
                            <?php
                            $preview = trim($item["ultima_mensagem"] ?? "");
                            if ($preview === "") {
                                $preview = "Sem mensagens";
                            } elseif (mb_strlen($preview) > 90) {
                                $preview = mb_strimwidth($preview, 0, 90, "...");
                            }
                            $precisaResposta = ($item["ultimo_autor"] ?? "") === "user";
                            ?>
                            <article class="admin-conta-card<?= $precisaResposta ? " conta-pendente" : "" ?>">
                                <div class="admin-conta-perfil">
                                    <span class="conta-avatar"><?= htmlspecialchars(mb_strtoupper(mb_substr(trim($item["nome"]), 0, 1))) ?></span>
                                    <div class="admin-conta-info">
                                        <strong class="utilizador-nome"><?= htmlspecialchars($item["nome"]) ?></strong>
                                        <span class="utilizador-email"><?= htmlspecialchars($item["email"]) ?></span>
                                        <span class="admin-conversa-preview"><?= htmlspecialchars($preview) ?></span>
                                    </div>
                                </div>

                                <div class="admin-conta-estado">
                                    <?php if ($precisaResposta): ?>
                                        <span class="conta-alerta"><i class="fa-solid fa-circle-exclamation"></i> Por responder</span>
                                    <?php else: ?>
                                        <span class="tipo-conta user">Em dia</span>
                                    <?php endif; ?>
                                    <span class="admin-conversa-hora"><?= formatar_hora_chat($item["atualizada_em"]) ?></span>
                                </div>

                                <div class="admin-conta-acoes single">
                                    <a
                                        class="btn-action guardar<?= $precisaResposta ? " urgente" : "" ?>"
                                        href="responder_mensagem.php?conversa=<?= intval($item["id"]) ?>"
                                    >
                                        <i class="fa-solid fa-reply"></i>
                                        <?= $precisaResposta ? "Responder" : "Abrir chat" ?>
                                    </a>

                                    <div class="admin-menu-wrap">
                                        <button type="button" class="admin-menu-btn icon-only" aria-label="Mais opcoes" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="admin-menu" hidden>
                                            <a
                                                class="admin-menu-item danger"
                                                href="chat_apagar_conversa.php?conversa=<?= intval($item["id"]) ?>&secao=conversas"
                                                data-admin-confirm
                                                data-confirm-title="Apagar conversa"
                                                data-confirm-message="Toda a conversa com <?= htmlspecialchars($item["nome"]) ?> sera eliminada. Esta acao e irreversivel."
                                                data-confirm-text="Apagar conversa"
                                                data-confirm-variant="danger"
                                                data-confirm-icon="fa-trash-can"
                                            >
                                                <i class="fa-solid fa-trash"></i> Apagar conversa
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="sem-mensagens">Ainda nao existem conversas.</div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

    </div>
</section>

<script src="assets/js/admin.js"></script>

<?php include "footer.php"; ?>

</body>
</html>
