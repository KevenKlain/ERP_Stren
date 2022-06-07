<?php

	
	switch ($_REQUEST["acao"]) {
		case 'cadastrar':
			$serial = "
				SELECT 
						COALESCE(MAX(id_venda), 0)+1 as id_venda 
				FROM db_gol.tb_venda";

			$sql_serial = utf8_encode($serial); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql_serial);

			$row = pg_fetch_array($result);

			$id_venda = $row['id_venda'];
			$nm_cliente = $_POST["nm_cliente"];
			$lo_status = $_POST["lo_status"];

			$sql = "
				INSERT INTO db_gol.tb_venda(
					id_venda, 				nm_cliente, 				vr_total, 				lo_status, 
					nm_login, 				dt_inc, 					dt_atu
				) VALUES (
					".$id_venda.", 			'".$nm_cliente."', 			'0',					'".$lo_status."',
					'keven_klain', 			NOW(), 						NOW());";
	
			$sql_cadastrar	= utf8_encode($sql); 		
			$conexao    	= new Conexao();
			$conn       	= $conexao->open();
			$result     	= pg_query($conn, $sql_cadastrar);

			if($result==true){
				
				print "<script>location.href='?page=saleEdit&id_venda=".$id_venda.";'</script>";
			}else{
				print "<div class='alert alert-danger'>Não foi possível cadastrar.</div>";
			}
			break;	

		case 'editar':
			$id_venda = $_POST['id_venda'];
			$nm_cliente = $_POST["nm_cliente"];
			$lo_status = $_POST["lo_status"];
			
			$sql = "
				UPDATE db_gol.tb_venda
					SET nm_cliente = '".$nm_cliente."',
					lo_status = '".$lo_status."'
					WHERE id_venda = ".$id_venda;
			
			echo $sql;
			$sql_update = utf8_encode($sql); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql_update);

			if($result==true){
				print "<script>location.href='?page=saleEdit&id_venda=".$id_venda.";'</script>";
			}else{
				print "<div class='alert alert-danger'>Não foi possível editar.</div>";
			}
			break;	

		case 'excluir':
			$id_venda = $_POST["id_venda"];

			$sql = "
				DELETE FROM db_gol.tb_venda
				WHERE id_venda = ".$id_venda;

			$sql_1      = utf8_encode($sql); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql);

			$sql = "
				DELETE FROM db_gol.tb_venda_item
				WHERE id_venda = ".$id_venda;

			$sql_1      = utf8_encode($sql); 		
			$conexao    = new Conexao();
			$conn       = $conexao->open();
			$result     = pg_query($conn, $sql);


			if($result==true){
				print "<script>location.href='?page=saleConsult';</script>";
			}else{
				print "<div class='alert alert-danger'>Não foi possível excluir.</div>";
			}
			break;		
		
	}
?>