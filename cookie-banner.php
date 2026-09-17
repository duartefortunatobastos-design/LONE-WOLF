<div id="cookie-banner" class="cookie-banner" role="dialog" aria-modal="true" aria-labelledby="cookie-banner-title" hidden>
    <div class="cookie-banner-inner">
        <div class="cookie-banner-texto">
            <strong id="cookie-banner-title" data-cookie-i18n="title">Privacidade e cookies</strong>
            <p data-cookie-i18n="text">
                Utilizamos cookies essenciais para melhorar a tua experiência no site. Consulta a
                <a href="politica-de-privacidade.php">Política de Privacidade</a> e a
                <a href="politica-de-cookies.php">Política de Cookies</a>.
            </p>
        </div>

        <div class="cookie-banner-acoes">
            <button type="button" class="cookie-btn fechar" id="cookie-fechar" data-cookie-i18n="close">Fechar</button>
            <button type="button" class="cookie-btn aceitar" id="cookie-aceitar" data-cookie-i18n="accept">Aceitar</button>
        </div>
    </div>
</div>
<script>
(function () {
    var banner = document.getElementById("cookie-banner");
    if (!banner) return;

    var accepted = false;

    try {
        accepted = localStorage.getItem("lonewolfCookieConsent") === "accepted";
    } catch (error) {
        accepted = false;
    }

    if (!accepted) {
        banner.hidden = false;
        banner.classList.add("is-visible");
    }
})();
</script>
