<?php
http_response_code(503);
header("Retry-After: 3600");
header("Cache-Control: no-store, no-cache, must-revalidate");
?><!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Lone Wolf — Atualização</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Outfit:wght@500;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { min-height: 100%; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0a0a0b;
            color: #f5f5f4;
            font-family: Outfit, system-ui, sans-serif;
            text-align: center;
            padding: 32px 24px;
        }
        .box { max-width: 560px; }
        .kicker {
            margin: 0 0 18px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: #e57f1f;
        }
        h1 {
            margin: 0 0 20px;
            font-family: Oswald, Impact, sans-serif;
            font-size: clamp(56px, 12vw, 92px);
            line-height: 0.9;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }
        h1 span { color: #e57f1f; }
        p {
            margin: 0 auto 28px;
            max-width: 36ch;
            font-size: 18px;
            line-height: 1.55;
            color: #9a9a9d;
        }
        a {
            color: #e57f1f;
            font-weight: 600;
            text-decoration: none;
        }
        a:hover { color: #ff9a1f; }
    </style>
</head>
<body>
    <div class="box">
        <p class="kicker">Atualização em curso</p>
        <h1>LONE <span>WOLF</span></h1>
        <p>O site está a ser atualizado. Volta dentro de momentos.</p>
        <p>
            <a href="https://www.instagram.com/ruibastos.lonewolf/" target="_blank" rel="noopener noreferrer">Instagram</a>
            &nbsp;·&nbsp;
            <a href="https://www.facebook.com/rui.bastos.39" target="_blank" rel="noopener noreferrer">Facebook</a>
        </p>
    </div>
</body>
</html>
<?php
exit;
