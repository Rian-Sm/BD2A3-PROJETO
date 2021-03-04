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
                    <a href="./logout.php">
                        <button  type="button" class="btn btn-danger px-5">Logout</button>
    
                    </a>
                </div>
            </div>
        </div>
    
    </nav>

    <div class= "section mb-5 container">
        <div class="mt-3 justify-center pb-3 mt-5 ">
            <h2>Cadastro de Licenças</h2>
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

        <div class="row">
            <form class="col-md-6 col-sm-12" method="POST" action="./createCliente">
                <div class="row mb-3 mt-5">
                    <h3 class="col-12 mb-5">Nova Licença:</h2>
                    <label class="col-md-4" for="nome_licenca" >Nome do licença:</label>
                    <input class="col-md-7" type="text" id="nome_licenca" name="nome_licenca">
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="tipo_licenca">Tipo de sistema:</label>
                    <input class="col-md-7" type="text"  id="tipo_licenca" name="tipo_licenca">
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="versao_sistema">Versão do sistema:</label>
                    <input class="col-md-7" type="text"  id="versao_sistema" name="versao_sistema">
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="descricao_sistema">Descrição do sistema</label>
                    <textarea  class="col-md-7" row="4" cols="40" id="descricao_sistema" name="descricao_sistema">
                    </textarea>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="periodo_licenca">Periodo (meses):</label>
                    <input class="col-md-7" type="number"  id="periodo_licenca" name="periodo_licenca" min=1 >
                </div>
                <div class="row mb-3 justify-content-center">
                    <button col="col" type="submit" class="btn btn-primary">Enviar</button> 
                </div>
            </form> 
            <form class="col-md-6 col-sm-12" method="POST" action="./createCliente">
                <div class="row mb-3 mt-5">
                    <h3 class="col-12 mb-5">Alterar licença:</h2>
                    <label class="col-md-4" for="nome_licenca" >ID da licença:</label>
                    <input class="col-md-7" type="text" id="nome_licenca" name="nome_licenca">
                </div>
                <div class="row mb-3 mt-5">
                    <label class="col-md-4" for="nome_licenca" >Nome da licença:</label>
                    <input class="col-md-7" type="text" id="nome_licenca" name="nome_licenca">
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="tipo_licenca">Tipo de sistema:</label>
                    <input class="col-md-7" type="text"  id="tipo_licenca" name="tipo_licenca">
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="versao_sistema">Versão do sistema:</label>
                    <input class="col-md-7" type="text"  id="versao_sistema" name="versao_sistema">
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="descricao_sistema">Descrição do sistema</label>
                    <textarea  class="col-md-7" row="4" cols="40" id="descricao_sistema" name="descricao_sistema">
                    </textarea>
                </div>

                <div class="row mb-3">
                    <label class="col-md-4" for="periodo_licenca">Periodo (meses):</label>
                    <input class="col-md-7" type="number"  id="periodo_licenca" name="periodo_licenca" min=1 >
                </div>
                <div class="row mb-3 justify-content-center">
                    <button col="col" type="submit" class="btn btn-primary">Enviar</button> 
                </div>
            </form> 
            
        </div>

        <div class="row">
            <h3>Clientes cadastrados:</h3>
                    <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="./getAllCliente"></iframe>
                    </div>           
            </div>
        </div>

        <div class="row justify-content-center">    
            <form class="col-md-6 alert alert-danger" role="alert" method="POST" action="./deleteCliente">
                <div class="row mb-3 mt-5">
                    <h3 class="col-12 mb-5 ">Deletar dados:</h3>

                    <p class='col-12'>Cuidado ao deletar dados, ele são perdidos permanentemente.</p>
                    <label class="col-md-4" for="id_cliente" >id do cliente:</label>
                    <input class="col-md-7" type="number" id="id_cliente" name="id_cliente" min="1">
                </div>
                <div class="row mb-3 justify-content-center">
                    <button col="col" type="submit" class="btn btn-danger">Deletar</button>        
                </div>
            </form>
        </div>

    </div>

    <footer class="footer mt-auto py-3 bg-light mt-5">
        <div class="container">
            <span class="text-muted">Coloque o conteúdo do rodapé fixo aqui.</span>
        </div>
    </footer>
    
</div>
 
</body>
</html>