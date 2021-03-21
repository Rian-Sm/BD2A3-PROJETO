<?php
session_start();
include('./source/connect.php');
include('./verifica_login.php');
$query = 'SELECT * from licenca ORDER BY id_licenca;';
$query_cliente = 'SELECT * from cliente ORDER BY id_cliente';

$licencas = mysqli_query($link, $query);
$clientes = mysqli_query($link, $query_cliente);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Painel html</title>
	
</head>
<body class="d-flex flex-column h-100">
<div>
    <nav class="navbar  navbar-expand-lg navbar-dark bg-primary pl-5 py-3">
        <div class="container">
            <a class="navbar-brand" href="./painel.php"><h2><?php echo 'Olá, '.$_SESSION['usuario']; ?></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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

<section class= "section mb-5 container">
    
    <div>
        <div class="justify-center pb-3 mt-5 ">
            <h2>Cadastro de Clientes</h2>
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
            <form class="col-md-6 col-sm-12" method="POST" action="./createCliente.php">
                <div class="row mb-3 mt-5">
                    <h3 class="col-12 mb-5">Novo Cliente:</h2>
                    <label class="col-md-4" for="nome_cliente" >Nome do cliente:</label>
                    <input class="col-md-7" type="text" id="nome_cliente" name="nome_cliente">
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="cnpj_cliente">CNPJ do cliente:</label>
                    <input class="col-md-7" type="text"  id="cnpj_cliente" name="cnpj_cliente">
                </div>
                <div class="row mb-3 justify-content-center">
                    <button col="col" type="submit" class="btn btn-primary">Enviar</button> 
                </div>
            </form> 

            <div class="col-md-6 mt-5 col-sm-12">          
                    <h3>Clientes cadastrados:</h3>
                    <div class="embed-responsive embed-responsive-21by9">
                    <iframe class="embed-responsive-item" src="./getAllCliente.php"></iframe>
                    </div>           
            </div>
        </div>

        <div class="row my-5">
        <form class="col-md-6 col-sm-12" method="POST" action="./alterateCliente.php">

                <div class="row mb-3">
                    <h3 class="col-12 mb-5">Alterar Dados:</h3>
                    <label class="col-md-4" for="id_cliente" >id do cliente:</label>
                    <input class="col-md-7" type="number" id="id_cliente" name="id_cliente" min="1">
                </div>

                <div class="row mb-3 ">
                    <label class="col-md-4" for="nome_cliente_at" >Modificação no nome:</label>
                    <input class="col-md-7" type="text" id="nome_cliente_at" name="nome_cliente">
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="cnpj_cliente_at">Modificação no CNPJ:</label>
                    <input class="col-md-7" type="text"  id="cnpj_cliente_at" name="cnpj_cliente">
                </div>
                <div class="row mb-3 justify-content-center">
                <button col="col mb-5" type="submit" class="btn btn-primary">Modificar</button> 
                    
                </div>
            </form> 

            <form class="col-md-6 alert alert-danger" role="alert" method="POST" action="./deleteCliente.php">

                <div class="row mb-5">
                    <h3 class="col-12 mb-5 ">Deletar dados:</h3>

                    <p class='col-12'>Cuidado ao deletar dados, ele são perdidos permanentemente.</p>
                    <label class="col-md-4" for="id_cliente_delete" >id do cliente:</label>
                    <input class="col-md-7" type="number" id="id_cliente_delete" name="id_cliente" min="1">
                </div>
                <div class="row mb-3 justify-content-center">
                    <button col="col" type="submit" class="btn btn-danger">Deletar</button>        
                </div>
            </form> 
        
        </div>
    </div>

    <div class="my-5">
        <div class="justify-center pb-3 mt-5 ">
            <h2 id="assinatura">Cadastro de Assinaturas</h2>
        </div>

        <div class="row my-5">
            <form class="col-md-5 col-sm-12" method="POST" action="./createAssinatura">

                <div class="row mb-3">
                    <h3 class="col-12 mb-5">Criar Assinatura:</h3>
                    <label class="col-md-4" for="cnpj_cliente">CNPJ:</label>
                    <input class="col-md-7" type="text"  id="cnpj_cliente" name="cnpj_cliente">
                </div>

                <div class="row mb-3 ">
                    <label class="col-md-4" for="id_licenca" >Licença:</label>
                    <select class="col-md-7" name="id_licenca" id="id_licenca">
                        <?php 
                            if (mysqli_num_rows($licencas) > 0){
                                while($row = mysqli_fetch_array($licencas)){
                                    $opt = "<option value={$row['id_licenca']}>{$row['nome_licenca']}, ({$row['versao_sistema']})</option>";
                                    echo $opt;
                                }
                            }
                        ?>
                    </select>
                </div>

                <div class="row mb-3">
                    <label class="col-md-4" for="estacao">Estação:</label>
                    <input class="col-md-7" type="number"  id="estacao" name="estacao" min=1>
                </div>

                <div class="row mb-3">
                    <label class="col-md-4" for="key_assinatura">key do sistema:</label>
                    <input class="col-md-7" type="text"  id="key_assinatura" name="key_assinatura">
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="data_aquisicao">Data da Assinatura: 
                    </label>
                    <input class="col-md-7" type="date"  id="data_aquisicao" name="data_aquisicao"  max=<?php 
                        echo date('Y-m-d');
                    ?> value=<?php echo date('Y-m-d');?>>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="date_final_aquisicao">Data Final da Assinatura: 
                    </label>
                    <input class="col-md-7" type="date"  id="date_final_aquisicao" name="date_final_aquisicao" min=<?php 
                        echo date('Y-m-d');
                    ?>>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="atualizado">Atualizado:</label>
                    <input class="col-md-1" type="checkbox"  id="atualizado" name="atualizado" value="true">
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="confirmado">Confirmado:</label>
                    <input class="col-md-1" type="checkbox"  id="confirmado" name="confirmado" value="true">
                </div>

                <div class="row mb-3 justify-content-center">
                <button col="col" type="submit" class="btn btn-primary">Enviar</button> 
                    
                </div>
            </form> 
            <div class="col-md-7 col-sm-12">
                <h3>Clientes cadastrados:</h3>
                <div class="embed-responsive embed-responsive-4by3">
                <iframe class="embed-responsive-item" src="./getAllAssinatura.php"></iframe>
            </div>  
        </div>
    </div>
    
    <div class="row my-5">
            <form class="col-md-6 col-sm-12" method="POST" action="./alterateAssinatura.php">
                <div class="row mb-3">
                    <h3 class="col-12 my-3 mb-5">Atualizar assinatura:</h3>
                    <label class="col-md-4" for="at_cnpj_cliente">CNPJ:</label>
                    <select class="col-md-7" name="at_cnpj_cliente" id="at_cnpj_cliente">
                        <?php 
                            if (mysqli_num_rows($clientes) > 0){
                                while($row = mysqli_fetch_array($clientes)){
                                    $opt = "<option value={$row['id_cliente']}>{$row['cnpj_cliente']}</option>";
                                    echo $opt;
                                }
                            }
                        ?>
                    </select>
                </div>

                <div class="row mb-3 ">
                    <label class="col-md-4" for="at_id_licenca" >Licença:</label>
                    <select class="col-md-7" name="at_id_licenca" id="at_id_licenca">
                        <?php 
                            $licencas = mysqli_query($link, $query);
                            if (mysqli_num_rows($licencas) > 0){
                                while($row = mysqli_fetch_array($licencas)){
                                    $opt = "<option value={$row['id_licenca']}>{$row['nome_licenca']}, ({$row['versao_sistema']})</option>";
                                    echo $opt;
                                }
                            }
                        ?>
                    </select>
                </div>

                <div class="row mb-3">
                    <label class="col-md-4" for="at_estacao">Estação:</label>
                    <input class="col-md-7" type="number"  id="at_estacao" name="at_estacao" min=1>
                </div>

                <div class="row mb-3">
                    <label class="col-md-4" for="at_key_assinatura">key do sistema:</label>
                    <input class="col-md-7" type="text"  id="at_key_assinatura" name="at_key_assinatura">
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="at_data_aquisicao">Data da Assinatura: 
                    </label>
                    <input class="col-md-7" type="date"  id="at_data_aquisicao" name="at_data_aquisicao"  max=<?php 
                        echo date('Y-m-d');
                    ?> value=<?php echo date('Y-m-d');?>>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="at_date_final_aquisicao">Data Final da Assinatura: 
                    </label>
                    <input class="col-md-7" type="date"  id="at_date_final_aquisicao" name="at_date_final_aquisicao" min=<?php 
                        echo date('Y-m-d');
                    ?>>
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="at_atualizado">Atualizado:</label>
                    <input class="col-md-1" type="checkbox"  id="at_atualizado" name="at_atualizado" value="true">
                </div>
                <div class="row mb-3">
                    <label class="col-md-4" for="at_confirmado">Confirmado:</label>
                    <input class="col-md-1" type="checkbox"  id="at_confirmado" name="at_confirmado" value="true">
                </div>

                <div class="row mb-3 justify-content-center">
                <button col="col" type="submit" class="btn btn-primary">Enviar</button> 
                    
                </div>
            </form>
            <form class="col-md-6 alert alert-danger" role="alert" method="POST" action="./deleteAssinatura">

                <div class="row mb-5 ">
                    <h3 class="col-12 mb-5 ">Deletar dados:</h3>

                    <p class='col-12 mb-5 '>Cuidado ao deletar dados, ele são perdidos permanentemente.</p>
                    <label class="col-md-4" for="id_delete_assinatura" >ID Assinatura:</label>
                    <input class="col-md-7" type="number" id="id_delete_assinatura" name="id_delete_assinatura" min="1">
                </div>
                <div class="row justify-content-center">
                    <button col="col" type="submit" class="btn btn-danger">Deletar</button>        
                </div>
            </form>  
        </div>
    </div>

    
</section>
    
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