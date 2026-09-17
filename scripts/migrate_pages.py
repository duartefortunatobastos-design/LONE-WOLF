#!/usr/bin/env python3
"""Migra páginas legadas para init.php + head.php e remove CSS/JS duplicado."""

import re
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent

PAGES = [
    "provas.php",
    "sobre.php",
    "historia.php",
    "galeria.php",
    "rotina.php",
    "patrocinadores.php",
    "patrocinador1.php",
    "patrocinador2.php",
    "patrocinador3.php",
    "patrocinador4.php",
    "loja.php",
    "contatos.php",
    "politica-de-privacidade.php",
    "politica-de-cookies.php",
]

BODY_CLASSES = {
    "provas.php": "content-page",
    "sobre.php": "content-page",
    "historia.php": "content-page",
    "galeria.php": "content-page",
    "rotina.php": "content-page",
    "patrocinadores.php": "content-page patrocinadores-page",
    "patrocinador1.php": "parceiro-page",
    "patrocinador2.php": "parceiro-page",
    "patrocinador3.php": "parceiro-page",
    "patrocinador4.php": "parceiro-page",
    "loja.php": "pagina-loja",
    "contatos.php": "content-page",
    "carrinho.php": "pagina-carrinho",
    "checkout.php": "pagina-checkout",
    "finalizar_encomenda.php": "pagina-checkout",
}


def extract_title(content: str) -> str:
    match = re.search(r"<title>([^<]+)</title>", content, re.I)
    return match.group(1).strip() if match else "Lone Wolf"


def extract_php_preamble(content: str) -> str:
    """Mantém PHP inicial (arrays, lógica) mas troca session_start/ligacao."""
    if not content.startswith("<?php"):
        return ""

    end = content.find("?>")
    if end == -1:
        return ""

    preamble = content[: end + 2]

    preamble = re.sub(
        r"<\?php\s*session_start\(\);\s*include\s*[\"']ligacao\.php[\"'];\s*\?>",
        "",
        preamble,
        flags=re.I,
    )
    preamble = re.sub(
        r"require_once\s+[\"']includes/init\.php[\"'];\s*",
        "",
        preamble,
    )
    preamble = re.sub(
        r"include\s+[\"']ligacao\.php[\"'];\s*",
        "",
        preamble,
    )
    preamble = preamble.strip()
    if preamble == "<?php" or preamble == "<?php?>":
        return ""
    return preamble + "\n\n"


def convert_translations(content: str) -> str:
    match = re.search(
        r"(?:const|let|var)\s+translations\s*=\s*(\{[\s\S]*?\n\s*\});",
        content,
    )
    if not match:
        return content

    translations_obj = match.group(1)
    snippet = f'<script>window.pageTranslations = {translations_obj};</script>\n'

    content = re.sub(
        r"<script>[\s\S]*?(?:const|let|var)\s+translations[\s\S]*?</script>\s*",
        "",
        content,
        count=1,
    )

    content = re.sub(
        r"<script>[\s\S]*?document\.addEventListener\([\"']DOMContentLoaded[\"'][\s\S]*?</script>\s*",
        "",
        content,
    )

    if 'include "footer.php"' in content:
        content = content.replace(
            '<?php include "footer.php"; ?>',
            snippet + '<?php include "footer.php"; ?>',
            1,
        )
    elif "include 'footer.php'" in content:
        content = content.replace(
            "<?php include 'footer.php'; ?>",
            snippet + "<?php include 'footer.php'; ?>",
            1,
        )
    else:
        content = content.rstrip() + "\n" + snippet

    return content


def migrate_file(filename: str) -> bool:
    path = ROOT / filename
    if not path.exists():
        print(f"  skip (missing): {filename}")
        return False

    original = path.read_text(encoding="utf-8")
    if "includes/head.php" in original and "<style>" not in original:
        print(f"  skip (already migrated): {filename}")
        return False

    content = original

    content = re.sub(r"<style>[\s\S]*?</style>\s*", "", content, flags=re.I)

    preamble = extract_php_preamble(content)

    title = extract_title(content)
    body_class = BODY_CLASSES.get(filename, "")

    content = re.sub(r"<!DOCTYPE html>[\s\S]*?</head>\s*", "", content, flags=re.I)
    content = re.sub(r"<body[^>]*>\s*", "", content, flags=re.I)
    content = re.sub(r"</body>\s*</html>\s*$", "", content, flags=re.I)

    content = convert_translations(content)

    content = content.strip() + "\n"

    head_block = (
        f'{preamble}<?php\n'
        f'require_once "includes/init.php";\n'
        f'\n'
        f'$pageTitle = {title!r};\n'
    )
    if body_class:
        head_block += f'$bodyClass = {body_class!r};\n'
    head_block += (
        f'require_once "includes/head.php";\n'
        f'?>\n\n'
        f'<?php include "header.php"; ?>\n\n'
    )

    if not content.lstrip().startswith("<?php include"):
        pass

    final = head_block + content.lstrip()
    if not final.rstrip().endswith("</html>"):
        final = final.rstrip() + "\n\n</body>\n</html>\n"

    path.write_text(final, encoding="utf-8")
    print(f"  migrated: {filename}")
    return True


def main():
    print("Migrating legacy pages...")
    count = 0
    for page in PAGES:
        if migrate_file(page):
            count += 1
    print(f"Done. {count} file(s) updated.")


if __name__ == "__main__":
    main()
