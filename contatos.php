<?php
require_once "includes/init.php";

$config = require __DIR__ . "/includes/site-config.php";
$emailPessoal = $config["contact_email"] ?? "ruimbb@gmail.com";
$emailProfissional = $config["professional_email"] ?? "lonewolf.runner.pt@gmail.com";

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
            Fala comigo por e-mail, WhatsApp ou redes sociais.
        </p>
    </div>
</section>

<section class="page-section secao-contactos">
    <div class="container-contactos">
        <div class="contactos-directos">
            <div class="bloco-titulo reveal-page">
                <h2 data-i18n="contactsTitle">Redes e<br>Contactos</h2>
                <div class="linha-laranja"></div>
                <p data-i18n="contactsIntro">
                    Para parcerias, patrocínios ou qualquer questão, contacta o atleta pelos canais abaixo.
                </p>
            </div>

            <div class="info-conteudo contactos-directos-grid">
                <div class="info-bloco reveal-page">
                    <h3 data-i18n="emailPersonalTitle">E-mail pessoal</h3>
                    <a href="mailto:<?= htmlspecialchars($emailPessoal) ?>"><?= htmlspecialchars($emailPessoal) ?></a>
                </div>

                <div class="info-bloco reveal-page">
                    <h3 data-i18n="emailProTitle">E-mail profissional</h3>
                    <a href="mailto:<?= htmlspecialchars($emailProfissional) ?>"><?= htmlspecialchars($emailProfissional) ?></a>
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
            </div>
        </div>
    </div>
</section>
</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Contacto | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Contacto",
        heroPhrase: "Fala comigo por e-mail, WhatsApp ou redes sociais.",
        contactsTitle: "Redes e\nContactos",
        contactsIntro: "Para parcerias, patrocínios ou qualquer questão, contacta o atleta pelos canais abaixo.",
        emailPersonalTitle: "E-mail pessoal",
        emailProTitle: "E-mail profissional",
        phoneTitle: "Telefone / Whatsapp",
        socialTitle: "Redes Sociais"
    },
    en: {
        pageTitle: "Contact | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Contact",
        heroPhrase: "Get in touch by email, WhatsApp or social media.",
        contactsTitle: "Socials and\nContacts",
        contactsIntro: "For partnerships, sponsorships or any question, contact the athlete through the channels below.",
        emailPersonalTitle: "Personal email",
        emailProTitle: "Professional email",
        phoneTitle: "Phone / Whatsapp",
        socialTitle: "Social Media"
    }
};</script>
<?php include "footer.php"; ?>

</body>
</html>
