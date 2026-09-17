import re
from pathlib import Path

path = Path(__file__).resolve().parent.parent / "loja.php"
content = path.read_text(encoding="utf-8")

content = re.sub(r"<!DOCTYPE html>[\s\S]*?<body>\s*", "", content, flags=re.I)
content = re.sub(r'<\?php include "header\.php"; \?>\s*', "", content, count=1)

head = """<?php
$pageTitle = "Loja | Lone Wolf";
$bodyClass = "pagina-loja";
require_once "includes/head.php";
?>

<?php include "header.php"; ?>

"""

content = content.replace("?>\n", "?>\n" + head, 1)

if "pageTranslations" not in content and "footer.php" in content:
    translations = """
<script>window.pageTranslations = {
    pt: {
        pageTitle: "Loja | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Loja",
        heroPhrase: "Descobre a coleção Lone Wolf.",
        benefit1Title: "Estilo Premium",
        benefit1Text: "Peças desenhadas para marcar presença dentro e fora do treino.",
        benefit2Title: "Identidade Forte",
        benefit2Text: "Uma loja alinhada com a essência Lone Wolf: foco, garra e disciplina.",
        benefit3Title: "Conforto e Performance",
        benefit3Text: "Produtos pensados para acompanhar o ritmo de quem quer mais.",
        benefit4Title: "Visual Impactante",
        benefit4Text: "Design apelativo e profissional para prender a atenção de imediato.",
        productsTitle: "Produtos",
        productsSubtitle: "Escolhe a tua peça Lone Wolf.",
        buyBtn: "Comprar",
        ctaTitle: "Pronto para vestir a mentalidade?",
        ctaText: "Explora a coleção completa e leva contigo o espírito Lone Wolf.",
        ctaBtn: "Ver Produtos"
    },
    en: {
        pageTitle: "Shop | Lone Wolf",
        heroMini: "Rui Bastos",
        heroTitle: "Shop",
        heroPhrase: "Discover the Lone Wolf collection.",
        benefit1Title: "Premium Style",
        benefit1Text: "Pieces designed to stand out in and out of training.",
        benefit2Title: "Strong Identity",
        benefit2Text: "A shop aligned with the Lone Wolf essence: focus, grit and discipline.",
        benefit3Title: "Comfort and Performance",
        benefit3Text: "Products built to keep up with those who want more.",
        benefit4Title: "Striking Look",
        benefit4Text: "Appealing, professional design that catches attention instantly.",
        productsTitle: "Products",
        productsSubtitle: "Choose your Lone Wolf piece.",
        buyBtn: "Buy",
        ctaTitle: "Ready to wear the mindset?",
        ctaText: "Explore the full collection and take the Lone Wolf spirit with you.",
        ctaBtn: "View Products"
    }
};</script>
"""
    content = content.replace('<?php include "footer.php"; ?>', translations + '<?php include "footer.php"; ?>', 1)

if "</html>" not in content:
    content = content.rstrip() + "\n\n</body>\n</html>\n"

path.write_text(content, encoding="utf-8")
print("fixed loja.php")
