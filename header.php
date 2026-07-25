<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$paginaAtual = basename($_SERVER['PHP_SELF']);
$nomeUser = $_SESSION["nome"] ?? "";
$inicialUser = $nomeUser !== "" ? mb_strtoupper(mb_substr(trim($nomeUser), 0, 1)) : "";

$navLinks = [
    ["href" => "index.php", "pt" => "Início", "en" => "Home", "match" => ["index.php"]],
    ["href" => "sobre.php", "pt" => "Atleta", "en" => "Athlete", "match" => ["sobre.php"]],
    ["href" => "provas.php", "pt" => "Competições", "en" => "Competitions", "match" => ["provas.php"]],
    ["href" => "galeria.php", "pt" => "Galeria", "en" => "Gallery", "match" => ["galeria.php"]],
    ["href" => "loja.php", "pt" => "Loja", "en" => "Shop", "match" => ["loja.php", "produto.php", "carrinho.php", "checkout.php", "encomendas.php"]],
    ["href" => "contatos.php", "pt" => "Contacto", "en" => "Contact", "match" => ["contatos.php"], "cta" => true],
];

$navMoreLinks = [
    ["href" => "historia.php", "pt" => "História", "en" => "History", "match" => ["historia.php"]],
    ["href" => "rotina.php", "pt" => "Treinos", "en" => "Training", "match" => ["rotina.php"]],
    ["href" => "patrocinadores.php", "pt" => "Parceiros", "en" => "Partners", "match" => ["patrocinadores.php", "patrocinador1.php", "patrocinador2.php", "patrocinador3.php", "patrocinador4.php"]],
    ["href" => "faq.php", "pt" => "FAQ", "en" => "FAQ", "match" => ["faq.php"]],
];

$navMoreActive = false;
foreach ($navMoreLinks as $moreLink) {
    if (in_array($paginaAtual, $moreLink["match"], true)) {
        $navMoreActive = true;
        break;
    }
}
?>

<header class="lw-header" id="site-header">
    <div class="lw-header-shell">
        <a href="index.php" class="lw-brand" aria-label="Lone Wolf — Início">
            <span class="lw-brand-mark" aria-hidden="true">LW</span>
            <span class="lw-brand-copy">
                <span class="lw-brand-title">LONE <strong>WOLF</strong></span>
                <span class="lw-brand-sub">Rui Bastos</span>
            </span>
        </a>

        <nav class="lw-nav" id="site-nav" aria-label="Navegação principal">
            <ul class="lw-nav-list">
                <?php foreach ($navLinks as $link): ?>
                    <?php
                    $ativo = in_array($paginaAtual, $link["match"], true);
                    $classes = "lw-nav-link";
                    if ($ativo) $classes .= " is-active";
                    if (!empty($link["cta"])) $classes .= " is-cta";
                    ?>
                    <li>
                        <a
                            href="<?= htmlspecialchars($link["href"]) ?>"
                            class="<?= $classes ?>"
                            data-pt="<?= htmlspecialchars($link["pt"]) ?>"
                            data-en="<?= htmlspecialchars($link["en"]) ?>"
                        ><?= htmlspecialchars($link["pt"]) ?></a>
                    </li>
                <?php endforeach; ?>
                <li class="lw-nav-dropdown<?= $navMoreActive ? " is-active-group" : "" ?>">
                    <button
                        type="button"
                        class="lw-nav-link lw-nav-dropdown-toggle<?= $navMoreActive ? " is-active" : "" ?>"
                        aria-expanded="false"
                        aria-haspopup="true"
                        data-pt="Mais"
                        data-en="More"
                    >Mais <i class="fa-solid fa-chevron-down" aria-hidden="true"></i></button>
                    <ul class="lw-nav-dropdown-menu">
                        <?php foreach ($navMoreLinks as $moreLink): ?>
                            <?php $moreActive = in_array($paginaAtual, $moreLink["match"], true); ?>
                            <li>
                                <a
                                    href="<?= htmlspecialchars($moreLink["href"]) ?>"
                                    class="<?= $moreActive ? "is-active" : "" ?>"
                                    data-pt="<?= htmlspecialchars($moreLink["pt"]) ?>"
                                    data-en="<?= htmlspecialchars($moreLink["en"]) ?>"
                                ><?= htmlspecialchars($moreLink["pt"]) ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="lw-header-tools">
            <?php if (isset($_SESSION["user_id"])): ?>
                <div class="lw-account" title="<?= htmlspecialchars($nomeUser) ?>">
                    <span class="lw-account-avatar"><?= htmlspecialchars($inicialUser) ?></span>
                    <span class="lw-account-name"><?= htmlspecialchars($nomeUser) ?></span>
                </div>

                <?php if (isset($_SESSION["tipo"]) && $_SESSION["tipo"] === "admin"): ?>
                    <a href="admin_mensagens.php" class="lw-tool-btn" aria-label="Administração">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span class="chat-notify-badge" id="chat-notify-badge" hidden>0</span>
                    </a>
                <?php else: ?>
                    <a href="minhas_mensagens.php" class="lw-tool-btn" aria-label="Mensagens">
                        <i class="fa-solid fa-envelope"></i>
                        <span class="chat-notify-badge" id="chat-notify-badge" hidden>0</span>
                    </a>
                <?php endif; ?>

                <a href="logout.php" class="lw-tool-text" data-pt="Sair" data-en="Logout">Sair</a>
            <?php else: ?>
                <a href="login.php" class="lw-tool-cta" data-pt="Entrar" data-en="Login">Entrar</a>
            <?php endif; ?>

            <div class="lw-lang" role="group" aria-label="Idioma">
                <button type="button" class="lw-lang-btn" data-lang="pt">PT</button>
                <button type="button" class="lw-lang-btn" data-lang="en">EN</button>
            </div>
        </div>

        <button
            type="button"
            class="lw-nav-toggle"
            aria-label="Abrir menu"
            aria-expanded="false"
            aria-controls="site-nav"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>
