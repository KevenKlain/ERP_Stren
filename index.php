<?php 
	require_once 'classes/usuarios.php';
	$u = new usuario;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="jquery-3.4.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<style>
		body{
			background-color: #343A40; 
			padding-top: 10px;
			background-position-x: 0;
			background-position-y: 0;
			background-repeat: no-repeat;
		}

		h1{
			color:white;
		}

	</style>


<div class="btn-group btn-group-lg btn-group-justified">
		<a href="index.php" class="btn btn-success">
		  <span class="glyphicon glyphicon-user"></span> Login
		</a>
		<a href="cadastrar.php" class="btn btn-success">
		  <span class="glyphicon glyphicon-user"></span> Cadastrar
		</a>
</div>

</head>
<body>
	<div id="corpo-form">
	<h1><img src="ima/logo.png" width=100 height=49></h1>
	<form method="post">
		<input type="email" placeholder="Email" name="email">
		<br>
		<input type="password" placeholder="senha" name="senha">
		<br>
		<input type="submit" value="Acessar">
		<br>
		<a href="cadastrar.php" style="color: white;">Ainda não é inscrito?<b>Cadastrar</b></a>
	</form>
</div>
<?php

if(isset($_POST['email']))
{
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);

	if(!empty($email) && !empty($senha))
	{
		//$u->conectar("login","localhost","root","");
		$u->open();
		if($u->msgErro == "")
		{
		if($u->logar($email,$senha))
		{
			echo("<script>console.log('acessou');</script>");
			//exit;
			header('Location: entrou.php');
		}
		else
		{
			?>
			<div class="msg-erro">
			Email e/ou senha estão incorretos!
			</div>
			
			<?php
		}
	}
		else
		{
			?>
			<div class="msg-erro">
			<?php echo "Erro: ".$u->msgErro; ?>
			</div>
			
			<?php
			
		}
	}else
	{
		?>
			<div class="msg-erro">
			Preencha todos os campos!
			</div>
			
			<?php
		
	}
}

?>
</body>
</html>