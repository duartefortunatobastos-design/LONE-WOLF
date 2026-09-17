#!/usr/bin/env python3
import re
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent

PAGES = [
    ("carrinho.php", "Carrinho | Lone Wolf", "pagina-carrinho"),
    ("checkout.php", "Checkout | Lone Wolf", "pagina-checkout"),
    ("finalizar_encomenda.php", "Encomenda Concluída | Lone Wolf", "pagina-checkout"),
]


def migrate(name, title, body_class):
    path = ROOT / name
    content = path.read_text(encoding="utf-8")
    if "includes/head.php" in content:
        print(f"skip {name}")
        return

    content = re.sub(
        r"<\?php\s*session_start\(\);\s*include\s*[\"']ligacao\.php[\"'];\s*",
        '<?php\nrequire_once "includes/init.php";\n\n',
        content,
        count=1,
    )
    content = re.sub(r"<style>[\s\S]*?</style>\s*", "", content, flags=re.I)
    content = re.sub(r"<!DOCTYPE html>[\s\S]*?</head>\s*<body>\s*", "", content, flags=re.I)
    content = re.sub(r"</body>\s*</html>\s*$", "", content, flags=re.I)

    match = re.match(r"(<\?php[\s\S]*?\?>)\s*", content)
    preamble = match.group(1) if match else '<?php\nrequire_once "includes/init.php";\n?>'
    rest = content[len(preamble) :].lstrip()

    final = (
        preamble.rstrip()
        + f'\n\n$pageTitle = "{title}";\n$bodyClass = "{body_class}";\nrequire_once "includes/head.php";\n?>\n\n'
        + '<?php include "header.php"; ?>\n\n'
        + rest
    )

    if "footer.php" in final and "</html>" not in final:
        final = final.rstrip() + "\n\n</body>\n</html>\n"

    path.write_text(final, encoding="utf-8")
    print(f"migrated {name}")


for item in PAGES:
    migrate(*item)
