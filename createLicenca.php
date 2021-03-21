<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');

if (empty($_POST['nome_licenca']) || empty($_POST['tipo_licenca'] || empty($_POST['versao_sistema']) || empty($_POST['descricao_sistema'])|| empty($_POST['periodo_licenca']) )) {
    $_SESSION["nao_autenticado"] = true;
    header('location: licenca.php');
    exit();
}

$licenca = mysqli_real_escape_string($link, $_POST['nome_licenca']);
$tipo_licenca = mysqli_real_escape_string($link, $_POST['tipo_licenca']);
$versao_licenca = mysqli_real_escape_string($link, $_POST['versao_sistema']);
$descricao_licenca = mysqli_real_escape_string($link, $_POST['descricao_sistema']);
$periodo_licenca = mysqli_real_escape_string($link, $_POST['periodo_licenca']);


$query = "INSERT INTO licenca (nome_licenca, tipo_sistema, versao_sistema, descricao_sistema, periodo_licenca) 
VALUES ('{$licenca}', '{$tipo_licenca}', '{$versao_licenca}', '{$descricao_licenca}', {$periodo_licenca});" ;

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