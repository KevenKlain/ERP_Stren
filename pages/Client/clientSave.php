<?php

	
	switch ($_REQUEST["acao"]) {
		case 'cadastrar':
			$serial = "
				SELECT 
						COALESCE(MAX(id_cliente), 0)+1 as id_cliente 
				FROM db_gol.tb_cliente";

			$sql_serial = utf8_encode($serial); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql_serial);

			$row = pg_fetch_array($result);

			$id_cliente = $row['id_cliente'];
			$nm_cliente = $_POST["nm_cliente"];
			$cpf_cnpj   = $_POST["cpf_cnpj"];
			$nm_regiao  = $_POST["nm_regiao"];

			$sql = "
				INSERT INTO db_gol.tb_cliente(
					id_cliente, 			nm_cliente, 				cpf_cnpj, 				nm_regiao, 
					nm_login, 				dt_inc, 					dt_atu
				) VALUES (
					".$id_cliente.", 		'".$nm_cliente."', 			'".$cpf_cnpj."',		'".$nm_regiao."',
					'keven_klain', 			NOW(), 						NOW());";
	
			$sql_cadastrar	= utf8_encode($sql); 		
			$conexao    	= new Conexao();
			$conn       	= $conexao->open();
			$result     	= pg_query($conn, $sql_cadastrar);

			if($result==true){
				
				print "<script>location.href='?page=clientEdit&id_cliente=".$id_cliente.";'</script>";
			}else{
				print "<div class='alert alert-danger'>Não foi possível cadastrar.</div>";
			}
			break;	

		case 'editar':
			$id_cliente = $_POST['id_cliente'];
			$nm_cliente = $_POST["nm_cliente"];
			$cpf_cnpj   = $_POST["cpf_cnpj"];
			$nm_regiao  = $_POST["nm_regiao"];
			
			$sql = "
				UPDATE db_gol.tb_cliente
					SET nm_cliente = '".$nm_cliente."',
					cpf_cnpj = '".$cpf_cnpj."',
					nm_regiao = '".$nm_regiao."'
					WHERE id_cliente = ".$id_cliente;
			
			echo $sql;
			$sql_update = utf8_encode($sql); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql_update);

			if($result==true){
				print "<script>location.href='?page=clientEdit&id_cliente=".$id_cliente.";'</script>";
			}else{
				print "<div class='alert alert-danger'>Não foi possível editar.</div>";
			}
			break;	

		case 'excluir':
			$id_cliente = $_POST["id_cliente"];

			$sql = "
				DELETE FROM db_gol.tb_cliente
				WHERE id_cliente = ".$id_cliente;

			$sql_1       = utf8_encode($sql); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql);

			if($result==true){
				print "<script>location.href='?page=clientConsult';</script>";
			}else{
				print "<div class='alert alert-danger'>Não foi possível excluir.</div>";
			}
			break;		
		
	}
?>