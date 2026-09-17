<footer class="site-footer">
    <style>
        .studio-credit-link {
            color: #e57f1f !important;
            text-decoration: none !important;
            font-weight: 600;
            transition: color 0.2s ease;
        }
        .studio-credit-link:hover,
        .studio-credit-link:focus-visible {
            color: #ff9a1f !important;
            text-decoration: underline !important;
            text-underline-offset: 3px;
        }
    </style>
    <div class="footer-inner">
        <div class="footer-top">
            <div class="footer-brand">
                <h2 class="footer-logo">LONE <span>WOLF</span></h2>
                <p class="footer-text" data-footer-i18n="footerText">
                    Ultra trail. Sem atalhos. Sem desculpas.
                </p>
            </div>

            <div class="footer-links-area">
                <h3 class="footer-title" data-footer-i18n="quickLinks">Ligações Rápidas</h3>

                <div class="footer-links-wrap">
                    <div class="footer-links-grid">
                        <a href="index.php" data-footer-i18n="home">Início</a>
                        <a href="sobre.php" data-footer-i18n="athlete">Atleta</a>
                        <a href="historia.php" data-footer-i18n="history">História</a>
                        <a href="provas.php" data-footer-i18n="competitions">Competições</a>
                        <a href="rotina.php" data-footer-i18n="training">Treinos</a>
                        <a href="galeria.php" data-footer-i18n="gallery">Galeria</a>
                        <a href="patrocinadores.php" data-footer-i18n="partners">Parceiros</a>
                        <a href="loja.php" data-footer-i18n="shop">Loja</a>
                        <a href="faq.php" data-footer-i18n="faq">FAQ</a>
                        <a href="contatos.php" data-footer-i18n="contact">Contacto</a>
                    </div>
                </div>
            </div>

            <div class="footer-social-area">
                <h3 class="footer-title" data-footer-i18n="followMe">Segue-me</h3>

                <div class="footer-social-wrap">
                    <a href="https://www.instagram.com/ruibastos.lonewolf/" target="_blank" rel="noopener noreferrer" class="social-instagram" aria-label="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="https://www.facebook.com/rui.bastos.39" target="_blank" rel="noopener noreferrer" class="social-facebook" aria-label="Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </div>

                <a class="footer-email" href="mailto:ruimbb@gmail.com">ruimbb@gmail.com</a>
                <a class="footer-email" href="mailto:lonewolf.runner.pt@gmail.com">lonewolf.runner.pt@gmail.com</a>
            </div>
        </div>

        <div class="footer-bottom">
            <div data-footer-i18n="copyright">© 2026 Lone Wolf. Todos os direitos reservados.</div>
            <div class="footer-credit">
                <span data-footer-i18n="developedBy">Desenvolvido por</span>
                <a class="studio-credit-link" href="https://www.instagram.com/impulse_web_studio/" target="_blank" rel="noopener noreferrer">Impulse Web Studio</a>
            </div>
            <div class="footer-legal-links">
                <a href="politica-de-privacidade.php" data-footer-i18n="privacy">Política de Privacidade</a>
                <span aria-hidden="true">·</span>
                <a href="politica-de-cookies.php" data-footer-i18n="cookies">Política de Cookies</a>
            </div>
        </div>
    </div>
</footer>

<?php include __DIR__ . "/cookie-banner.php"; ?>

<script src="assets/js/main.js?v=20260820s"></script>
<?php if (isset($_SESSION["user_id"]) && ($_SESSION["tipo"] ?? "") !== "admin"): ?>
<script src="assets/js/chat.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    if (typeof initChatNotifications === "function") {
        initChatNotifications({
            isAdmin: false,
            badgeId: "chat-notify-badge",
            chatLink: "minhas_mensagens.php"
        });
    }
});
</script>
<?php endif; ?>
