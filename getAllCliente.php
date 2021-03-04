<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');
$query = 'SELECT * from cliente;';

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
        <table style="width:100%">
            <tr>
                <th>CODIGO ID</th>
                <th>NOME</th>
                <th>CNPJ</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)):?>
                <tr>
                    <?php echo "<td>{$row['id_cliente']}</td>"?>
                    <?php echo "<td>{$row['nome_cliente']}</td>"?>
                    <?php echo "<td>{$row['cnpj_cliente']}</td>"?>
                </tr>
            <?php endwhile;?>
                
        </table>
    
</body>
</html>