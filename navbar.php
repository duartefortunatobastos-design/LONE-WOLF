<nav class="menu-interno">

<ul>

<li class="dropdown">

<a href="#">Categoria</a>

<ul class="submenu">

<li class="submenu-item" data-categoria="all">
<i class="fa-solid fa-layer-group"></i> Todos
</li>

<?php

$cat_query = $conn->query("SELECT DISTINCT categoria FROM produtos ORDER BY categoria");

while($cat = $cat_query->fetch_assoc()){

echo '<li class="submenu-item" data-categoria="'.htmlspecialchars($cat['categoria']).'">

<i class="fa-solid fa-shirt"></i>

'.htmlspecialchars($cat['categoria']).'

</li>';

}

?>

</ul>

</li>

<li><a href="#">Novidades</a></li>
<li><a href="#">Destaques</a></li>
<li><a href="#" id="abrir-carrinho">Carrinho 🛒</a></li>

</ul>

</nav>