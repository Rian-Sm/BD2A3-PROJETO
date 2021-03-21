<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');

if (empty($_POST['nome_cliente']) || empty($_POST['cnpj_cliente']) || empty($_POST['id_cliente']) ){
    $_SESSION["nao_autenticado"] = true;
    header('location: cliente.php');
    exit();
}

$id_cliente = mysqli_real_escape_string($link, $_POST['id_cliente']);
$cliente = mysqli_real_escape_string($link, $_POST['nome_cliente']);
$cnpj_cliente = mysqli_real_escape_string($link, $_POST['cnpj_cliente']);

$update = "UPDATE cliente set nome_cliente = '{$cliente}', cnpj_cliente = '{$cnpj_cliente}'
where id_cliente = '{$id_cliente}';";

if (mysqli_query($link, $update)) {
    $_SESSION["autenticado"] = true;
    header('location: cliente.php');
    exit();
} else {
    $_SESSION["nao_autenticado"] = true;
    header('location: cliente.php');
    exit();
}

?>