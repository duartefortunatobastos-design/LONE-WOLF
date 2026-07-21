<?php
require_once "includes/init.php";

$pageTitle = "Patrocínio | Lone Wolf";
$pageDescription = "Parcerias e patrocínio com Rui Bastos — Lone Wolf. Pacotes Bronze, Silver e Gold.";
$bodyClass = "content-page";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="patrocinio-page">
    <section class="hero-page">
        <div class="hero-conteudo reveal-page">
            <div class="hero-mini" data-i18n="heroMini">Rui Bastos</div>
            <h1 data-i18n="heroTitle">Patrocínio</h1>
            <p class="hero-frase" data-i18n="heroPhrase">
                Associa a tua marca à disciplina, consistência e visibilidade de um atleta Lone Wolf.
            </p>
        </div>
    </section>

    <section class="page-section patrocinio-section">
        <div class="container">
            <div class="intro-atleta reveal-page">
                <div class="intro-imagem">
                    <img src="IMAGENS/PAI_3.jpeg" alt="Rui Bastos Lone Wolf" data-i18n-alt="introPhotoAlt">
                </div>
                <div class="intro-texto">
                    <h2 data-i18n="introTitle">Parceria com impacto</h2>
                    <div class="linha-laranja"></div>
                    <p data-i18n="introText1">
                        Rui Bastos Lone Wolf representa foco, resistência e autenticidade no atletismo de estrada.
                        Trabalhamos com marcas que valorizam performance, storytelling e presença consistente em provas e redes sociais.
                    </p>
                    <p data-i18n="introText2">
                        Cada parceria é desenhada para gerar visibilidade real — em competição, conteúdo digital e pontos de contacto com uma comunidade activa de corrida.
                    </p>
                </div>
            </div>

            <div class="secao-titulo reveal-page">
                <h2 data-i18n="packagesTitle">Pacotes de patrocínio</h2>
                <p data-i18n="packagesText">Escolhe o nível de exposição que melhor se adapta à tua marca.</p>
                <div class="linha-laranja"></div>
            </div>

            <div class="beneficios-grid patrocinio-pacotes">
                <article class="beneficio-card patrocinio-pacote reveal-page">
                    <span class="produto-badge" data-i18n="bronzeBadge">Bronze</span>
                    <h3 data-i18n="bronzeTitle">Bronze</h3>
                    <p data-i18n="bronzeDesc">Presença digital e menção em conteúdos seleccionados.</p>
                    <ul class="patrocinio-lista">
                        <li data-i18n="bronze1">Logo no site Lone Wolf</li>
                        <li data-i18n="bronze2">Menção em 2 publicações/mês</li>
                        <li data-i18n="bronze3">Agradecimento em provas locais</li>
                    </ul>
                </article>

                <article class="beneficio-card patrocinio-pacote patrocinio-pacote-destaque reveal-page">
                    <span class="produto-badge" data-i18n="silverBadge">Silver</span>
                    <h3 data-i18n="silverTitle">Silver</h3>
                    <p data-i18n="silverDesc">Visibilidade ampliada em provas, redes e conteúdo dedicado.</p>
                    <ul class="patrocinio-lista">
                        <li data-i18n="silver1">Tudo do pacote Bronze</li>
                        <li data-i18n="silver2">Logo em equipamento de treino</li>
                        <li data-i18n="silver3">4 publicações/mês + stories</li>
                        <li data-i18n="silver4">Presença em 3 provas nacionais</li>
                    </ul>
                </article>

                <article class="beneficio-card patrocinio-pacote reveal-page">
                    <span class="produto-badge" data-i18n="goldBadge">Gold</span>
                    <h3 data-i18n="goldTitle">Gold</h3>
                    <p data-i18n="goldDesc">Parceria principal com máxima exposição e co-branding.</p>
                    <ul class="patrocinio-lista">
                        <li data-i18n="gold1">Tudo do pacote Silver</li>
                        <li data-i18n="gold2">Logo em equipamento de competição</li>
                        <li data-i18n="gold3">Conteúdo exclusivo mensal</li>
                        <li data-i18n="gold4">Activations e eventos conjuntos</li>
                        <li data-i18n="gold5">Prioridade em campanhas de lançamento</li>
                    </ul>
                </article>
            </div>

            <div class="cta-box reveal-page">
                <h2 data-i18n="ctaTitle">Vamos construir a parceria</h2>
                <p data-i18n="ctaText">
                    Cada colaboração é personalizada. Fala connosco para alinhar objectivos, calendário competitivo e activações de marca.
                </p>
                <a href="contatos.php" class="btn-principal" data-i18n="ctaBtn">Contactar para Patrocínio</a>
            </div>
        </div>
    </section>
</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Patrocínio | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Patrocínio",
        heroPhrase: "Associa a tua marca à disciplina, consistência e visibilidade de um atleta Lone Wolf.",
        introPhotoAlt: "Rui Bastos Lone Wolf",
        introTitle: "Parceria com impacto",
        introText1: "Rui Bastos Lone Wolf representa foco, resistência e autenticidade no atletismo de estrada. Trabalhamos com marcas que valorizam performance, storytelling e presença consistente em provas e redes sociais.",
        introText2: "Cada parceria é desenhada para gerar visibilidade real — em competição, conteúdo digital e pontos de contacto com uma comunidade activa de corrida.",
        packagesTitle: "Pacotes de patrocínio",
        packagesText: "Escolhe o nível de exposição que melhor se adapta à tua marca.",
        bronzeBadge: "Bronze",
        bronzeTitle: "Bronze",
        bronzeDesc: "Presença digital e menção em conteúdos seleccionados.",
        bronze1: "Logo no site Lone Wolf",
        bronze2: "Menção em 2 publicações/mês",
        bronze3: "Agradecimento em provas locais",
        silverBadge: "Silver",
        silverTitle: "Silver",
        silverDesc: "Visibilidade ampliada em provas, redes e conteúdo dedicado.",
        silver1: "Tudo do pacote Bronze",
        silver2: "Logo em equipamento de treino",
        silver3: "4 publicações/mês + stories",
        silver4: "Presença em 3 provas nacionais",
        goldBadge: "Gold",
        goldTitle: "Gold",
        goldDesc: "Parceria principal com máxima exposição e co-branding.",
        gold1: "Tudo do pacote Silver",
        gold2: "Logo em equipamento de competição",
        gold3: "Conteúdo exclusivo mensal",
        gold4: "Activations e eventos conjuntos",
        gold5: "Prioridade em campanhas de lançamento",
        ctaTitle: "Vamos construir a parceria",
        ctaText: "Cada colaboração é personalizada. Fala connosco para alinhar objectivos, calendário competitivo e activações de marca.",
        ctaBtn: "Contactar para Patrocínio"
    },
    en: {
        pageTitle: "Sponsorship | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Sponsorship",
        heroPhrase: "Connect your brand with the discipline, consistency and visibility of a Lone Wolf athlete.",
        introPhotoAlt: "Rui Bastos Lone Wolf",
        introTitle: "Partnership with impact",
        introText1: "Rui Bastos Lone Wolf stands for focus, endurance and authenticity in road running. We work with brands that value performance, storytelling and consistent presence at races and on social media.",
        introText2: "Every partnership is designed to generate real visibility — in competition, digital content and touchpoints with an active running community.",
        packagesTitle: "Sponsorship packages",
        packagesText: "Choose the exposure level that best fits your brand.",
        bronzeBadge: "Bronze",
        bronzeTitle: "Bronze",
        bronzeDesc: "Digital presence and mentions in selected content.",
        bronze1: "Logo on the Lone Wolf website",
        bronze2: "Mention in 2 posts/month",
        bronze3: "Acknowledgement at local races",
        silverBadge: "Silver",
        silverTitle: "Silver",
        silverDesc: "Expanded visibility at races, social media and dedicated content.",
        silver1: "Everything in Bronze",
        silver2: "Logo on training gear",
        silver3: "4 posts/month + stories",
        silver4: "Presence at 3 national races",
        goldBadge: "Gold",
        goldTitle: "Gold",
        goldDesc: "Main partnership with maximum exposure and co-branding.",
        gold1: "Everything in Silver",
        gold2: "Logo on competition kit",
        gold3: "Exclusive monthly content",
        gold4: "Activations and joint events",
        gold5: "Priority in launch campaigns",
        ctaTitle: "Let's build the partnership",
        ctaText: "Every collaboration is tailored. Get in touch to align goals, race calendar and brand activations.",
        ctaBtn: "Contact for Sponsorship"
    }
};</script>
<?php include "footer.php"; ?>

</body>
</html>
