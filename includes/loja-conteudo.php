    <section class="hero-loja">
        <div class="hero-conteudo reveal-page">
            <p class="hero-kicker" data-i18n="heroMini">Rui Bastos</p>
            <h1 data-i18n="heroTitle">Loja</h1>
            <p class="hero-texto" data-i18n="heroPhrase">Descobre a coleção Lone Wolf.</p>
        </div>
    </section>

    <section class="beneficios" id="beneficios">
        <div class="container">
            <div class="beneficios-grid">
                <div class="beneficio-card reveal-page">
                    <h3 data-i18n="benefit1Title">Estilo Premium</h3>
                    <p data-i18n="benefit1Text">Peças desenhadas para marcar presença dentro e fora do treino.</p>
                </div>
                <div class="beneficio-card reveal-page">
                    <h3 data-i18n="benefit2Title">Identidade Forte</h3>
                    <p data-i18n="benefit2Text">Uma loja alinhada com a essência Lone Wolf: foco, garra e disciplina.</p>
                </div>
                <div class="beneficio-card reveal-page">
                    <h3 data-i18n="benefit3Title">Conforto e Performance</h3>
                    <p data-i18n="benefit3Text">Produtos pensados para acompanhar o ritmo de quem quer mais.</p>
                </div>
                <div class="beneficio-card reveal-page">
                    <h3 data-i18n="benefit4Title">Visual Impactante</h3>
                    <p data-i18n="benefit4Text">Design apelativo e profissional para prender a atenção de imediato.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="produtos">
        <div class="container">
            <div class="secao-titulo reveal-page">
                <h2 data-i18n="productsTitle">Produtos</h2>
                <p data-i18n="productsText">Merchandising oficial Lone Wolf e equipamento recomendado.</p>
            </div>

            <div class="produtos-grid">
                <?php foreach ($produtos as $produto): ?>
                    <article class="produto-card reveal-page">
                        <a href="produto.php?id=<?= (int) $produto["id"] ?>" class="produto-link">
                            <div class="produto-imagem">
                                <?php if (!empty($produto["badge"])): ?>
                                    <span class="produto-badge" data-i18n-badge="<?= (int) $produto["id"] ?>"><?= htmlspecialchars($produto["badge"]) ?></span>
                                <?php endif; ?>
                                <img src="<?= htmlspecialchars($produto["imagem"]) ?>" alt="<?= htmlspecialchars($produto["nome"]) ?>">
                            </div>
                            <div class="produto-info">
                                <div class="produto-categoria" data-i18n-cat="<?= (int) $produto["id"] ?>"><?= htmlspecialchars($produto["categoria"]) ?></div>
                                <h3 data-i18n-name="<?= (int) $produto["id"] ?>"><?= htmlspecialchars($produto["nome"]) ?></h3>
                                <p data-i18n-desc="<?= (int) $produto["id"] ?>"><?= htmlspecialchars($produto["descricao"]) ?></p>
                            </div>
                        </a>
                        <div class="produto-footer">
                            <span class="produto-preco"><?= formatar_preco((float) $produto["preco"]) ?></span>
                            <a href="produto.php?id=<?= (int) $produto["id"] ?>" class="produto-btn" data-i18n="viewBtn">Ver Produto</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="cta-loja">
        <div class="container">
            <div class="cta-box reveal-page">
                <h2 data-i18n="ctaTitle">Leva a Mentalidade Contigo</h2>
                <p data-i18n="ctaText">A loja Lone Wolf não é apenas merchandising. É uma extensão da identidade, do percurso e da disciplina que definem o projeto.</p>
                <div class="cta-acoes">
                    <a href="carrinho.php" class="btn-principal" data-i18n="cartBtn">Ver Carrinho</a>
                    <?php if (isset($_SESSION["user_id"])): ?>
                        <a href="encomendas.php" class="btn-secundario" data-i18n="ordersBtn">As Minhas Encomendas</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "Loja | Lone Wolf", heroMini: "Rui Bastos", heroTitle: "Loja", heroPhrase: "Descobre a coleção Lone Wolf.",
        benefit1Title: "Estilo Premium", benefit1Text: "Peças desenhadas para marcar presença dentro e fora do treino.",
        benefit2Title: "Identidade Forte", benefit2Text: "Uma loja alinhada com a essência Lone Wolf: foco, garra e disciplina.",
        benefit3Title: "Conforto e Performance", benefit3Text: "Produtos pensados para acompanhar o ritmo de quem quer mais.",
        benefit4Title: "Visual Impactante", benefit4Text: "Design apelativo e profissional para prender a atenção de imediato.",
        productsTitle: "Produtos", productsText: "Merchandising oficial Lone Wolf e equipamento recomendado.",
        viewBtn: "Ver Produto", ctaTitle: "Leva a Mentalidade Contigo",
        ctaText: "A loja Lone Wolf não é apenas merchandising. É uma extensão da identidade, do percurso e da disciplina que definem o projeto.",
        cartBtn: "Ver Carrinho", ordersBtn: "As Minhas Encomendas"
    },
    en: {
        pageTitle: "Shop | Lone Wolf", heroMini: "Rui Bastos", heroTitle: "Shop", heroPhrase: "Discover the Lone Wolf collection.",
        benefit1Title: "Premium Style", benefit1Text: "Pieces designed to stand out in and out of training.",
        benefit2Title: "Strong Identity", benefit2Text: "A shop aligned with the Lone Wolf essence: focus, grit and discipline.",
        benefit3Title: "Comfort and Performance", benefit3Text: "Products built to keep up with those who want more.",
        benefit4Title: "Striking Look", benefit4Text: "Appealing, professional design that catches attention instantly.",
        productsTitle: "Products", productsText: "Official Lone Wolf merchandise and recommended gear.",
        viewBtn: "View Product", ctaTitle: "Carry the Mindset With You",
        ctaText: "The Lone Wolf shop is not just merchandise. It is an extension of the identity, journey and discipline that define the project.",
        cartBtn: "View Cart", ordersBtn: "My Orders"
    }
};</script>
