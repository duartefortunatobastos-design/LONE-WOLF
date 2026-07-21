<?php
require_once "includes/init.php";

$pageTitle = "Media Kit | Lone Wolf";
$pageDescription = "Media kit oficial de Rui Bastos — Lone Wolf. Bio, estatísticas, logos e contacto.";
$bodyClass = "content-page";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="media-kit-page">
    <section class="hero-page">
        <div class="hero-conteudo reveal-page">
            <div class="hero-mini" data-i18n="heroMini">Rui Bastos</div>
            <h1 data-i18n="heroTitle">Media Kit</h1>
            <p class="hero-frase" data-i18n="heroPhrase">
                Recursos oficiais para imprensa, parceiros e equipas de comunicação.
            </p>
        </div>
    </section>

    <section class="page-section media-kit-section">
        <div class="container">
            <div class="intro-atleta reveal-page">
                <div class="intro-imagem">
                    <img src="IMAGENS/FOTO_PORTO.jpg" alt="Rui Bastos em competição" data-i18n-alt="photoAlt">
                </div>
                <div class="intro-texto">
                    <h2 data-i18n="bioTitle">Biografia</h2>
                    <div class="linha-laranja"></div>
                    <p data-i18n="bioText1">
                        <strong>Rui Bastos</strong> é atleta de estrada português, conhecido pela mentalidade Lone Wolf:
                        treino consistente, foco em maratonas e meias-maratona, e presença activa no calendário nacional.
                    </p>
                    <p data-i18n="bioText2">
                        Com marcas de referência nos 10 km, meia-maratona e maratona, representa um perfil competitivo,
                        autêntico e alinhado com marcas de performance, lifestyle e bem-estar.
                    </p>
                </div>
            </div>

            <div class="secao-titulo reveal-page">
                <h2 data-i18n="statsTitle">Estatísticas</h2>
                <p data-i18n="statsText">Principais registos competitivos (2025).</p>
                <div class="linha-laranja"></div>
            </div>

            <div class="stats-grid reveal-page">
                <div class="stat-card">
                    <div class="stat-valor">35:59</div>
                    <div class="stat-label" data-i18n="stat10k">Melhor 10 km</div>
                </div>
                <div class="stat-card">
                    <div class="stat-valor">1:21:08</div>
                    <div class="stat-label" data-i18n="statHalf">Melhor meia-maratona</div>
                </div>
                <div class="stat-card">
                    <div class="stat-valor">2:52:55</div>
                    <div class="stat-label" data-i18n="statMarathon">Melhor maratona</div>
                </div>
                <div class="stat-card">
                    <div class="stat-valor">120 km</div>
                    <div class="stat-label" data-i18n="statVolume">Volume semanal</div>
                </div>
                <div class="stat-card">
                    <div class="stat-valor">10+</div>
                    <div class="stat-label" data-i18n="statYears">Anos de carreira</div>
                </div>
                <div class="stat-card">
                    <div class="stat-valor">12</div>
                    <div class="stat-label" data-i18n="statWins">Vitórias</div>
                </div>
            </div>

            <div class="secao-titulo reveal-page">
                <h2 data-i18n="logosTitle">Logos e identidade</h2>
                <p data-i18n="logosText">Ficheiros oficiais Lone Wolf para uso editorial e parcerias.</p>
                <div class="linha-laranja"></div>
            </div>

            <div class="beneficios-grid">
                <div class="beneficio-card reveal-page">
                    <h3 data-i18n="logoPrimary">Logo principal</h3>
                    <p data-i18n="logoPrimaryDesc">Versão completa Lone Wolf em PNG (fundo transparente).</p>
                    <a href="IMAGENS/logo_lobo.png" class="produto-btn" download data-i18n="downloadLogo">Descarregar logo</a>
                </div>
                <div class="beneficio-card reveal-page">
                    <h3 data-i18n="logoIcon">Ícone / avatar</h3>
                    <p data-i18n="logoIconDesc">Versão simplificada para redes sociais e thumbnails.</p>
                    <a href="IMAGENS/foto_atleta.png" class="produto-btn" download data-i18n="downloadAvatar">Descarregar avatar</a>
                </div>
                <div class="beneficio-card reveal-page">
                    <h3 data-i18n="logoPhotos">Fotos oficiais</h3>
                    <p data-i18n="logoPhotosDesc">Pack de imagens de competição e treino em alta resolução.</p>
                    <a href="galeria.php" class="produto-btn" data-i18n="viewGallery">Ver galeria completa</a>
                </div>
            </div>

            <div class="cta-box reveal-page">
                <h2 data-i18n="contactTitle">Contacto para media</h2>
                <p data-i18n="contactText">
                    Para entrevistas, credenciais de prova ou pedidos de material adicional, contacta a equipa Lone Wolf.
                </p>
                <a href="mailto:ruimbb@gmail.com" class="btn-principal">ruimbb@gmail.com</a>
                <a href="contatos.php" class="btn-principal" data-i18n="contactBtn">Formulário de contacto</a>
            </div>
        </div>
    </section>
</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Media Kit | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Media Kit",
        heroPhrase: "Recursos oficiais para imprensa, parceiros e equipas de comunicação.",
        photoAlt: "Rui Bastos em competição",
        bioTitle: "Biografia",
        bioText1: "Rui Bastos é atleta de estrada português, conhecido pela mentalidade Lone Wolf: treino consistente, foco em maratonas e meias-maratona, e presença activa no calendário nacional.",
        bioText2: "Com marcas de referência nos 10 km, meia-maratona e maratona, representa um perfil competitivo, autêntico e alinhado com marcas de performance, lifestyle e bem-estar.",
        statsTitle: "Estatísticas",
        statsText: "Principais registos competitivos (2025).",
        stat10k: "Melhor 10 km",
        statHalf: "Melhor meia-maratona",
        statMarathon: "Melhor maratona",
        statVolume: "Volume semanal",
        statYears: "Anos de carreira",
        statWins: "Vitórias",
        logosTitle: "Logos e identidade",
        logosText: "Ficheiros oficiais Lone Wolf para uso editorial e parcerias.",
        logoPrimary: "Logo principal",
        logoPrimaryDesc: "Versão completa Lone Wolf em PNG (fundo transparente).",
        logoIcon: "Ícone / avatar",
        logoIconDesc: "Versão simplificada para redes sociais e thumbnails.",
        logoPhotos: "Fotos oficiais",
        logoPhotosDesc: "Pack de imagens de competição e treino em alta resolução.",
        downloadLogo: "Descarregar logo",
        downloadAvatar: "Descarregar avatar",
        viewGallery: "Ver galeria completa",
        contactTitle: "Contacto para media",
        contactText: "Para entrevistas, credenciais de prova ou pedidos de material adicional, contacta a equipa Lone Wolf.",
        contactBtn: "Formulário de contacto"
    },
    en: {
        pageTitle: "Media Kit | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Media Kit",
        heroPhrase: "Official resources for press, partners and communications teams.",
        photoAlt: "Rui Bastos racing",
        bioTitle: "Biography",
        bioText1: "Rui Bastos is a Portuguese road runner known for the Lone Wolf mindset: consistent training, focus on marathons and half marathons, and an active presence on the national calendar.",
        bioText2: "With benchmark times at 10 km, half marathon and marathon, he represents a competitive, authentic profile aligned with performance, lifestyle and wellness brands.",
        statsTitle: "Statistics",
        statsText: "Key competitive records (2025).",
        stat10k: "Best 10 km",
        statHalf: "Best half marathon",
        statMarathon: "Best marathon",
        statVolume: "Weekly volume",
        statYears: "Years of career",
        statWins: "Wins",
        logosTitle: "Logos and identity",
        logosText: "Official Lone Wolf files for editorial use and partnerships.",
        logoPrimary: "Primary logo",
        logoPrimaryDesc: "Full Lone Wolf version in PNG (transparent background).",
        logoIcon: "Icon / avatar",
        logoIconDesc: "Simplified version for social media and thumbnails.",
        logoPhotos: "Official photos",
        logoPhotosDesc: "High-resolution race and training image pack.",
        downloadLogo: "Download logo",
        downloadAvatar: "Download avatar",
        viewGallery: "View full gallery",
        contactTitle: "Media contact",
        contactText: "For interviews, race credentials or additional material requests, contact the Lone Wolf team.",
        contactBtn: "Contact form"
    }
};</script>
<?php include "footer.php"; ?>

</body>
</html>
