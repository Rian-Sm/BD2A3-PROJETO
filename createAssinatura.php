<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');

if (empty($_POST['as_id_cliente']) 
    || empty($_POST['id_licenca'])
    || empty($_POST['estacao'])
    || empty($_POST['key_assinatura'])
    || empty($_POST['data_aquisicao']))
    {
        $_SESSION["nao_autenticado"] = true;
        //header('location: cliente.php');
        exit();
}

$id_cliente = mysqli_real_escape_string($link, $_POST['as_id_cliente']);
$id_licenca = mysqli_real_escape_string($link, $_POST['id_licenca']);
$estacao = mysqli_real_escape_string($link, $_POST['estacao']);
$key_assinatura = mysqli_real_escape_string($link, $_POST['key_assinatura']);
$data_aquisicao = mysqli_real_escape_string($link, $_POST['data_aquisicao']);

$licenca_periodo = "SELECT periodo_licenca from licenca where id_licenca = {$id_licenca};";
$result = mysqli_query($link, $licenca_periodo);
$row = mysqli_fetch_array($result);

if (!empty($_POST['date_final_aquisicao'])){
    $date_final_aquisicao = mysqli_real_escape_string($link, $_POST['date_final_aquisicao']);
} else {
    $date_modify = new datetime($data_aquisicao);
    date_modify($date_modify,"+".$row['periodo_licenca']." month");
    $date_final_aquisicao = date_format($date_modify, 'Y-m-d');
}

if (!empty($_POST['atualizado'])){
    $atualizado = mysqli_real_escape_string($link, $_POST['atualizado']);
} else {
    $atualizado = 'false';
}

if (!empty($_POST['confirmado'])){
    $confirmado = mysqli_real_escape_string($link, $_POST['confirmado']);
} else {
    $confirmado = 'false';
}

$query = "INSERT into assinaturas (fk_id_cliente, fk_id_licenca, estacao, key_assinatura, data_aquisicao, date_final_aquisicao, atualizado, confirmado) values ({$id_cliente}, {$id_licenca}, {$estacao}, '{$key_assinatura}', '$data_aquisicao}', '{$date_final_aquisicao}', {$atualizado}, {$confirmado});";

if (mysqli_query($link, $query)) {
    $_SESSION["autenticado"] = true;
    header('location: cliente.php');
    exit();
} else {
    $_SESSION["nao_autenticado"] = true;
    echo "erro ao criar assinatura " . "INSERT into assinaturas (fk_id_cliente, fk_id_licenca, estacao, key_assinatura, data_aquisicao, date_final_aquisicao, atualizado, confirmado) values ({$id_cliente}, {$id_licenca}, {$estacao}, '{$key_assinatura}', '$data_aquisicao}', '{$date_final_aquisicao}', {$atualizado}, {$confirmado});";
    //header('location: cliente.php');
    exit();
}

?>