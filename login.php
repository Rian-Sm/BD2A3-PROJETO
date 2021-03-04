<?php
session_start();
include('./source/connect.php');

if (empty($_POST['usuario']) || empty($_POST['senha'])){
    $_SESSION["nao_autenticado"] = true;
    header('location: index.php');
    exit();
}
    
$usuario    = mysqli_real_escape_string($link, $_POST['usuario']);
$senha      = mysqli_real_escape_string($link, $_POST['senha']);

$query = "SELECT usuario, usuario_id from usuario where usuario = '{$usuario}' and senha = md5('{$senha}');" ;

$result = mysqli_query($link, $query);

$row = mysqli_num_rows($result);

if ($row ==1){
    $_SESSION["usuario"] = $usuario;
    header('location: painel.php');
    exit();
} else {
    $_SESSION["nao_autenticado"] = true;
    header('location: index.php');
    exit();
}

