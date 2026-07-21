<?php
session_start();
include "ligacao.php";
include 'header.php';



// Só admins podem aceder
if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"] !== "admin"){
    echo json_encode(["total" => 0]);
    exit();
}

$sql = "SELECT COUNT(*) as total FROM mensagens WHERE respondida = 0";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo json_encode(["total" => (int)$row["total"]]);