<?php
require_once "includes/init.php";

$pageTitle = "FAQ | Lone Wolf";
$pageDescription = "Perguntas frequentes sobre a loja, envios, parcerias e conta Lone Wolf.";
$bodyClass = "content-page";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

<main class="faq-page">
    <section class="hero-page">
        <div class="hero-conteudo reveal-page">
            <div class="hero-mini" data-i18n="heroMini">Lone Wolf</div>
            <h1 data-i18n="heroTitle">FAQ</h1>
            <p class="hero-frase" data-i18n="heroPhrase">
                Respostas rápidas sobre loja, envios, parcerias e conta.
            </p>
        </div>
    </section>

    <section class="page-section faq-section">
        <div class="container container-estreito">
            <div class="faq-grupo reveal-page">
                <h2 data-i18n="shopTitle">Loja</h2>
                <div class="linha-laranja"></div>

                <details class="faq-item">
                    <summary data-i18n="shopQ1">Como faço uma encomenda?</summary>
                    <p data-i18n="shopA1">Escolhe os produtos na loja, adiciona ao carrinho e conclui o checkout com os teus dados de envio e pagamento.</p>
                </details>
                <details class="faq-item">
                    <summary data-i18n="shopQ2">Quais são os métodos de pagamento?</summary>
                    <p data-i18n="shopA2">Aceitamos MB Way, transferência bancária e pagamento na entrega, conforme disponível no checkout.</p>
                </details>
                <details class="faq-item">
                    <summary data-i18n="shopQ3">Posso trocar ou devolver um artigo?</summary>
                    <p data-i18n="shopA3">Contacta-nos em até 14 dias após receberes a encomenda. Artigos personalizados ou usados podem ter condições específicas.</p>
                </details>
            </div>

            <div class="faq-grupo reveal-page">
                <h2 data-i18n="shippingTitle">Envios</h2>
                <div class="linha-laranja"></div>

                <details class="faq-item">
                    <summary data-i18n="shipQ1">Para onde enviam?</summary>
                    <p data-i18n="shipA1">Enviamos para Portugal continental e ilhas. Para outros destinos, contacta-nos antes de encomendar.</p>
                </details>
                <details class="faq-item">
                    <summary data-i18n="shipQ2">Quanto tempo demora a entrega?</summary>
                    <p data-i18n="shipA2">Após confirmação de pagamento, o envio demora normalmente 2 a 5 dias úteis em Portugal continental.</p>
                </details>
                <details class="faq-item">
                    <summary data-i18n="shipQ3">Como acompanho a minha encomenda?</summary>
                    <p data-i18n="shipA3">Quando a encomenda for enviada, receberás actualização por e-mail. Também podes consultar o estado em «As Minhas Encomendas».</p>
                </details>
            </div>

            <div class="faq-grupo reveal-page">
                <h2 data-i18n="partnersTitle">Parcerias</h2>
                <div class="linha-laranja"></div>

                <details class="faq-item">
                    <summary data-i18n="partQ1">Como posso patrocinar o Rui Bastos?</summary>
                    <p data-i18n="partA1">Consulta a página de Patrocínio para conhecer os pacotes Bronze, Silver e Gold, ou contacta directamente para uma proposta personalizada.</p>
                </details>
                <details class="faq-item">
                    <summary data-i18n="partQ2">Fornecem media kit?</summary>
                    <p data-i18n="partA2">Sim. A página Media Kit inclui bio, estatísticas e recursos oficiais para imprensa e parceiros.</p>
                </details>
                <details class="faq-item">
                    <summary data-i18n="partQ3">Trabalham com marcas locais?</summary>
                    <p data-i18n="partA3">Sim. Valorizamos parcerias alinhadas com performance, saúde e lifestyle, tanto a nível local como nacional.</p>
                </details>
            </div>

            <div class="faq-grupo reveal-page">
                <h2 data-i18n="accountTitle">Conta</h2>
                <div class="linha-laranja"></div>

                <details class="faq-item">
                    <summary data-i18n="accQ1">Preciso de conta para comprar?</summary>
                    <p data-i18n="accA1">É necessário iniciar sessão para concluir a encomenda. Criar conta permite também acompanhar encomendas e usar a área de mensagens.</p>
                </details>
                <details class="faq-item">
                    <summary data-i18n="accQ2">Como recupero o acesso?</summary>
                    <p data-i18n="accA2">Se tiveres dificuldades com login, contacta-nos por e-mail ou WhatsApp com o e-mail associado à conta.</p>
                </details>
                <details class="faq-item">
                    <summary data-i18n="accQ3">Como apago a minha conta?</summary>
                    <p data-i18n="accA3">Com sessão iniciada, podes solicitar a eliminação da conta na área de perfil ou contactar o suporte Lone Wolf.</p>
                </details>
            </div>

            <div class="cta-box reveal-page">
                <h2 data-i18n="ctaTitle">Ainda tens dúvidas?</h2>
                <p data-i18n="ctaText">A equipa Lone Wolf responde por e-mail, WhatsApp ou formulário de contacto.</p>
                <a href="contatos.php" class="btn-principal" data-i18n="ctaBtn">Contactar</a>
            </div>
        </div>
    </section>
</main>

<script>window.pageTranslations = {
    pt: {
        pageTitle: "FAQ | Lone Wolf",
        heroMini: "Lone Wolf",
        heroTitle: "FAQ",
        heroPhrase: "Respostas rápidas sobre loja, envios, parcerias e conta.",
        shopTitle: "Loja",
        shopQ1: "Como faço uma encomenda?",
        shopA1: "Escolhe os produtos na loja, adiciona ao carrinho e conclui o checkout com os teus dados de envio e pagamento.",
        shopQ2: "Quais são os métodos de pagamento?",
        shopA2: "Aceitamos MB Way, transferência bancária e pagamento na entrega, conforme disponível no checkout.",
        shopQ3: "Posso trocar ou devolver um artigo?",
        shopA3: "Contacta-nos em até 14 dias após receberes a encomenda. Artigos personalizados ou usados podem ter condições específicas.",
        shippingTitle: "Envios",
        shipQ1: "Para onde enviam?",
        shipA1: "Enviamos para Portugal continental e ilhas. Para outros destinos, contacta-nos antes de encomendar.",
        shipQ2: "Quanto tempo demora a entrega?",
        shipA2: "Após confirmação de pagamento, o envio demora normalmente 2 a 5 dias úteis em Portugal continental.",
        shipQ3: "Como acompanho a minha encomenda?",
        shipA3: "Quando a encomenda for enviada, receberás actualização por e-mail. Também podes consultar o estado em «As Minhas Encomendas».",
        partnersTitle: "Parcerias",
        partQ1: "Como posso patrocinar o Rui Bastos?",
        partA1: "Consulta a página de Patrocínio para conhecer os pacotes Bronze, Silver e Gold, ou contacta directamente para uma proposta personalizada.",
        partQ2: "Fornecem media kit?",
        partA2: "Sim. A página Media Kit inclui bio, estatísticas e recursos oficiais para imprensa e parceiros.",
        partQ3: "Trabalham com marcas locais?",
        partA3: "Sim. Valorizamos parcerias alinhadas com performance, saúde e lifestyle, tanto a nível local como nacional.",
        accountTitle: "Conta",
        accQ1: "Preciso de conta para comprar?",
        accA1: "É necessário iniciar sessão para concluir a encomenda. Criar conta permite também acompanhar encomendas e usar a área de mensagens.",
        accQ2: "Como recupero o acesso?",
        accA2: "Se tiveres dificuldades com login, contacta-nos por e-mail ou WhatsApp com o e-mail associado à conta.",
        accQ3: "Como apago a minha conta?",
        accA3: "Com sessão iniciada, podes solicitar a eliminação da conta na área de perfil ou contactar o suporte Lone Wolf.",
        ctaTitle: "Ainda tens dúvidas?",
        ctaText: "A equipa Lone Wolf responde por e-mail, WhatsApp ou formulário de contacto.",
        ctaBtn: "Contactar"
    },
    en: {
        pageTitle: "FAQ | Lone Wolf",
        heroMini: "Lone Wolf",
        heroTitle: "FAQ",
        heroPhrase: "Quick answers about shop, shipping, partnerships and account.",
        shopTitle: "Shop",
        shopQ1: "How do I place an order?",
        shopA1: "Choose products in the shop, add them to the cart and complete checkout with your shipping and payment details.",
        shopQ2: "What payment methods are available?",
        shopA2: "We accept MB Way, bank transfer and cash on delivery, as shown at checkout.",
        shopQ3: "Can I exchange or return an item?",
        shopA3: "Contact us within 14 days of receiving your order. Customised or used items may have specific conditions.",
        shippingTitle: "Shipping",
        shipQ1: "Where do you ship?",
        shipA1: "We ship to mainland Portugal and islands. For other destinations, contact us before ordering.",
        shipQ2: "How long does delivery take?",
        shipA2: "After payment confirmation, delivery usually takes 2 to 5 business days in mainland Portugal.",
        shipQ3: "How do I track my order?",
        shipA3: "When your order is shipped, you will receive an email update. You can also check status under «My Orders».",
        partnersTitle: "Partnerships",
        partQ1: "How can I sponsor Rui Bastos?",
        partA1: "See the Sponsorship page for Bronze, Silver and Gold packages, or contact us directly for a tailored proposal.",
        partQ2: "Do you provide a media kit?",
        partA2: "Yes. The Media Kit page includes bio, statistics and official resources for press and partners.",
        partQ3: "Do you work with local brands?",
        partA3: "Yes. We value partnerships aligned with performance, health and lifestyle, locally and nationally.",
        accountTitle: "Account",
        accQ1: "Do I need an account to buy?",
        accA1: "You need to log in to complete checkout. Creating an account also lets you track orders and use the messaging area.",
        accQ2: "How do I recover access?",
        accA2: "If you have login issues, contact us by email or WhatsApp with the email linked to your account.",
        accQ3: "How do I delete my account?",
        accA3: "When logged in, you can request account deletion in your profile area or contact Lone Wolf support.",
        ctaTitle: "Still have questions?",
        ctaText: "The Lone Wolf team replies by email, WhatsApp or contact form.",
        ctaBtn: "Contact"
    }
};</script>
<?php include "footer.php"; ?>

</body>
</html>
