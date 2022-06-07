<?php
	require_once 'classes/usuarios.php';
	$u = new usuario;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="jquery-3.4.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<style>
		h1{
			text-align: center;
			color:white;
		}
		div#msg-sucesso{
			width: 400px;
			margin: 10px auto;
			padding: 10px;
			background-color: rgba(50,205,50,.3);
			border: 1px solid rgba(34,39,34);
		}


		div.msg-erro{
			width: 400px;
			margin: 10px auto;
			padding: 10px;
			background-color: rgba(250, 128, 114,.3);
			border: 1px solid rgba(165,42,42);
		}



body{
			background-color: #343A40; 
			padding-top: 10px;
			background-position-x: 0;
			background-position-y: 0;
			background-repeat: no-repeat;
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
	<div id="corpo-form-cad">
	<h1><img src="ima/logo.png" width=100 height=49></h1>
	<form method="POST">
		<input type="text" name="nome" placeholder="nome completo" maxlength="30">
		<br>
		<input type="text" name="telefone" placeholder="telefone" maxlength="30">
		<br>
		<input type="email" name="email" placeholder="Email" maxlength="40">
		<br>
		<input type="password" name="senha" placeholder="senha">
		<br>
		<input type="password" name="confsenha" placeholder="confirmar senha" maxlength="15">
		<br>	
		<input type="submit" value="cadastrar">
	</form>
</div>

<?php
if(isset($_POST['nome']))
{
	$nome = addslashes($_POST['nome']);
	$telefone = addslashes($_POST['telefone']);
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	$confirmarsenha = addslashes($_POST['confsenha']);

	if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarsenha))
	{
			//$u->conectar("login","localhost","root","");
			$u->open();
			if($u->msgErro == "")
			{
				if($senha == $confirmarsenha)
				{
					
					if($u->cadastrar($nome,$telefone,$email,$senha))
					{
						?>
						<div id="msg-sucesso">
						cadastrado com sucesso!
						</div>
						
						<?php
					}
					else
					{
						?>
						<div class="msg-erro">
						email ja cadastrado!
						</div>
						
						<?php
					}
				}
				else
				{
					?>
						<div class="msg-erro">
						senha e confirmar senha não corresponde!
						</div>
						
						<?php
					
				}
			}
			else
			{
				?>
				<div class="msg-erro">
			<?php echo "Erro: ".$u->msgErro;?>
				</div>
				<?php
			}
	}else
	{
		?>
						<div class="msg-erro">
						preencha todos os campos!
						</div>
						
						<?php
		
	}

}



?>
</body>
</html>