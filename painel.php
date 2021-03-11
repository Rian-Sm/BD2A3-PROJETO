<?php
session_start();
include('./verifica_login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Painel html</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
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
                <a href="./logout">
                <button  type="button" class="btn btn-danger px-5">Logout</button>
                </a>
            </div>
        </div>
        </nav>
    <div class="container">

    <div class= "section mb-5 container">
        <div class="row mt-3 justify-center pb-5 mt-5 ">
            <div class=" col-md-6 col-lg-3 mb-3">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Pesquisar</h5>
                    <p class="card-text">pesquisar por assinaturas</p>
                    <a href="./pesquisa" class="btn btn-primary">Pesquisa</a>
                </div>
            </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
            <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de clientes</h5>
                        <p class="card-text">Cadastre clientes</p>
                        <a href="./cliente" class="btn btn-primary">Cadastre</a>
                    </div>
            </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
            <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de Licenças</h5>
                        <p class="card-text">Cadastre Licenças</p>
                        <a href="./licenca" class="btn btn-primary">Cadastre</a>
                    </div>
            </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
            <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de Assinatura</h5>
                        <p class="card-text">Cadastre Assinatura</p>
                        <a href="./cliente#assinatura" class="btn btn-primary">Cadastre</a>
                    </div>
            </div>
            </div>
        
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

