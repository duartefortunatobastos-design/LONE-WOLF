<?php
header("Content-Type: application/xml; charset=UTF-8");
$config = require __DIR__ . "/includes/site-config.php";
$base = rtrim($config["site_url"], "/");

$paginas = [
    "", "sobre.php", "historia.php", "provas.php", "rotina.php", "galeria.php",
    "patrocinadores.php", "faq.php", "loja.php", "contatos.php",
    "login.php", "registro.php", "politica-de-privacidade.php", "politica-de-cookies.php",
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($paginas as $pagina) {
    $loc = $base . "/" . $pagina;
    echo "  <url><loc>" . htmlspecialchars($loc) . "</loc><changefreq>weekly</changefreq></url>\n";
}

echo "</urlset>";
