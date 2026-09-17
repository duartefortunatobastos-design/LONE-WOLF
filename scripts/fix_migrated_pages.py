#!/usr/bin/env python3
"""Corrige duplicações introduzidas pela migração."""

import re
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent

PATROCINADOR_BGS = {
    "patrocinador1.php": "IMAGENS/PREDIAL_PIEDENSE.jpeg",
    "patrocinador2.php": "IMAGENS/FILIPE_PAIVA.png",
    "patrocinador3.php": "IMAGENS/LH_GINASIO.jpeg",
    "patrocinador4.php": "IMAGENS/IMPERATRIZ.png",
}


def strip_legacy_session_blocks(content: str) -> str:
    content = re.sub(
        r"<\?php\s*session_start\(\);\s*include\s+[\"']ligacao\.php[\"'];\s*\?>\s*",
        "",
        content,
        flags=re.I,
    )
    content = re.sub(r"^<\?php\s*session_start\(\);\s*\?>\s*", "", content, flags=re.M)
    return content


def dedupe_headers(content: str) -> str:
    parts = content.split('<?php include "header.php"; ?>')
    if len(parts) <= 2:
        return content
    return parts[0] + '<?php include "header.php"; ?>' + "".join(parts[2:])


def merge_init_blocks(content: str) -> str:
    """Junta blocos PHP iniciais num só, com init.php primeiro."""
    if "includes/init.php" not in content:
        return content

    php_blocks = re.findall(r"<\?php[\s\S]*?\?>", content)
    if len(php_blocks) < 2:
        return content

    merged_logic = []
    seen_init = False
    for block in php_blocks[:5]:
        if "includes/head.php" in block or 'include "header.php"' in block:
            continue
        inner = block[5:-2].strip()
        if not inner:
            continue
        if "includes/init.php" in inner:
            if seen_init:
                inner = re.sub(r'require_once\s+["\']includes/init\.php["\'];\s*', "", inner)
            else:
                seen_init = True
        inner = strip_legacy_session_blocks(f"<?php {inner} ?>")[5:-2].strip()
        if inner:
            merged_logic.append(inner)

    if not merged_logic:
        return content

    first_head = content.find("includes/head.php")
    if first_head == -1:
        return content

    before = content[: content.find("<?php")]
    after_head = content[content.find('<?php include "header.php"; ?>'):]

    new_preamble = "<?php\n" + "\n\n".join(merged_logic) + "\n\n"
    new_preamble += "$pageTitle = $pageTitle ?? 'Lone Wolf';\n"
    new_preamble += 'require_once "includes/head.php";\n?>\n\n'

    title_match = re.search(r"\$pageTitle\s*=\s*([^;]+);", content)
    body_match = re.search(r"\$bodyClass\s*=\s*([^;]+);", content)

    logic_only = []
    for part in merged_logic:
        part = re.sub(r"\$pageTitle\s*=\s*[^;]+;\s*", "", part)
        part = re.sub(r"\$bodyClass\s*=\s*[^;]+;\s*", "", part)
        part = re.sub(r'require_once\s+["\']includes/head\.php["\'];\s*', "", part)
        if part.strip():
            logic_only.append(part.strip())

    new_preamble = "<?php\nrequire_once \"includes/init.php\";\n\n"
    new_preamble += "\n\n".join(logic_only)
    if logic_only:
        new_preamble += "\n\n"
    if title_match:
        new_preamble += f"$pageTitle = {title_match.group(1).strip()};\n"
    if body_match:
        new_preamble += f"$bodyClass = {body_match.group(1).strip()};\n"
    new_preamble += 'require_once "includes/head.php";\n?>\n\n'

    return new_preamble + after_head


def fix_provas(content: str) -> str:
    if "contarProvas" not in content:
        return content

    arrays_match = re.search(
        r"(\$provas10km\s*=\s*\[[\s\S]*?function contarProvas\(\$lista\)\s*\{\s*return count\(\$lista\);\s*\})",
        content,
    )
    if not arrays_match:
        return content

    logic = arrays_match.group(1)
    rest = content[content.find('<?php include "header.php"; ?>'):]
    rest = dedupe_headers(rest)

    return (
        "<?php\nrequire_once \"includes/init.php\";\n\n"
        + logic
        + "\n\n$pageTitle = 'Competições | Lone Wolf';\n"
        + "$bodyClass = 'content-page';\n"
        + 'require_once "includes/head.php";\n?>\n\n'
        + rest
    )


def fix_contatos(content: str) -> str:
    if "contatos.php" not in str(content):
        return content

    post_block = re.search(
        r"(<\?php\s*require_once \"includes/auth\.php\";[\s\S]*?\?\>)",
        content,
    )
    if not post_block:
        return merge_init_blocks(strip_legacy_session_blocks(dedupe_headers(content)))

    logic = post_block.group(1)[5:-2].strip()
    logic = re.sub(r'require_once\s+["\']includes/init\.php["\'];\s*', "", logic)

    rest = content[content.find('<?php include "header.php"; ?>'):]
    rest = dedupe_headers(rest)

    return (
        "<?php\nrequire_once \"includes/init.php\";\n"
        + logic
        + "\n\n$pageTitle = 'Contacto | Lone Wolf';\n"
        + "$bodyClass = 'content-page';\n"
        + 'require_once "includes/head.php";\n?>\n\n'
        + rest
    )


def add_patrocinador_bg(content: str, filename: str) -> str:
    bg = PATROCINADOR_BGS.get(filename)
    if not bg:
        return content
    old = '<section class="parceiro-hero">'
    new = f'<section class="parceiro-hero" style="--parceiro-bg: url(\'{bg}\')">'
    return content.replace(old, new, 1)


def fix_file(path: Path) -> bool:
    original = path.read_text(encoding="utf-8")
    content = original

    if path.name == "provas.php":
        content = fix_provas(content)
    elif path.name == "contatos.php":
        content = fix_contatos(content)
    else:
        content = strip_legacy_session_blocks(content)
        content = dedupe_headers(content)
        if path.name == "loja.php":
            content = merge_init_blocks(content)

    content = add_patrocinador_bg(content, path.name)

    if content != original:
        path.write_text(content, encoding="utf-8")
        print(f"  fixed: {path.name}")
        return True
    return False


def main():
    files = list(ROOT.glob("*.php"))
    count = 0
    for path in sorted(files):
        if fix_file(path):
            count += 1
    print(f"Fixed {count} file(s).")


if __name__ == "__main__":
    main()
