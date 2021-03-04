<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');

if (empty($_POST['id_licenca'])){
    $_SESSION["nao_autenticado"] = true;
    header('location: licenca.php');
    exit();
}

$id_licenca = mysqli_real_escape_string($link, $_POST['id_licenca']);

$query = "delete from licenca Where id_licenca = '{$id_licenca}';";

if (mysqli_query($link, $query)) {
    $_SESSION["autenticado"] = true;
    header('location: licenca.php');
    exit();
} else {
    $_SESSION["nao_autenticado"] = true;
    header('location: licenca.php');
    exit();
}

?>