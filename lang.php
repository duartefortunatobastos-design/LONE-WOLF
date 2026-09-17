<?php
$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'pt';
$_SESSION['lang'] = $lang;

$traducoes = [
    'pt' => [
        'inicio' => 'Início',
        'loja' => 'Loja',
        'login' => 'Login',
        'logout' => 'Logout'
    ],
    'en' => [
        'inicio' => 'Home',
        'loja' => 'Shop',
        'login' => 'Login',
        'logout' => 'Logout'
    ]
];

function t($key) {
    global $traducoes, $lang;
    return $traducoes[$lang][$key] ?? $key;
}