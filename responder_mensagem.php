<?php
require_once "includes/init.php";
require_once "includes/auth.php";
require_once "includes/chat.php";

exigir_admin();

$conversas = listar_conversas($conn);
$conversaId = intval($_GET["conversa"] ?? 0);
$conversaAtiva = null;
$mensagens = [];
$ultimoId = 0;

if ($conversaId > 0) {
    $conversaAtiva = obter_conversa_por_id($conn, $conversaId);
}

if (!$conversaAtiva && !empty($conversas)) {
    $conversaAtiva = obter_conversa_por_id($conn, intval($conversas[0]["id"]));
    $conversaId = intval($conversaAtiva["id"]);
}

if ($conversaAtiva) {
    marcar_mensagens_como_visualizadas($conn, $conversaId, "user");
    $mensagens = obter_mensagens_chat($conn, $conversaId);
    $ultimoId = empty($mensagens) ? 0 : intval(end($mensagens)["id"]);
}

$viewerRole = "admin";
$bodyClass = "admin-panel-page";

$pageTitle = "Chat Admin | Lone Wolf";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<section class="hero-admin">
    <div class="hero-conteudo">
        <div class="hero-mini">Administracao Lone Wolf</div>
        <h1>Chat</h1>
        <p class="hero-frase">Responde aos utilizadores em tempo real, numa conversa continua.</p>
    </div>
</section>

<section class="chat-page">
    <div class="chat-shell admin">
        <aside class="chat-sidebar">
            <div class="chat-sidebar-header">
                <h2>Conversas</h2>
                <p><?= count($conversas) ?> contacto(s)</p>
            </div>

            <div class="chat-conversas">
                <?php if (empty($conversas)): ?>
                    <div class="chat-empty" style="color:#b8bec6;padding:20px;">
                        Ainda nao existem conversas.
                    </div>
                <?php else: ?>
                    <?php foreach ($conversas as $item): ?>
                        <?php
                        $preview = trim($item["ultima_mensagem"] ?? "");
                        if ($preview === "") {
                            $preview = "Sem mensagens";
                        } elseif (mb_strlen($preview) > 70) {
                            $preview = mb_strimwidth($preview, 0, 70, "...");
                        }
                        ?>
                        <?php
                        $precisaResposta = ($item["ultimo_autor"] ?? "") === "user";
                        ?>
                        <a
                            href="responder_mensagem.php?conversa=<?= intval($item["id"]) ?>"
                            class="chat-conversa-link <?= intval($item["id"]) === $conversaId ? "ativa" : "" ?><?= $precisaResposta ? " pendente" : "" ?>"
                        >
                            <div class="chat-conversa-topo">
                                <span class="chat-conversa-nome">
                                    <?= htmlspecialchars($item["nome"]) ?>
                                    <?php if ($precisaResposta): ?>
                                        <span class="chat-conversa-badge">Por responder</span>
                                    <?php endif; ?>
                                    <?php if (!empty($item["bloqueado"])): ?> · Bloqueado<?php endif; ?>
                                </span>
                                <span class="chat-conversa-hora">
                                    <?= formatar_hora_chat($item["atualizada_em"]) ?>
                                </span>
                            </div>
                            <div class="chat-conversa-preview">
                                <?= htmlspecialchars($preview) ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </aside>

        <div class="chat-main">
            <?php if ($conversaAtiva): ?>
                <div class="chat-header">
                    <div class="chat-header-info">
                        <h3><?= htmlspecialchars($conversaAtiva["nome"]) ?></h3>
                        <p><?= htmlspecialchars($conversaAtiva["email"]) ?></p>
                    </div>

                    <div class="chat-header-acoes">
                        <?php if (!empty($conversaAtiva["bloqueado"])): ?>
                            <span class="chat-status blocked">Bloqueado</span>
                        <?php else: ?>
                            <span class="chat-status online">Ativo</span>
                        <?php endif; ?>

                        <?php if (!empty($conversaAtiva["user_id"])): ?>
                            <a
                                href="toggle_bloqueio.php?id=<?= intval($conversaAtiva["user_id"]) ?>&secao=conversas"
                                class="btn-chat-action <?= !empty($conversaAtiva["bloqueado"]) ? "unblock" : "block" ?>"
                                data-admin-confirm
                                data-confirm-title="<?= !empty($conversaAtiva["bloqueado"]) ? "Desbloquear conta" : "Bloquear conta" ?>"
                                data-confirm-message="<?= !empty($conversaAtiva["bloqueado"]) ? "A conta voltara a poder enviar mensagens." : "A conta ficara bloqueada e deixara de poder enviar mensagens." ?>"
                                data-confirm-text="<?= !empty($conversaAtiva["bloqueado"]) ? "Desbloquear" : "Bloquear" ?>"
                                data-confirm-variant="default"
                                data-confirm-icon="fa-ban"
                            >
                                <?= !empty($conversaAtiva["bloqueado"]) ? "Desbloquear" : "Bloquear" ?>
                            </a>
                        <?php endif; ?>

                        <a href="admin_encomendas.php" class="btn-chat-action back">Painel</a>

                        <a
                            href="chat_apagar_conversa.php?conversa=<?= intval($conversaId) ?>&secao=conversas"
                            class="btn-chat-action apagar"
                            data-admin-confirm
                            data-confirm-title="Apagar conversa"
                            data-confirm-message="Toda esta conversa sera eliminada. Esta acao e irreversivel."
                            data-confirm-text="Apagar conversa"
                            data-confirm-variant="danger"
                            data-confirm-icon="fa-trash-can"
                        >
                            Apagar chat
                        </a>
                    </div>
                </div>

                <div class="chat-messages" id="chat-messages" data-viewer="<?= htmlspecialchars($viewerRole) ?>">
                    <?php if (empty($mensagens)): ?>
                        <div class="chat-empty" id="chat-empty">
                            Esta conversa ainda nao tem mensagens.
                        </div>
                    <?php else: ?>
                        <?php foreach ($mensagens as $msg): ?>
                            <?php if (!mensagem_tem_conteudo($msg)) continue; ?>
                            <?php $mine = bolha_e_minha($msg, $viewerRole); ?>
                            <div class="chat-row <?= $mine ? "mine" : "theirs" ?>" data-autor="<?= htmlspecialchars($msg["autor"]) ?>">
                            <div class="chat-bubble <?= $mine ? "mine" : "theirs" ?>" data-id="<?= intval($msg["id"]) ?>" data-autor="<?= htmlspecialchars($msg["autor"]) ?>">
                                <?= renderizar_acoes_bolha($mine, intval($msg["id"])) ?>
                                <?= renderizar_conteudo_bolha($msg) ?>
                                <div class="chat-bubble-meta">
                                    <span class="chat-bubble-time"><?= formatar_hora_chat($msg["data_envio"]) ?></span>
                                    <?php if ($mine && !empty($msg["visualizada_em"])): ?>
                                        <span class="chat-read-receipt">Mensagem visualizada</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <form class="chat-input-area" id="chat-form">
                    <label class="chat-attach-btn" for="chat-file" aria-label="Anexar ficheiro">
                        <i class="fa-solid fa-paperclip"></i>
                        <input type="file" id="chat-file" accept="image/*,video/*,.pdf,.doc,.docx,.txt,.zip" hidden>
                    </label>
                    <div class="chat-input-wrap">
                        <textarea id="chat-input" placeholder="Escreve a resposta..." rows="1"></textarea>
                        <span class="chat-file-preview" id="chat-file-preview" hidden></span>
                    </div>
                    <button type="submit" class="chat-send-btn" id="chat-send" aria-label="Enviar">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            <?php else: ?>
                <div class="chat-empty" style="margin:auto;">
                    Seleciona uma conversa para comecar.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if ($conversaAtiva): ?>
<script src="assets/js/admin.js"></script>
<script src="assets/js/chat.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    initChat({
        messagesId: "chat-messages",
        formId: "chat-form",
        inputId: "chat-input",
        sendBtnId: "chat-send",
        fileInputId: "chat-file",
        filePreviewId: "chat-file-preview",
        conversaId: <?= intval($conversaId) ?>,
        lastId: <?= $ultimoId ?>,
        viewerRole: "admin"
    });
});
</script>
<?php endif; ?>

<?php include "footer.php"; ?>

</body>
</html>
