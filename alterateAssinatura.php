<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');

if (empty($_POST['at_cnpj_cliente']) 
    || empty($_POST['at_id_licenca'])
    || empty($_POST['at_estacao'])
    || empty($_POST['at_key_assinatura'])
    || empty($_POST['at_data_aquisicao']))
    {
        $_SESSION["nao_autenticado"] = true;
        header('location: cliente.php');
        exit();
}

$cpf_cliente = mysqli_real_escape_string($link, $_POST['at_cnpj_cliente']);
$id_licenca = mysqli_real_escape_string($link, $_POST['at_id_licenca']);
$estacao = mysqli_real_escape_string($link, $_POST['at_estacao']);
$key_assinatura = mysqli_real_escape_string($link, $_POST['at_key_assinatura']);
$data_aquisicao = mysqli_real_escape_string($link, $_POST['at_data_aquisicao']);

$licenca_periodo = "SELECT periodo_licenca from licenca where id_licenca = {$id_licenca};";
$result = mysqli_query($link, $licenca_periodo);
$row = mysqli_fetch_array($result);

if (!empty($_POST['at_date_final_aquisicao'])){
    $date_final_aquisicao = mysqli_real_escape_string($link, $_POST['at_date_final_aquisicao']);
} else {
    $date_modify = new datetime($data_aquisicao);
    date_modify($date_modify,"+".$row['periodo_licenca']." month");
    $date_final_aquisicao = date_format($date_modify, 'Y-m-d');
}

if (!empty($_POST['at_atualizado'])){
    $atualizado = mysqli_real_escape_string($link, $_POST['at_atualizado']);
} else {
    $atualizado = 'false';
}

if (!empty($_POST['at_confirmado'])){
    $confirmado = mysqli_real_escape_string($link, $_POST['at_confirmado']);
} else {
    $confirmado = 'false';
}

$query_id = "SELECT id_aquisicao from assinaturas where fk_id_cliente = {$cpf_cliente} and fk_id_licenca = {$id_licenca} and estacao = {$estacao};";
$result = mysqli_query($link, $query_id);


if(mysqli_num_rows($result)==1){
    $row = mysqli_fetch_array($result);
    echo $row;

    $update = "UPDATE assinaturas set key_assinatura = '{$key_assinatura}',
        data_aquisicao = '{$data_aquisicao}',
        date_final_aquisicao = '{$date_final_aquisicao}',
        atualizado = {$atualizado},
        confirmado = {$confirmado}
        WHERE id_aquisicao = {$row['id_aquisicao']};";

    if (mysqli_query($link, $update)) {
        $_SESSION["autenticado"] = true;
        header('location: cliente.php');
        exit();

    } else {
        $_SESSION["nao_autenticado"] = true;
        header('location: cliente.php');
        exit();
    }

} else {
    $_SESSION["nao_autenticado"] = true;
    header('location: cliente.php');
    exit();
}

?>