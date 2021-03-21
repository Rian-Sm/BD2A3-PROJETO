<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');

if (empty($_POST['id_licenca']) || empty($_POST['nome_licenca']) ||
 empty($_POST['tipo_licenca'] || empty($_POST['versao_sistema']) ||
  empty($_POST['descricao_sistema'])|| empty($_POST['periodo_licenca']) )) {
    $_SESSION["nao_autenticado"] = true;
    $_SESSION["erro"] = 'elemetos vazios!!';
    header('location: licenca.php');
    exit();
}

$id_licenca = mysqli_real_escape_string($link, $_POST['id_licenca']);
$nome_licenca = mysqli_real_escape_string($link, $_POST['nome_licenca']);
$tipo_licenca = mysqli_real_escape_string($link, $_POST['tipo_licenca']);
$versao_sistema = mysqli_real_escape_string($link, $_POST['versao_sistema']);
$descricao_sistema = mysqli_real_escape_string($link, $_POST['descricao_sistema']);
$periodo_licenca = mysqli_real_escape_string($link, $_POST['periodo_licenca']);


$update = "UPDATE licenca set nome_licenca ='{$nome_licenca}', tipo_sistema = '{$tipo_licenca}', versao_sistema='{$versao_sistema}', descricao_sistema ='{$descricao_sistema}', periodo_licenca = {$periodo_licenca}
where  id_licenca = {$id_licenca};";

if (mysqli_query($link, $update)) {
    $_SESSION["autenticado"] = true;
    header('location: licenca.php');
    exit();
} else {
    $_SESSION["nao_autenticado"] = true;
    header('location: licenca.php');
    exit();
}

?>