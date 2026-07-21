<?php
session_start();
include "ligacao.php";

if(!isset($_POST['categoria_id'])){
    exit("Categoria não definida");
}

$categoria_id = intval($_POST['categoria_id']);

// Pega produtos da categoria
$sql = "SELECT * FROM produtos WHERE categoria_id = ? ORDER BY nome";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $categoria_id);
$stmt->execute();
$result = $stmt->get_result();

while($prod = $result->fetch_assoc()){
    echo '<div class="produto">';
    echo '<img src="'.htmlspecialchars($prod['imagem']).'" alt="'.htmlspecialchars($prod['nome']).'">';
    echo '<h3>'.htmlspecialchars($prod['nome']).'</h3>';
    echo '<p>€'.number_format($prod['preco'],2).'</p>';
    echo '<form method="POST" action="checkout.php">';
    echo '<input type="hidden" name="produto_id" value="'.$prod['id'].'">';
    echo '<label>Tamanho:</label><select name="tamanho">';
    echo '<option value="S">S</option><option value="M">M</option><option value="L">L</option>';
    echo '</select><br>';
    echo '<button type="submit">Comprar</button>';
    echo '</form>';
    echo '</div>';
}