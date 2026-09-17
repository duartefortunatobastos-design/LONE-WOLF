<?php
$adminPagina = basename($_SERVER["PHP_SELF"] ?? "");
$adminSecao = $_GET["secao"] ?? "";
if ($adminPagina === "admin_mensagens.php" && $adminSecao === "") {
    $adminSecao = "resumo";
}

$adminCounts = ["encomendas" => 0, "produtos" => 0, "contas" => 0];

if (isset($conn) && $conn instanceof mysqli) {
    $consultas = [
        "encomendas" => "SELECT COUNT(*) AS n FROM encomendas",
        "produtos" => "SELECT COUNT(*) AS n FROM produtos",
        "contas" => "SELECT COUNT(*) AS n FROM utilizadores",
    ];
    foreach ($consultas as $chave => $sql) {
        $resultado = $conn->query($sql);
        if ($resultado) {
            $adminCounts[$chave] = (int) ($resultado->fetch_assoc()["n"] ?? 0);
        }
    }
}
?>
<nav class="races-filters" aria-label="Secções do painel">
    <a href="admin_mensagens.php" class="races-filter<?= $adminPagina === "admin_mensagens.php" && $adminSecao === "resumo" ? " is-active" : "" ?>"<?= $adminPagina === "admin_mensagens.php" && $adminSecao === "resumo" ? " aria-current=\"page\"" : "" ?>>
        Resumo
    </a>
    <a href="admin_encomendas.php" class="races-filter<?= $adminPagina === "admin_encomendas.php" ? " is-active" : "" ?>"<?= $adminPagina === "admin_encomendas.php" ? " aria-current=\"page\"" : "" ?>>
        Encomendas <em><?= $adminCounts["encomendas"] ?></em>
    </a>
    <a href="admin_produtos.php" class="races-filter<?= $adminPagina === "admin_produtos.php" ? " is-active" : "" ?>"<?= $adminPagina === "admin_produtos.php" ? " aria-current=\"page\"" : "" ?>>
        Produtos <em><?= $adminCounts["produtos"] ?></em>
    </a>
    <a href="admin_mensagens.php?secao=contas" class="races-filter<?= $adminPagina === "admin_mensagens.php" && $adminSecao === "contas" ? " is-active" : "" ?>"<?= $adminPagina === "admin_mensagens.php" && $adminSecao === "contas" ? " aria-current=\"page\"" : "" ?>>
        Contas <em><?= $adminCounts["contas"] ?></em>
    </a>
</nav>
