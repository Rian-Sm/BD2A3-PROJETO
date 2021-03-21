<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');

if(!empty($_GET['date_final'])){
    $date = $_GET['date_final']."-01";
    $query = "CALL sp_get_licenca_date('{$date}')";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Painel html</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body class="d-flex flex-column h-100">
<div>
    <nav class="navbar  navbar-expand-lg navbar-dark bg-primary pl-5 py-3">
        <div class="container">
            <a class="navbar-brand" href="./painel.php"><h2><?php echo 'Olá, '.$_SESSION['usuario']; ?></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"           aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <div class = "nav-item mr-5">
                    <a href="./logout.php.php">
                        <button  type="button" class="btn btn-danger px-5">Logout</button>
    
                    </a>
                </div>
            </div>
        </div>
    
    </nav>

    <div class= "section mb-5 container">
        <div class="mt-3 justify-center pb-3 mt-5 ">
            <h2>Pesquisa de Licenças</h2>
        </div>

        <?php if(isset($_SESSION["nao_autenticado"])): ?>
            <div class="alert alert-danger" role="alert">
                Erro na operação!
            </div>
        <?php unset($_SESSION['nao_autenticado']); endif; ?>

        <?php if(isset($_SESSION["autenticado"])): ?>
            <div class="alert alert-success" role="alert">
                Operação realizada com sucesso!
            </div>
        <?php unset($_SESSION['autenticado']); endif; ?>
        
        
        <div class="row mb-3 container">
            <form class="col-md-12 col-sm-12" method="GET" action="./pesquisa.php">
                <div class="row mb-3">
                    <label class="col-md-4" for="date_final">Data Final da Assinatura: 
                    </label>
                    <input class="col-md-4" type="month"  id="date_final" name="date_final" value=<?php echo date('Y-m-d');?>>
                    <div class="col-md-4">
                    <button col="col-md-4" type="submit" class="btn btn-primary">Buscar</button> 
                    </div>
                    
                </div>         
            </form>
        </div>
        <?php  if(!empty($_GET['date_final'])):
                $result = mysqli_query($link, $query);
                if (!mysqli_num_rows($result)==0):
                    echo "<h4 class='alert alert-success' role='alert'>Resultado para elementos com essa data: ".$_GET['date_final']." </h4>";
            ?>

            <div class="row">
                <div class="col" style="overflow-x:auto;">
                    <table class="table">
                        <tr>   
                            <th>CNPJ</th>
                            <th>NOME DO CLIENTE</th>
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
                        
                        <?php 
                            while($row = mysqli_fetch_assoc($result)):?>
                            <tr>
                                <?php echo "<td>{$row['cnpj_cliente']}</td>"?>
                                <?php echo "<td>{$row['nome_cliente']}</td>"?>
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
            </div>

            <?php else:
                echo "<h4 class='alert alert-danger' role='alert'>Não há elementos para ".$_GET['date_final']." </h4>";
                endif;
            endif; ?>
    </div>

    <footer class="footer mt-auto py-3 bg-light mt-5">
        <div class="container">
            <span class="text-muted">Coloque o conteúdo do rodapé fixo aqui.</span>
        </div>
    </footer>
    
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
</body>
</html>