<?php
require_once "includes/init.php";
require_once "includes/auth.php";
require_once "includes/chat.php";

$mensagem_sucesso = "";
$mensagem_erro = "";

$nome_utilizador = $_SESSION["nome"] ?? "";
$email_utilizador = $_SESSION["email"] ?? "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION["user_id"])) {
        $_SESSION["form_nome"] = trim($_POST["nome"] ?? "");
        $_SESSION["form_email"] = trim($_POST["email"] ?? "");
        $_SESSION["form_mensagem"] = trim($_POST["mensagem"] ?? "");
        $_SESSION["redirect_after_login"] = "contatos.php";
        header("Location: login.php");
        exit();
    }

    if (utilizador_bloqueado($conn, intval($_SESSION["user_id"]))) {
        $mensagem_erro = "A tua conta foi bloqueada. Nao podes enviar mensagens.";
    } else {
        $nome = $_SESSION["nome"] ?? "";
        $email = $_SESSION["email"] ?? "";
        $userId = intval($_SESSION["user_id"]);
        $mensagem = trim($_POST["mensagem"] ?? "");

        if ($mensagem !== "") {
            $conversaId = obter_ou_criar_conversa($conn, $userId, $nome, $email);

            if (inserir_mensagem_chat($conn, $conversaId, "user", $mensagem)) {
                $mensagem_sucesso = "Mensagem enviada! Abre Mensagens no menu para continuar a conversa.";
                unset($_SESSION["form_nome"], $_SESSION["form_email"], $_SESSION["form_mensagem"]);
            } else {
                $mensagem_erro = "Erro ao enviar a mensagem.";
            }
        } else {
            $mensagem_erro = "Escreve uma mensagem antes de enviar.";
        }
    }
}

$pageTitle = "Contacto | Lone Wolf";
$bodyClass = "content-page";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="contacto-page-main">
<section class="hero-contacto">
    <div class="hero-conteudo reveal-page">
        <div class="hero-mini" data-i18n="heroMini">Rui Bastos</div>
        <h1 data-i18n="heroTitle">Contacto</h1>
        <p class="hero-frase" data-i18n="heroPhrase">
            Fala comigo para parcerias, patrocínios ou qualquer questão.
        </p>
    </div>
</section>

<section class="page-section secao-contactos">
    <div class="container-contactos">
        <div class="grelha-contactos">
            <div class="coluna-formulario reveal-page">
                <div class="bloco-titulo">
                    <h2 data-i18n="sendTitle">Envia uma<br>mensagem</h2>
                    <div class="linha-laranja"></div>
                </div>

                <?php if ($mensagem_sucesso !== ""): ?>
                    <div class="alerta sucesso"><?= htmlspecialchars($mensagem_sucesso) ?></div>
                <?php endif; ?>

                <?php if ($mensagem_erro !== ""): ?>
                    <div class="alerta erro"><?= htmlspecialchars($mensagem_erro) ?></div>
                <?php endif; ?>

                <form method="POST" class="formulario-contacto">
                    <?php if (isset($_SESSION["user_id"])): ?>
                        <input type="text" value="<?= htmlspecialchars($nome_utilizador) ?>" disabled>
                        <input type="email" value="<?= htmlspecialchars($email_utilizador) ?>" disabled>
                    <?php else: ?>
                        <input
                            type="text"
                            name="nome"
                            data-i18n-placeholder="namePlaceholder"
                            placeholder="O teu nome"
                            required
                            value="<?= htmlspecialchars($_SESSION["form_nome"] ?? "") ?>"
                        >
                        <input
                            type="email"
                            name="email"
                            data-i18n-placeholder="emailPlaceholder"
                            placeholder="O teu e-mail"
                            required
                            value="<?= htmlspecialchars($_SESSION["form_email"] ?? "") ?>"
                        >
                    <?php endif; ?>

                    <textarea
                        name="mensagem"
                        data-i18n-placeholder="messagePlaceholder"
                        placeholder="A tua mensagem"
                        required
                    ><?= htmlspecialchars($_SESSION["form_mensagem"] ?? "") ?></textarea>

                    <button type="submit" class="botao-enviar">
                        <span data-i18n="sendButton">Enviar Mensagem</span>
                        <i class="fa-regular fa-paper-plane"></i>
                    </button>
                </form>
            </div>

            <div class="coluna-info reveal-page">
                <div class="bloco-titulo">
                    <h2 data-i18n="contactsTitle">Redes e<br>Contactos</h2>
                    <div class="linha-laranja"></div>
                </div>

                <div class="info-conteudo">
                    <div class="info-bloco reveal-page">
                        <h3 data-i18n="emailTitle">E-mail</h3>
                        <a href="mailto:ruimbb@gmail.com">ruimbb@gmail.com</a>
                    </div>

                    <div class="info-bloco reveal-page">
                        <h3 data-i18n="phoneTitle">Telefone / Whatsapp</h3>
                        <a href="https://wa.me/351969758699" target="_blank" rel="noopener noreferrer">+351 969 758 699</a>
                    </div>

                    <div class="info-bloco reveal-page">
                        <h3 data-i18n="socialTitle">Redes Sociais</h3>
                        <div class="footer-social-wrap">
                            <a href="https://www.instagram.com/ruibastos.lonewolf/" target="_blank" rel="noopener noreferrer" class="social-instagram" aria-label="Instagram">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="https://www.facebook.com/rui.bastos.39" target="_blank" rel="noopener noreferrer" class="social-facebook" aria-label="Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </div>
                    </div>

                    <div class="info-bloco reveal-page">
                        <h3 data-i18n="managementTitle">Gestão</h3>
                        <p data-i18n="managementText">
                            Para patrocínios e colaborações, contacta por e-mail ou WhatsApp.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>

<?php unset($_SESSION["form_nome"], $_SESSION["form_email"], $_SESSION["form_mensagem"]); ?>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Contacto | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Contacto",
        heroPhrase: "Fala comigo para parcerias, patrocínios ou qualquer questão.",
        sendTitle: "Envia uma\nmensagem",
        contactsTitle: "Redes e\nContactos",
        namePlaceholder: "O teu nome",
        emailPlaceholder: "O teu e-mail",
        messagePlaceholder: "A tua mensagem",
        sendButton: "Enviar Mensagem",
        emailTitle: "E-mail",
        phoneTitle: "Telefone / Whatsapp",
        socialTitle: "Redes Sociais",
        managementTitle: "Gestão",
        managementText: "Para patrocínios e colaborações, contacta por e-mail ou WhatsApp."
    },
    en: {
        pageTitle: "Contact | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Contact",
        heroPhrase: "Get in touch for partnerships, sponsorships or any question.",
        sendTitle: "Send a\nmessage",
        contactsTitle: "Socials and\nContacts",
        namePlaceholder: "Your name",
        emailPlaceholder: "Your email",
        messagePlaceholder: "Your message",
        sendButton: "Send Message",
        emailTitle: "E-mail",
        phoneTitle: "Phone / Whatsapp",
        socialTitle: "Social Media",
        managementTitle: "Management",
        managementText: "For sponsorships and collaborations, contact by email or WhatsApp."
    }
};</script>
<?php include "footer.php"; ?>

</body>
</html>
