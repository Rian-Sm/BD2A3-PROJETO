<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');
$query = 'SELECT * from licenca ORDER BY id_licenca;';

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
    <table>
        <tr>
            <th >#</th>
            <th>NOME</th>
            <th>TIPO SISTEMA</th>
            <th>VERSÃO SISTEMA</th>
            <th>DESCRIÇÂO</th>
            <th>PERIODO</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)):?>
            <tr>
                <?php echo "<td>{$row['id_licenca']}</td>"?>
                <?php echo "<td>{$row['nome_licenca']}</td>"?>
                <?php echo "<td>{$row['tipo_sistema']}</td>"?>
                <?php echo "<td>{$row['versao_sistema']}</td>"?>
                <?php echo "<td>{$row['descricao_sistema']}</td>"?>
                <?php echo "<td>{$row['periodo_licenca']}</td>"?>
            </tr>
        <?php endwhile;?>
            
    </table>
    </div>
</body>
</html>