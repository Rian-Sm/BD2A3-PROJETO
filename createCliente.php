<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');

if (empty($_POST['nome_cliente']) || empty($_POST['cnpj_cliente'])){
    $_SESSION["nao_autenticado"] = true;
    header('location: cliente.php');
    exit();
}

$cliente = mysqli_real_escape_string($link, $_POST['nome_cliente']);
$cnpj_cliente = mysqli_real_escape_string($link, $_POST['cnpj_cliente']);

$query = "INSERT INTO cliente (nome_cliente, cnpj_cliente) VALUES ('{$cliente}', '{$cnpj_cliente}')";

if (mysqli_query($link, $query)) {
    $_SESSION["autenticado"] = true;
    header('location: cliente.php');
    exit();
} else {
    $_SESSION["nao_autenticado"] = true;
    header('location: cliente.php');
    exit();
}

?>