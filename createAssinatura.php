<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');

if (empty($_POST['cnpj_cliente']) 
    || empty($_POST['id_licenca'])
    || empty($_POST['estacao'])
    || empty($_POST['key_assinatura'])
    || empty($_POST['data_aquisicao']))
    {
        $_SESSION["nao_autenticado"] = true;
        header('location: cliente.php');
        exit();
}

$cpf_cliente = mysqli_real_escape_string($link, $_POST['cnpj_cliente']);
$id_licenca = mysqli_real_escape_string($link, $_POST['id_licenca']);
$estacao = mysqli_real_escape_string($link, $_POST['estacao']);
$key_assinatura = mysqli_real_escape_string($link, $_POST['key_assinatura']);
$data_aquisicao = mysqli_real_escape_string($link, $_POST['data_aquisicao']);

$query_id_cliente = "select id_cliente from cliente where cnpj_cliente = '{$cpf_cliente}';";
$result_id_cliente = mysqli_query($link, $query_id_cliente);
$row_id_cliente =  mysqli_fetch_array($result_id_cliente);

$query_licenca_periodo = "SELECT periodo_licenca from licenca where id_licenca = {$id_licenca};";
$result_licenca = mysqli_query($link, $query_licenca_periodo);
$row_licenca = mysqli_fetch_array($result_licenca);

$id_cliente = $row_id_cliente['id_cliente'];

if (!empty($_POST['date_final_aquisicao'])){
    $date_final_aquisicao = mysqli_real_escape_string($link, $_POST['date_final_aquisicao']);
} else {
    $date_modify = new datetime($data_aquisicao);
    date_modify($date_modify,"+".$row_licenca['periodo_licenca']." month");
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

$query = "insert into assinaturas (fk_id_cliente, fk_id_licenca, estacao, key_assinatura, data_aquisicao, date_final_aquisicao, atualizado, confirmado) VALUES ({$id_cliente}, {$id_licenca}, {$estacao}, '{$key_assinatura}', '{$data_aquisicao}', '{$date_final_aquisicao}', '{$atualizado}', '{$confirmado}');";

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