<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>formulario html</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
</head>
<body>

	<div class="container mt-5">

		<div class= "row">
			<div class="col-3"></div>
			
			<form class="col-6" method="POST" action="./login.php">
				<p class="h2 text-center">Sistema de login</p>

				<?php if(isset($_SESSION["nao_autenticado"])): ?>
				<div class="alert alert-danger" role="alert">
				  Usuario ou senha invalidos
				</div>

				<?php
				unset($_SESSION['nao_autenticado']);
				endif; 
				?>

			  <div class="form-group">
			    <label for="inputNome">Usuário</label>
			    <input name="usuario" type="text" class="form-control" id="inputNome" aria-describedby="emailHelp" placeholder="Seu nome de usuario">
			    <small id="emailHelp" class="form-text text-muted"></small>
			  </div>
			  <div class="form-group">
			    <label for="inputSenha">Senha</label>
			    <input name="senha" type="password" class="form-control" id="inputSenha" placeholder="Senha">
			  </div>
			  <div class="form-group form-check">
			    <input type="checkbox" class="form-check-input" id="exampleCheck1">
			    <label class="form-check-label" for="exampleCheck1">Clique em mim</label>
			  </div>
			  <button type="submit" class="btn btn-primary">Enviar</button>
			</form>
			<div class="col-3"></div>
		</div>
	</div>
</body>
</html>