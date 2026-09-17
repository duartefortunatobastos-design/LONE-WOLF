<?php

require_once "includes/init.php";

require_once "includes/auth.php";

require_once "includes/chat.php";



exigir_login();



$userId = intval($_SESSION["user_id"]);

$nome = $_SESSION["nome"] ?? "Utilizador";

$email = $_SESSION["email"] ?? "";



if (utilizador_bloqueado($conn, $userId)) {

    $bloqueado = true;

} else {

    $bloqueado = false;

}



$conversaId = obter_ou_criar_conversa($conn, $userId, $nome, $email);

$conversa = obter_conversa_por_id($conn, $conversaId);

marcar_mensagens_como_visualizadas($conn, $conversaId, "admin");

$mensagens = obter_mensagens_chat($conn, $conversaId);

$ultimoId = empty($mensagens) ? 0 : intval(end($mensagens)["id"]);

$viewerRole = "user";



$pageTitle = "Chat | Lone Wolf";
$bodyClass = "content-page";

require_once "includes/head.php";

?>



<?php include "header.php"; ?>



<section class="hero-page">

    <div class="hero-conteudo">

        <div class="hero-mini">Area do Utilizador</div>

        <h1>Chat</h1>

        <p class="hero-frase">Fala diretamente com a equipa Lone Wolf, como numa conversa.</p>

    </div>

</section>



<section class="chat-page">

    <div class="chat-shell">

        <div class="chat-main">

            <div class="chat-header">

                <div class="chat-header-info">

                    <h3>Lone Wolf Admin</h3>

                    <p>Conversa privada com a administracao</p>

                </div>

                <span class="chat-status online">Online</span>

            </div>



            <div class="chat-messages" id="chat-messages" data-viewer="<?= htmlspecialchars($viewerRole) ?>">

                <?php if (empty($mensagens)): ?>

                    <div class="chat-empty" id="chat-empty">

                        Ainda nao existem mensagens. Envia a primeira para comecar a conversa.

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



            <?php if ($bloqueado): ?>

                <div class="chat-blocked-notice">

                    A tua conta foi bloqueada. Nao podes enviar novas mensagens.

                </div>

            <?php else: ?>

                <form class="chat-input-area" id="chat-form">

                    <label class="chat-attach-btn" for="chat-file" aria-label="Anexar ficheiro">

                        <i class="fa-solid fa-paperclip"></i>

                        <input type="file" id="chat-file" accept="image/*,video/*,.pdf,.doc,.docx,.txt,.zip" hidden>

                    </label>

                    <div class="chat-input-wrap">

                        <textarea id="chat-input" placeholder="Escreve a tua mensagem..." rows="1"></textarea>

                        <span class="chat-file-preview" id="chat-file-preview" hidden></span>

                    </div>

                    <button type="submit" class="chat-send-btn" id="chat-send" aria-label="Enviar">

                        <i class="fa-solid fa-paper-plane"></i>

                    </button>

                </form>

            <?php endif; ?>

        </div>

    </div>

</section>



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

        viewerRole: "user"

    });

});

</script>



<?php include "footer.php"; ?>



</body>

</html>

