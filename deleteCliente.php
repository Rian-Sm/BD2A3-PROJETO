<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');

if (empty($_POST['id_cliente'])){
    $_SESSION["nao_autenticado"] = true;
    header('location: cliente.php');
    exit();
}

$id_cliente = mysqli_real_escape_string($link, $_POST['id_cliente']);

$query = "delete from cliente Where id_cliente = '{$id_cliente}';";

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