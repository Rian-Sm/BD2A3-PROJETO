<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');
$query = 'call sp_get_all_assinaruras();';

$result = mysqli_query($link, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Painel html</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
</head>

<body>
    <div class="table">
    <table style="width: 100%">
        <tr>
            <th >#</th>
            <th>CNPJ</th>
            <th>NOME LICENÇA</th>
            <th>TIPO DE SISTEMA</th>
            <th>VERSÃO DO SISTEMA</th>
            <th>ESTAÇÃO</th>
            <th>CHAVE GERADA</th>
            <th>DATA AQUISIÇÃO</th>
            <th>DATA FINAL DA AQUISIÇÃO</th>
            <th>ATUALIZADO</th>
            <th>CONFIRMADO</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)):?>
            <tr>
                <?php echo "<td>{$row['id_aquisicao']}</td>"?>
                <?php echo "<td>{$row['cnpj_cliente']}</td>"?>
                <?php echo "<td>{$row['nome_licenca']}</td>"?>
                <?php echo "<td>{$row['tipo_sistema']}</td>"?>
                <?php echo "<td>{$row['versao_sistema']}</td>"?>
                <?php echo "<td>{$row['estacao']}</td>"?>
                <?php echo "<td>{$row['key_assinatura']}</td>"?>
                <?php echo "<td>{$row['data_aquisicao']}</td>"?>
                <?php echo "<td>{$row['date_final_aquisicao']}</td>"?>
                <?php echo "<td>{$row['atualizado']}</td>"?>
                <?php echo "<td>{$row['confirmado']}</td>"?>
            </tr>
        <?php endwhile;?>
            
    </table>
    </div>

</body>
</html>