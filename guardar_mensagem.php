<?php
session_start();
include "ligacao.php";
include 'header.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    $sql = "INSERT INTO mensagens (nome, email, mensagem)
            VALUES ('$nome', '$email', '$mensagem')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href='contatos.php';</script>";
    } else {
        echo "Erro: " . $conn->error;
    }

    $conn->close();
}
?>
